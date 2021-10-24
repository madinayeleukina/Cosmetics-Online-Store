<?php
	//checks was session started by admin, if not so stops php script
	include "includes/authorization-admin.php";	

	//initializes session
	if (session_status() == PHP_SESSION_NONE) session_start();
	
	require_once "includes/utility-functions.php";
	require_once "models/categories.php";
	
	//deletes category
	deleteCategory($_GET["categoryid"]);
	
	//redirects to categories page
	redirect("categories.php",false);
?>
