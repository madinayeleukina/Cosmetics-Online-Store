<?php
	//checks was session started by admin, if not so stops php script
	include "includes/authorization-admin.php";	

	//initializes session
	if (session_status() == PHP_SESSION_NONE) session_start();
	
	require_once "includes/utility-functions.php";
	require_once "models/categories.php";
	
	$res = getCategory($_GET["categoryid"]);
	$row = $res[0];
	
	//updates category
	updateCategory($row["categoryID"],$_POST["category"],$row["type"]);
	
	//redirects to categories page
	redirect("categories.php",false);
?>
