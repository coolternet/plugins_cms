<?php

function eshop_ajax_return_success($data) {
	die(json_encode(['success' => true] + (array)$data));
}

function eshop_ajax_return_error($error) {
	die(json_encode(['success' => false, 'error' => $error]));
}


// Save Customer's profil Modal
if (_POST('action') === 'save_customer_profil') {
	$setuser = set_customer($_POST['uid'],$_POST['first_name'],$_POST['last_name'],$_POST['address'],$_POST['apt'],$_POST['city'],$_POST['state'],$_POST['zip'],$_POST['phone'],$_POST['country'],$_POST['email'],$_POST['currency']);
	if ($setuser) {
		eshop_ajax_return_success($setuser);
	} else {
		eshop_ajax_return_error("Not found");
	}
}

// Delete customers
if (_POST('action') === 'del_customer') {
	$deluser = del_customer($_POST['uid']);
	if ($deluser) {
		eshop_ajax_return_success($deluser);
	} else {
		eshop_ajax_return_error("Not found");
	}
}

// Button random password for Customer
if (_POST('action') === 'customer_regenpassword') {
	$password = password_customer($_POST['id']);
	if ($password) {
		eshop_ajax_return_success($password);
	} else {
		eshop_ajax_return_error("Not found");
	}
}

// Get Customer's information Modal
if (_GET('action') === 'get_customer_profil') {
	$getuser = get_customer_profil($_GET['uid']);
	if ($getuser) {
		eshop_ajax_return_success($getuser);
	} else {
		eshop_ajax_return_error("Not found");
	}
}


// DEFAULT CURRENCY CHANGER
if (_POST('action') === 'change_default_currency') {
	$change = change_default_currency($_POST['shop_currency_default']);
	if ($change) {
		eshop_ajax_return_success($change);
	} else {
		eshop_ajax_return_error("Not found");
	}
}

// Update Currency's rate
if (_POST('action') === 'update_currency_rate') {
	$update = update_currency_rate();
	if ($update) {
		eshop_ajax_return_success($update);
	} else {
		eshop_ajax_return_error("Not found");
	}
}

// Return all currency's rate after rate's update
if (_GET('action') === 'get_rates') {
	$get_rates = get_eshop_currency();
	if ($get_rates) {
		eshop_ajax_return_success($get_rates);
	} else {
		eshop_ajax_return_error("Not found");
	}
}

// Uptade Global Company's information
	if (_POST('action') === 'save_company_global') {
		$update = save_company_global($_POST['shop_name'],$_POST['shop_contractor'],$_POST['shop_address'],$_POST['shop_city'],$_POST['shop_zip'],$_POST['shop_state'],$_POST['shop_country'],$_POST['shop_phone'],$_POST['shop_business_mail'],$_POST['shop_vat']);
		if ($update) {
			eshop_ajax_return_success($update);
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
		eshop_ajax_return_success(['id' => $addcat]);
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

// Get all Category
if (_GET('action') === 'get_categories') {
	$getcat = eshop_get_categories();
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
	$newsubcat = eshop_create_subcategory($_POST['name'], $_POST['cid']);
	if ($newsubcat) {
		eshop_ajax_return_success(['id' => $newsubcat]);
	} else {
		eshop_ajax_return_error("Not found");
	}
}


// get All Sub-Categories
if (_GET('action') === 'get_subcategory') {
	$getsubcat = eshop_get_subcategories();
	if ($getsubcat) {
		eshop_ajax_return_success($getsubcat);
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

exit;