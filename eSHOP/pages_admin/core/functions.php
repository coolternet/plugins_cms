<?php

    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
    error_reporting(E_ALL);

	/******************** Aide Mémoire ********************
		
		DB::QueryAll	=> Returns an array of all rows returned by the SQL query
		DB::GetAll		=> Alias for QueryAll
		DB::QuerySingle	=> Returns a single row, or a single column if $entire_row is false
		DB::Get			=> Returns one column if only one column is present in the result. Otherwise it returns the whole row.
		DB::Exec		=> Execute an SQL statement and returns the number of affected rows
		DB::Insert		=> Inserts one or more rows in a table > Insert($table, array $rows, $replace = false)
		DB::Update		=> Updates one or more rows in a table > Update($table, array $fields, $where = ['id' => 0])

        Return last result of rates between 2 currency https://www.banqueducanada.ca/valet/observations/FXUSDCAD/json?recent=1
        Return last result of rates https://www.banqueducanada.ca/valet/observations/group/FX_RATES_DAILY/json?recent=1'

	******************************************************/

	/**
	 * checks and validates the information passed in the request (Post / Get).
	 * 
	 * @return array|boolean
	 */
	function request_validation_parameters($request, $allowed, $html_encode = false) {
		$result = [];
		
		foreach($request as $key => $value) {
			if (in_array($key, $allowed)) {
				unset($allowed);
				
				$result[$key] = ($html_encode) ? html_encode(strip_tags($value)) : strip_tags($value);
			}
		}

		return $result ? true : false; 
	}

	function get_name($uid) {
		if ($user = get_customer($uid)) {
			if (isset($user['first_name'], $user['last_name'])) { 
				return $user['first_name'].' '. $user['last_name'];
			} else {
				return $user['username'];
			}
		}
		return false;
	}

	$invoice_eta = array(
		'0' => '<a class="ui orange basic label">Unpaid</a>',
		'1' => '<a class="ui green basic label">Paid</a>',
		'2' => '<a class="ui black basic label">Refunded</a>',
		'3' => '<a class="ui red basic label">Canceled</a>'
	);

	/*
	 *	Log system for tracking any events from users
	 */
	function eshop_log_event($event = '')
	{	
	    global $user_session;
		return \DB::Insert('eshop_log', [
			'uid'   		=> $user_session['id'] ?: 0,
			'date_created'	=> date("Y-m-d H:i:s"),
    		'ip'            => $_SERVER['REMOTE_ADDR'],
    		'event'         => $event
		]);
	}

	function evocms_log($uid) {
		return \DB::QueryAll('SELECT * from {history} WHERE a_uid = :uid ORDER BY id DESC LIMIT 15', [':uid' => $uid]);
		
	}

	function eshop_log_query($uid) {
		return \DB::QueryAll('SELECT * from eshop_log WHERE eshop_log.uid = :uid ORDER BY id DESC LIMIT 20', [':uid' => $uid]);
	}

	function get_discounts() {
		return \DB::QueryAll('SELECT * from eshop_discount');
	}

	/*
	 *	HASH Random Generator 
	 */
	function token($length = 30) {
		$string = str_replace(['=','+','/'], '', base64_encode(sha1(uniqid('',true))));
		return substr($string, 0, $length);
	}

	function get_customers() {
		return \DB::QueryAll('SELECT
		                        users.id,
                                users.username,
                                users.email,
                                users.country,
                                eshop_customers.first_name,
                                eshop_customers.last_name,
                                eshop_customers.phone
                              FROM users
                              LEFT JOIN eshop_customers ON users.id = eshop_customers.uid');
	}

	function get_customer($uid) {
		return \DB::Get('SELECT eshop_customers.*,
									{users}.username,
									{users}.email,
									{users}.country
							 FROM eshop_customers
							 RIGHT JOIN {users}
							 ON eshop_customers.uid = {users}.id
							 WHERE {users}.id = :uid', [':uid' => $uid]);
	}


    /*
     *  Return all invoices
     */
	function get_invoices($val = NULL) {
		if (NULL === $val || "" === $val) {
			return \DB::QueryAll(
				'SELECT {users}.username,eshop_customers.first_name,eshop_customers.last_name,eshop_invoices.id AS invid,eshop_invoices.uid,eshop_invoices.state,eshop_invoices.create_date
				 FROM eshop_invoices
				 INNER JOIN {users} ON eshop_invoices.uid = {users}.id
				 INNER JOIN eshop_customers ON eshop_invoices.uid = eshop_customers.uid');
		} else {
    		return \DB::QueryAll(
    			'SELECT {users}.username,eshop_customers.first_name,eshop_customers.last_name,eshop_invoices.id AS invid,eshop_invoices.uid,eshop_invoices.state,eshop_invoices.create_date
    			 FROM eshop_invoices
    			 INNER JOIN {users} ON eshop_invoices.uid = {users}.id
    			 INNER JOIN eshop_customers ON eshop_invoices.uid = eshop_customers.uid
    			 WHERE eshop_invoices.state = :val', [':val' => $val]);
	    }
	}

    /*
     *  Return only an invoice with ID
     */
    function get_invoice($id) {
        
		return \DB::Get('
		    SELECT 
		        {users}.username,
		        {users}.email,
		        {users}.country,
		        eshop_customers.*,
		        eshop_invoices.id AS invid,
		        eshop_invoices.state AS invstate,
		        eshop_invoices.create_date,
		        eshop_invoices.due_date,
		        eshop_invoices.pay_date
			FROM eshop_invoices
			INNER JOIN {users} ON eshop_invoices.uid = {users}.id
			INNER JOIN eshop_customers ON eshop_invoices.uid = eshop_customers.uid
			WHERE eshop_invoices.id = :val', [':val' => $id]);
	}


    /*
     *  Update all rates Currency from bank
     */
    function update_currency($base, $source, $reset) {

		if ($reset) {
			\Db::Truncate('eshop_currency');
		}

        if ($source == 2) {

            $url = "https://api.ratesapi.io/api/". date("Y-m-d") ."?base=". $base;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $data = curl_exec($ch);
			$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);  
            curl_close($ch);

            if ($statusCode == 200 && !empty($data)) {

	        	$currency = @json_decode($data, true);

				if (!empty($currency['rates'])) {
	                foreach($currency['rates'] as $key => $val) {
    	            	if ($reset) {
        	            	\DB::Insert('eshop_currency', ['rate' => $val, 'code' => $key]);
            	        } else {
                	    	\DB::Update('eshop_currency', ['rate' => $val], ['code' => $key]);
                    	}
                	}

    	            \DB::Exec("Update `eshop_settings` SET `shop_currency_last_update` = :date", [':date' => date("Y-m-d")]);
        	        App::setSuccess("Mise à jours des taux de changes avec la Banque Centrale Européenne effectuée avec succès.");

				} else {
					App::setWarning("Erreur JSON. Veuillez réesseyer plustard.");
				}

            } else {
                App::setWarning("Impossible de rejoindre le serveur de la banque. Veuillez réesseyer plustard.");
            }
            
        } else {
            App::setWarning("La source spécifié n'existe pas. Veuillez vous assurez que la source existe.");
        }
    }

    /*
     *  Admin Button Currency Management
     */
     
        /*** Save company changement ***/
            if (isset($_POST['save_company'])) {
                
                $name   = html_encode($_POST['shop_name']);
                $vat    = html_encode($_POST['shop_vat']);
                $owner  = html_encode($_POST['shop_owner']);
                $address= html_encode($_POST['shop_address']);
                $city   = html_encode($_POST['shop_city']);
                $state  = html_encode($_POST['shop_state']);
                $zip    = html_encode($_POST['shop_zip']);
                $phone  = html_encode($_POST['shop_phone']);
                $email  = html_encode($_POST['shop_email']);
                
                // Query for replacement of the value
                \DB::Update('eshop_settings',
                ['shop_name' => $name, 'shop_contractor' => $owner, 'shop_vat' => $vat, 'shop_address' => $address, 'shop_city' => $city, 'shop_state' => $state, 'shop_zip' => $zip, 'shop_phone' => $phone, 'shop_business_mail' => $email],['id' => 1]);

                // Alert Ajax for success
			    App::setSuccess('The informations has bean changed with success');
			    
			    // Log system
				eshop_log_event('Informations of the company changed');
            }
            
        /*** Change default currency ***/
		
			function update_default_currency($code){
				
                // Query for replacement of the value
                \DB::Exec("Update {eshop_settings} SET `shop_currency_default` = :code", [':code' => $code]);
			    
			    // Log system
				eshop_log_event('Default currency is changed for '.$code);
				
				return 'success';
			}
            
			/*
            if (isset($_POST['save_default_currency'])) {
                $code = $_POST['currency'];
            }
			*/
            
        
        /*** Change provider of currency (Bank) ***/ ### Next Feature !
        /*   
            if(isset($_POST['save_currency_provider'])){
                
                $provider = $_POST['provider'];

                // Query for replacement of the value
                \DB::Exec("Update `eshop_settings` SET `shop_currency_provider` = :code",[':code' => $provider]);

                // Alert Ajax for success
			    App::setSuccess('Rates currency provider changed with success');
			    
			    // Log system
				eshop_log_event('Currency provider change for '. $settings['provider_name']);
            }
        */
        
        /*** Migrate CMS USERS to ESHOP PLUGIN ***/
            if (isset($_POST['migrate_eshop'])) {
                
                $users = \DB::Exec("SELECT id, country FROM {users}");
                
                foreach($users AS $key => $val){
                    #\DB::Insert('eshop_customers', 'uid' => $key);
                    echo $key .' = '. $val .'<br>';
                }
                
                App::setSuccess("The migration has bean completed with success");
            }
        
        /*** Flush and reinstall currency DB ***/
        
            if (isset($_POST['install_currency'])) {
                $source = get_eshop_settings()['provider_id'];
                $base = get_eshop_settings()['shop_currency_default'];
                update_currency($base, $source, true);
				eshop_log_event('Currency Rates updates.');
            }

	/*
	 * Calculate total of each items by the quantity and return the subtotal
	 */
	function get_subtotal_invoice($id) {
		return \DB::QueryAll('SELECT item_qty, item_price FROM eshop_invoices_items WHERE inv_id = :inv', [':inv' => $id]);
	}
	
	
	/*
	 * Return all informations of the current invoice
	 */
	function get_invoice_header($id) {
	    return \DB::Get('SELECT {users}.username, {users}.email, eshop_customers.* FROM eshop_customers
	                       INNER JOIN {users}.id ON eshop_customers.uid = {users}.id WHERE {users}.id = :uid', [':uid' => $_GET['id']]);
	}
	
	/*
	 * Return all informations about the business
	 */
	function get_eshop_settings() {
	    return \DB::Get('SELECT eshop_settings.*, eshop_currency_provider.name AS provider_name, eshop_currency_provider.provider_id FROM {eshop_settings}
	                           INNER JOIN eshop_currency_provider ON eshop_settings.shop_currency_provider = eshop_currency_provider.provider_id
	                           WHERE eshop_settings.id = 1', true);
	}
	
	/*
	 * Return all rates currency provider
	 */
	function get_eshop_currency_provider() {
	    return \DB::QueryAll('SELECT * FROM eshop_currency_provider');
	}
	
	/*
	 * Return all currency code
	 */
	function get_eshop_currency() {
	    return \DB::QueryAll('SELECT * FROM eshop_currency');
	}
	
	/*
	 * Save Customer settings
	 */	

        if (isset($_POST['save_customer'])) {
            
				$fname      = $_POST['first_name'];
				$lname      = $_POST['last_name'];
				$email      = $_POST['email'];
				$addre      = $_POST['address'];
				$apt        = $_POST['apt'];
				$city       = $_POST['city'];
				$zip        = $_POST['zip'];
				$state      = $_POST['state'];
				$country    = $_POST['country'];
				$phone      = $_POST['phone'];
                $uid        = $_POST['user'];
            
            // Check if user already existe in Customers table
            $check = \DB::Get('SELECT * FROM eshop_customers WHERE uid = :uid',[':uid' => $uid]);
            
            if(!$check){
                
                // if not exist, add info
				\DB::Exec('INSERT INTO {eshop_customers} (`uid`, `first_name`,`last_name`,`address`,`apt`,`city`,`zip`,`state`,`phone`) VALUE (:uid, :first, :last, :address, :apt, :city, :zip, :state, :phone)', [
					':uid'      => $uid,
					':first' 	=> $fname,
					':last' 	=> $lname,
					':address' 	=> $addre,
					':apt' 		=> $apt,
					':city' 	=> $city,
					':zip'	 	=> $zip,
					':state' 	=> $state,
					':phone' 	=> $phone
				]);

				#\DB::Update('users', ['email' => $email, 'country' => $country], ['id' => $uid]);
				
				 App::setSuccess('Condition INSERT');
                    
            }else{
				
                // If exist, update info
                \DB::Update('eshop_customers',
                    [
						'first_name' => $fname,
						'last_name' => $lname,
						'address' => $addre,
						'apt' => $apt,
						'city' => $city,
						'state' => $state,
						'zip' => $zip,
						'phone' => $phone
                    ],
                    ['uid' => $uid]);
                    
                \DB::Update('users', ['email' => $email, 'country' => $country], ['id' => $uid]);
				
				App::setSuccess('User updated with success');
                
            }

		   

			#eshop_log_event('Default currency is changed for '.$code);
        }
		
	// Count products per subcategory
		
	// GET every tax
	function eshop_taxes(){
		return \DB::QueryAll('SELECT * FROM {eshop_taxes}');
	}
	
	// GET Only one tax to editor
	function eshop_get_taxe($id){
		return \DB::Get('SELECT * FROM {eshop_taxes} WHERE `id` = :id', [':id' => $id]);
	}
	
	// Delete only one tax
	function eshop_delete_taxe($id){
		return \DB::Delete('eshop_taxes', ['id' => $id]);
	}
	
	// Create a tax
	function eshop_create_taxe($name, $code, $rate, $tnum){
		\DB::Insert('eshop_taxes', ['name' => $name, 'code' => $code, 'rate' => $rate, 'tnumber' => $tnum]);
		return \DB::$insert_id;
	}
	
	// Save changes of tax settings
	function eshop_edit_taxe($id, $name, $code, $rate, $tnum){
		$query = \DB::Get('SELECT * FROM {eshop_taxes} WHERE `id` = :id', [':id' => $id]);
		if($query){
			\DB::Exec('UPDATE {eshop_taxes} SET `name` = :name, `code` = :code, `rate` = :rate, `tnumber` = :tnumber WHERE id = :id', [
				':id'		=> $id,
				':name'		=> $name,
				':code' 	=> $code,
				':rate' 	=> $rate,
				':tnumber' 	=> $tnum
			]);
			eshop_log_event('La taxe '. $code .' a été mis à jour');
			return '1';
		}else{
			return '0';
		}
	}
	
	// GET a Category
	function eshop_get_category($id){
		return \DB::Get('SELECT * FROM {eshop_products_categories} WHERE `id` = :id', [':id' => $id]);
	}
	
	// GET all Categories
	function eshop_get_categories(){
		return \DB::QueryAll('SELECT * FROM {eshop_products_categories}');
	}
	
	// Create a new category
	function eshop_create_category($name){
		$slug = format_slug($name);
		\DB::Insert('eshop_products_categories', ['name' => $name, 'slug_name' => $slug]);
		return \DB::$insert_id;
	}
	
	// Update a category
	function eshop_update_category($id, $name){
		$slug = format_slug($name);
		\DB::Update('eshop_products_categories', ['name' => $name, 'slug_name' => $slug], ['id' => $id]);
		eshop_log_event('La catégory '. $name .' à été modifiée.');
		return '1';
	}
	
	// Delete a category
	function eshop_delete_category($id){
		return \DB::Delete('eshop_products_categories', ['id' => $id]);
	}
	
	// Create a new sub-category
	function eshop_create_subcategory($name, $subname){
		$slug = format_slug($name);
		\DB::Insert('eshop_products_sub_categories', ['name' => $name, 'slug_name' => $slug, 'category_id' => $subname]);
		return \DB::$insert_id;
	}
	
	
	// Count sub-category per category
	function subcat_counting($id){
		$query = \DB::QueryAll("SELECT Count(*) AS nbr FROM eshop_products_sub_categories WHERE category_id = :cid", [':cid' => $id]);
		return $query[0]['nbr'];
	}
	
/*
	function eshop_customers_update() {
		if (isset($_POST['save_customer'])) { # je sais  
			# le premier paramètre $_POST ou $_GET en fonction de ta <form>
			# puis le deuxième paramètre entre les clés de tes fields pour éviter que une personne entre d'autre choses (de nouvelles valeurs)
			# le dernier permet d'encoder en html ou pas (true ou false)
			$result = request_validation_parameters($_POST, [
				'first_name',
				'last_name',
				'email',
				'address',
				'apt',
				'city',
				'zip',
				'state',
				'country',
				'phone',
				'currency',
				'user'
			], true);
	
	
			if ($result) {
				if (!empty($result['email']) && !empty($result['first_name'])) {
	
					$customer = get_customer($result['user']);
			
					if ($customer) {
						\DB::Exec("UPDATE `eshop_customers` SET `first_name` = `:first`, `last_name` = `:last`, `address` = `:address`, `apt` = `:apt`, `zip` = `:zip`, `city` = `:city`, `state` = `:state`, `phone` = `:phone`, `currency` = `:currency`, `deposite` = `:deposite` WHERE uid = :uid",[
							':first' 	=> $result['fist_name'],
							':last' 	=> $result['last_name'],
							':address' 	=> $result['address'],
							':apt' 		=> $result['apt'],
							':city' 	=> $result['city'],
							':zip'	 	=> $result['zip'],
							':state' 	=> $result['state'],
							':country' 	=> $result['country'],
							':phone' 	=> $result['phone'],
							':currency'	=> $result['currency'],
							':deposite'	=> $result['deposite'],
							':uid'		=> $result['user']
						]);
						
						\DB::Exec("UPDATE `users` SET `email` = `:email`, `country` = `:country` WHERE uid = :uid", [
						    ':email' => $result['email'],
						    ':country' => $result['country']
						]);

					    App::setSuccess('Le profil a été enregistré avec succès');
						eshop_log_event('Mise à jours des informations personnel.');

					} else {
						\DB::Exec("INSERT INTO eshop_customers (`first_name`,`last_name`,`address`,`apt`,`city`,`zip`,`state`,`phone`,`currency`) VALUE (`:first`,`:last`,`:address`,`:apt`,`:city`,`:zip`,`:state`,`:phone`,`:currency`)", [
							':first' 	=> $result['fist_name'],
							':last' 	=> $result['last_name'],
							':address' 	=> $result['address'],
							':apt' 		=> $result['apt'],
							':city' 	=> $result['city'],
							':zip'	 	=> $result['zip'],
							':state' 	=> $result['state'],
							':country' 	=> $result['country'],
							':phone' 	=> $result['phone'],
							':currency'	=> $result['currency'],
							':deposite'	=> $result['deposite'],
						]);

						\DB::Exec("INSERT INTO eshop_customers (`email`, `:email`) VALUES (`country`, `:country`) WHERE uid = :uid", [
						    ':email' => $result['email'],
						    ':country' => $result['country']
						]);

					    App::setSuccess('Le profil a été mis à jour avec succès');
						eshop_log_event('Mise à jours des informations personnel.');
					}
				} else {
					# problème avec le first_name ou last_name
					App::redirect('location: /admin/?p=eshop/customers&user=' . $result['user']);
					App::setWarning('Erreur');
				}
			} else {
				App::redirect('/');
				App::setWarning('Une erreur est survenue, blabla...');
			}
		}
	}
*/