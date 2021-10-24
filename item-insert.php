<?php
	//checks was session started by admin, if not so stops php script
	include "includes/authorization-admin.php";	

	//initializes session
	if (session_status() == PHP_SESSION_NONE) session_start();
	
	require_once "includes/utility-functions.php";
	require_once "models/items.php";
	
	//creates new item
	insertItem($_POST["name"], $_POST["price"], $_POST["quantity"], file_get_contents($_FILES['photo']['tmp_name']), $_POST["description"], $_POST["companyid"], $_POST["categoryid"]);
	
	$from = $_GET["from"].".php";
	
	//returns to previous page
	redirect($from,false);
?>
