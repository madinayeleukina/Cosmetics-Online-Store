<?php
	//checks was session started by admin, if not so stops php script
	include "includes/authorization-admin.php";	
	
	//initializes session
	if (session_status() == PHP_SESSION_NONE) session_start();
	
	require_once "includes/utility-functions.php";
	require_once "models/orders.php";
	
	//checks is there orderid, if so deletes order and its items
	if (!empty($_GET["orderid"])) {
		deleteOrderItems($_GET["orderid"]);
		deleteOrder($_GET["orderid"]);
	}
	
	//redirecrs to sales page
	redirect("sales.php",false);
?>