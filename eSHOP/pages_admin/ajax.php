<?php

function eshop_ajax_return_success($data) {
	die(json_encode(['success' => true] + (array)$data));
}

function eshop_ajax_return_error($error) {
	die(json_encode(['success' => false, 'error' => $error]));
}


if (_GET('action') === 'customer_profil') {
	$customer_profil = get_customer($_GET['id']);
	eshop_ajax_return_success($customer_profil);
}


// DEFAULT CURRENCY CHANGER
if (_POST('action') === 'update_default_currency') {
	$update_default_currency = update_default_currency($_POST['shop_currency_default']);
	if ($update_default_currency) {
		eshop_ajax_return_success($update_default_currency);
	} else {
		eshop_ajax_return_error("Not found");
	}
}


// TAX CHARGE MANAGEMENT

if (_POST('action') === 'create_tax') {
	$addtax = eshop_create_taxe($_POST['name'], $_POST['code'], $_POST['rate'], $_POST['tnumber']);
	if ($addtax) {
		eshop_ajax_return_success(['id' => $addtax]);
	} else {
		eshop_ajax_return_error("Not found");
	}
}


if (_POST('action') === 'remove_tax') {
	$deltax = eshop_delete_taxe($_POST['id']);
	if ($deltax) {
		eshop_ajax_return_success($deltax);
	} else {
		eshop_ajax_return_error("Not found");
	}
}


if (_GET('action') === 'get_taxe') {
	$gettax = eshop_get_taxe($_GET['id']);
	if ($gettax) {
		eshop_ajax_return_success($gettax);
	} else {
		eshop_ajax_return_error("Not found");
	}
}

if (_GET('action') === 'get_taxes') {
	$gettaxes = eshop_taxes();
	if ($gettaxes) {
		eshop_ajax_return_success($gettaxes);
	} else {
		eshop_ajax_return_error("Not found");
	}
}

if (_POST('action') === 'save_tax') {
	$settax = eshop_edit_taxe($_POST['id'], $_POST['name'], $_POST['code'], $_POST['rate'], $_POST['tnumber']);
	if ($settax) {
		eshop_ajax_return_success($settax);
	} else {
		eshop_ajax_return_error("Not found");
	}
}

// Create a new categories
if (_POST('action') === 'create_category') {
	$addcat = eshop_create_category($_POST['name']);
	if ($addcat) {
		eshop_ajax_return_success(['id' => $addcat, 'name' => $addcat]);
	} else {
		eshop_ajax_return_error("Not found");
	}
}

// Update category
if (_POST('action') === 'update_category') {
	$savecat = eshop_update_category($_POST['id'], $_POST['name']);
	if ($savecat) {
		eshop_ajax_return_success($savecat);
	} else {
		eshop_ajax_return_error("Not found");
	}
}

// Get one Category
if (_GET('action') === 'get_category') {
	$getcat = eshop_get_category($_GET['id']);
	if ($getcat) {
		eshop_ajax_return_success($getcat);
	} else {
		eshop_ajax_return_error("Not found");
	}
}

// Delete a Categories
if (_POST('action') === 'delete_category') {
	$delcat = eshop_delete_category($_POST['id']);
	if ($delcat) {
		eshop_ajax_return_success($delcat);
	} else {
		eshop_ajax_return_error("Not found");
	}
}

// Create Sub-Categories
if (_POST('action') === 'create_subcategory') {
	$newsubcat = eshop_create_subcategory($_POST['name'], $_POST['subcatid']);
	if ($newsubcat) {
		eshop_ajax_return_success(['id' => $newsubcat]);
	} else {
		eshop_ajax_return_error("Not found");
	}
}

/////////////////////////////////////////////////////////////////////////////////////////////////
if (_GET('action') === 'system_activity') {
	$system_activity = evocms_log($_GET['id']);
	eshop_ajax_return_success($system_activity);
}

if (_GET('action') === 'customer_activity') {
	$eshop_activity = eshop_log_query($_GET['id']);
	eshop_ajax_return_success($eshop_activity);
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
	eshop_ajax_return_success($update_profil);
}

exit;