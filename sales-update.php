<?php
	//checks was session started by admin, if not so stops php script
	include "includes/authorization-admin.php";	

	//initializes session
	if (session_status() == PHP_SESSION_NONE) session_start();
	
	require_once "includes/utility-functions.php";
	require_once "models/orders.php";

	//checks is checkbox checked, if so completes order else incompletes order
	if (empty($_POST["isreceived"])) {
		completeOrder($_GET["orderid"],false);
	}
	else {
		completeOrder($_GET["orderid"],true);
	}
	
	//redirects to sales page
	redirect("sales.php",false);
	
?>