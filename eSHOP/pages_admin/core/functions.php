<?php
use Plugins\eshop;

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

	$invoice_eta = array(
		'0' => '<a class="ui orange basic label">Unpaid</a>',
		'1' => '<a class="ui green basic label">Paid</a>',
		'2' => '<a class="ui black basic label">Refunded</a>',
		'3' => '<a class="ui red basic label">Canceled</a>'
	);



	/*
	 *
	 * 	System log's event
	 * 
	 */
		// eSHOP Log Event system
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

		// Get all syslog of a system user
			function evocms_log($uid) {
				return \DB::QueryAll('SELECT * from {history} WHERE a_uid = :uid ORDER BY id DESC LIMIT 15', [':uid' => $uid]);
				
			}

		// Get all eSHOP of a system user
			function eshop_log_query($uid) {
				return \DB::QueryAll('SELECT * from eshop_log WHERE eshop_log.uid = :uid ORDER BY id DESC LIMIT 20', [':uid' => $uid]);
			}


	/*
	 *	Get Discount's
	 */
		function get_discounts() {
			return \DB::QueryAll('SELECT * from eshop_discount');
		}

	/*
	 *	Get first name and last name if column is filled or simply return username
	 */
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

	/*
	 *	Show all customers to Customer's Page
	 */
		function get_customers() {
			return \DB::QueryAll('SELECT {users}.id, {users}.username, {users}.email, {users}.country, eshop_customers.first_name, eshop_customers.last_name, eshop_customers.phone
								FROM users
								LEFT JOIN eshop_customers ON users.id = eshop_customers.uid');
		}

	/*
	 *	Button password generator for current customer
	 */
		function password_customer($id){
			$hash = random_hash();
			return \Db::Update('users', ['reset_key' => null, 'password' => $hash], ['id' => $id]);
		}

    /*
     * 
	 *  Invoice's Management
	 * 
     */
    	// Return all invoices
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
		
		// Return all informations of the current invoice
		function get_invoice_header($id) {
			return \DB::Get('SELECT {users}.username, {users}.email, eshop_customers.* FROM eshop_customers
							INNER JOIN {users}.id ON eshop_customers.uid = {users}.id WHERE {users}.id = :uid', [':uid' => $_GET['id']]);
		}

		// Return only an invoice with ID
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
     * 
	 *  Currency's Management
	 * 
     */
		// Change default Currency
		function change_default_currency($code){
			\DB::Update('eshop_settings', ['shop_currency_default' => $code], ['id' => 1]);
			eshop_log_event('Default currency is changed for '.$code);
			return 'success';
		}

		// Action for Update all currency's rate
		function update_currency_rate(){
			$source = get_eshop_settings()['provider_id'];
			$base = get_eshop_settings()['shop_currency_default'];
			provider_currency($base, $source, true);
			eshop_log_event("Currency's rate updated.");
			return 'success';
		}

		// Function Update all Currency's rate from bank
		function provider_currency($base, $source, $reset) {
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
						\DB::Update('eshop_settings', ['shop_currency_last_update' => date("Y-m-d")], ['id' => 1]);
						#App::setSuccess("Mise à jours des taux de changes avec la Banque Centrale Européenne effectuée avec succès.");
					} else {
						#App::setWarning("Erreur JSON. Veuillez réesseyer plustard.");
					}

				} else {
					#App::setWarning("Impossible de rejoindre le serveur de la banque. Veuillez réesseyer plustard.");
				}
				
			} else {
				#App::setWarning("La source spécifié n'existe pas. Veuillez vous assurez que la source existe.");
			}
		}

		// Return all currecy's provider
		function get_eshop_currency_provider() {
			return \DB::QueryAll('SELECT * FROM eshop_currency_provider');
		}

		// Return all currency code
		function get_eshop_currency() {
			return \DB::QueryAll('SELECT * FROM eshop_currency');
		}

		

        /*** Save company changement ***/
			function save_company_global($sname, $sowner, $saddr, $scity, $szip, $sstate, $country, $sphone, $semail, $svat){
                \DB::Update('eshop_settings',
					[
						'shop_name' => $sname, 
						'shop_contractor' => $sowner,
						'shop_address' => $saddr, 
						'shop_city' => $scity, 
						'shop_zip' => $szip, 
						'shop_state' => $sstate, 
						'shop_country' => $country, 
						'shop_phone' => $sphone, 
						'shop_business_mail' => $semail,
						'shop_vat' => $svat
					],['id' => 1]
				);
				eshop_log_event('Informations of the company changed');
				return '1';
			}


        
        /*** Change provider of currency (Bank) ### Next Feature !
		
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
			
        
        /*** Flush and reinstall currency DB ## Next Feature
		
            if (isset($_POST['install_currency'])) {
                $source = get_eshop_settings()['provider_id'];
                $base = get_eshop_settings()['shop_currency_default'];
                update_currency($base, $source, true);
				eshop_log_event('Currency Rates updates.');
            }
		*/
		
	/*
	 *  Calculate total of each items by the quantity and return the subtotal
	 */
		function get_subtotal_invoice($id) {
			return \DB::QueryAll('SELECT item_qty, item_price FROM eshop_invoices_items WHERE inv_id = :inv', [':inv' => $id]);
		}
	
	


	
	/*
	 *  Return all informations about the business
	 */
		function get_eshop_settings() {
			return \DB::Get('SELECT eshop_settings.*, eshop_currency_provider.name AS provider_name, eshop_currency_provider.provider_id FROM {eshop_settings}
								INNER JOIN eshop_currency_provider ON eshop_settings.shop_currency_provider = eshop_currency_provider.provider_id
								WHERE eshop_settings.id = 1', true);
		}


	/*
	 *	Show customer's information to Customer's Page Modal
	 */
		function get_customer_profil($uid) {
			return \DB::Get('SELECT eshop_customers.*, {users}.username, {users}.email, {users}.country FROM eshop_customers RIGHT JOIN {users} ON eshop_customers.uid = {users}.id WHERE {users}.id = :uid', [':uid' => $uid]);
		}
	
	/*
	 *  Save Customer's setting from Modal
	 */	
		function set_customer($id, $fn, $ln, $addr, $apt, $ct, $st, $zip, $ph, $ctry, $eml, $crc){

			// Check if user already exist in Customer's table
			$check = \DB::Get('SELECT COUNT(*) FROM eshop_customers WHERE eshop_customers.uid = :uid',[':uid' => $id]);

			// Field's name list
			$fields_eshop = ['first_name'=> $fn,'last_name' => $ln,'address' => $addr,'apt' => $apt,'city' => $ct,'state' => $st,'zip' => $zip,'phone' => $ph,'currency' => $crc];
			$fields_eshop_ins = ['uid' => $id, 'first_name'=> $fn, 'last_name' => $ln, 'address' => $addr, 'apt' => $apt, 'city' => $ct, 'state' => $st, 'zip' => $zip, 'phone' => $ph, 'currency' => $crc];
			$fields_cms = ['email' => $eml,'country' => $ctry];

			// Looking for existing registration and if return true ...
			if($check){

				// Update on Eshop Profil
				\DB::Update('eshop_customers', $fields_eshop, ['uid' => $id]);

				// Update on EvoCMS Profil
				\DB::Update('users', $fields_cms, ['id' => $id]);
				return '1';

			}else{
				// Create a row
				\DB::Insert('eshop_customers', $fields_eshop_ins);
				return '2';
			}

			eshop_log_event('Modification du profil id #'.$id);
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
		}
	}
	
	// GET a Category
	function eshop_get_category($id){
		return \DB::Get('SELECT * FROM {eshop_categories} WHERE `id` = :id', [':id' => $id]);
	}
	
	// GET all Categories
	function eshop_get_categories(){
		return \DB::QueryAll('SELECT * FROM {eshop_categories}');
	}

	// GET all Sub-Categories
	function eshop_get_subcategories($id){
		return \DB::QueryAll('SELECT * FROM {eshop_subcategories} WHERE category_id = :cid',[':cid' => $id]);
	}
	
	// Create a new category
	function eshop_create_category($name){
		$slug = format_slug($name);
		\DB::Insert('eshop_categories', ['name' => $name, 'slug_name' => $slug]);
		return \DB::$insert_id;
	}
	
	// Update a category
	function eshop_update_category($id, $name){
		$slug = format_slug($name);
		\DB::Update('eshop_categories', ['name' => $name, 'slug_name' => $slug], ['id' => $id]);
		eshop_log_event('La catégory '. $name .' à été modifiée.');
		return true;
	}
	
	// Delete a category
	function eshop_delete_category($id){
		return \DB::Delete('eshop_categories', ['id' => $id]);
	}
	
	// Create a new sub-category
	function eshop_create_subcategory($name, $cid){
		$slug = format_slug($name);
		\DB::Insert('eshop_subcategories', ['name' => $name, 'category_id' => $cid, 'slug_name' => $slug]);
		return \DB::$insert_id;
	}
	
	
	// Count sub-category per category
	function subcat_counting($id){
		$query = \DB::QueryAll("SELECT Count(*) AS nbr FROM eshop_subcategories WHERE category_id = :cid", [':cid' => $id]);
		return $query[0]['nbr'];
	}

	// Version compare
	function eshop_latest_version(){
		$json = file_get_contents('http://blog.evolution-network.ca/upload/admin/file/eshop_version.json');
		$json_data = json_decode($json, true);
		return $json_data;
	}

	function version_checker($latest){
		$plugin_version = get_eshop_settings()['plugin_version'];

		$latest = end(eshop_latest_version()['version']);

		$pv_level = array(
			"low" => "blue",
			"major" => "yellow",
			"critic" => "red"
		);
	
		$pv_ribbon = array(
			"low" => "Normal Update",
			"major" => "Major Update",
			"critic" => "Urgent Update"
		);

		$pv_ribbon_color = array(
			"low" => "blue",
			"major" => "orange",
			"critic" => "red"
		);

		$pv_msg = array (
			"low" => "The available update is considered minor. It is not required, but it improves your user experience.",
			"major" => "This update is recommended. It fixes several important issues and improves your user experience.",
			"critic" => "This update is necessary. It can correct some issues related to the security and integrity of your store. Read the changelog for more information."
		);

		if($latest['plugin_version'] > $plugin_version){
			echo '<div class="ui raised message ' . $pv_level[$latest["level"]] . ' segment"><a class="ui '. $pv_ribbon_color[$latest['level']] .' right ribbon label" style="float: none !important">'. $pv_ribbon[$latest['level']] .'</a>
				<div class="ui icon message">
					<i class="bug icon"></i>
					<div class="content">
						<div class="header">Your eSH0P plugin is out of date.</div>
						<p>' . $pv_msg[$latest["level"]] . '</p>
					</div>
				</div>
			</div>';
		}else{ 
			echo '<div class="ui raised message positive segment"><a class="ui green right ribbon label" style="float: none !important">All is perfect</a><div class="ui icon message"><i class="check circle outline icon"></i><div class="content"><div class="header">Your eSH0P plugin is up to date.</div><p>You are using the latest version of the currently available eSH0P plugin.</p></div></div></div>';
		}

	}