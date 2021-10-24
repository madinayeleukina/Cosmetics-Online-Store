<?php
	//checks was session started by admin, if not so stops php script
	include "includes/authorization-admin.php";	

	//initializes session
	if (session_status() == PHP_SESSION_NONE) session_start();
	
	require_once "includes/utility-functions.php";
	require_once "models/items.php";
	
	$res = getItem($_GET["itemid"]);
	$row = $res[0];
	
	//updates item
	if (empty($_FILES['photo']['tmp_name'])) {
		updateItem($_GET["itemid"],$_POST["name"], $_POST["price"], $_POST["quantity"], $_FILES['photo']['tmp_name'], $_POST["description"], $_POST["companyid"], $_POST["categoryid"]);		
	} else {
		updateItem($_GET["itemid"],$_POST["name"], $_POST["price"], $_POST["quantity"], file_get_contents($_FILES['photo']['tmp_name']), $_POST["description"], $_POST["companyid"], $_POST["categoryid"]);
	}
	
	//returns to previous page
	redirect($_GET["from"],false);
?>
