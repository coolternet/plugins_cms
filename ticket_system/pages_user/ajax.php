<?php

function eshop_ajax_return_success($data) {
	die(json_encode(['success' => true] + (array)$data));
}

function eshop_ajax_return_error($error) {
	die(json_encode(['success' => false, 'error' => $error]));
}

// Create a new ticket
if (App::POST('action') === 'create_new_ticket_btn') {
	$action = create_new_ticket($_POST['subject'], $_POST["content"]);
	if ($action) {
		eshop_ajax_return_success(['id' => $action]);
	} else {
		eshop_ajax_return_error("Not found");
	}
}

// Send answer to a ticket
if (App::POST('action') === 'send_answer_btn') {
	$action = send_answer($_POST['ticket_id'], $_POST['comment']);
	if ($action) {
		eshop_ajax_return_success($action);
	} else {
		eshop_ajax_return_error("Not found");
	}
}

// Close a ticket
if (App::POST('action') === 'close_ticket_btn') {
	$action = close_ticket($_POST['ticket_id']);
	if ($action) {
		eshop_ajax_return_success($action);
	} else {
		eshop_ajax_return_error("Not found");
	}
}

// Delete a ticket
if (App::POST('action') === 'delete_ticket_btn') {
	$action = delete_ticket($_POST['ticket_id']);
	if ($action) {
		eshop_ajax_return_success($action);
	} else {
		eshop_ajax_return_error("Not found");
	}
}

exit;