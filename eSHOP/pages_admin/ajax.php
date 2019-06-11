<?php

if (_GET('action') === 'customer_profil') {
	$customer_profil = get_customer($_GET['id']);
	$profils = json_encode($customer_profil);
	echo $profils;
}

if (_GET('action') === 'system_activity') {
	$system_activity = evocms_log($_GET['id']);
	$sys_activity = json_encode($system_activity);
	echo $sys_activity;
}

if (_GET('action') === 'customer_activity') {
	$eshop_activity = eshop_log_query($_GET['id']);
	$eactivity = json_encode($eshop_activity);
	echo $eactivity;
}

if (_POST('action') === 'customer_save_profil') {
	
	function save_profil_admin($uid){
		
		$fname      = $_POST['first_name'];
		$lname      = $_POST['last_name'];
		$email      = $_POST['email'];
		$address    = $_POST['address'];
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
	
	$update_profil = save_profil_admin($_GET['id']);
	$action = json_encode($update_profil);
	echo $action;
	
}

/*
if ($_GET['action'] === 'autre_chose') {
	echo autre_chose($_GET['id']);
}
*/

exit;