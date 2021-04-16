<?php

function eshop_ajax_return_success($data) {
	die(json_encode(['success' => true] + (array)$data));
}

function eshop_ajax_return_error($error) {
	die(json_encode(['success' => false, 'error' => $error]));
}

// SEND an Answer to a ticket
if (App::POST('action') === 'send_answer_assigned') {
	$action = send_answer_assigned_btn($_POST['tid'], $_POST["msg"]);
	if ($action) {
		eshop_ajax_return_success($action);
	} else {
		eshop_ajax_return_error("Not found");
	}
}

if (App::POST('action') === 'mark_solved') {
	$action = mark_solved($_POST['tid']);
	if ($action) {
		eshop_ajax_return_success($action);
	} else {
		eshop_ajax_return_error("Not found");
	}
}

if (App::POST('action') === 'mark_unsolved') {
	$action = mark_unsolved($_POST['tid']);
	if ($action) {
		eshop_ajax_return_success($action);
	} else {
		eshop_ajax_return_error("Not found");
	}
}

if (App::POST('action') === 'delete_ticket') {
	$action = delete_ticket($_POST['tid']);
	if ($action) {
		eshop_ajax_return_success($action);
	} else {
		eshop_ajax_return_error("Not found");
	}
}

if (App::POST('action') === 'solved_ticket') {
	$action = mark_solved($_POST['tid']);
	if ($action) {
		eshop_ajax_return_success($action);
	} else {
		eshop_ajax_return_error("Not found");
	}
}

exit;