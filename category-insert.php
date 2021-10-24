<?php
	//checks was session started by admin, if not so stops php script
	include "includes/authorization-admin.php";	
	
	//initializes session
	if (session_status() == PHP_SESSION_NONE) session_start();
	
	require_once "includes/utility-functions.php";
	require_once "models/categories.php";
	
	//checks is field filled, if so creates category
	if (!empty($_POST["category"])) 
		insertCategory($_POST["category"], $_GET["type"]);
	
	//redirects to categories page
	redirect("categories.php",false);
?>
