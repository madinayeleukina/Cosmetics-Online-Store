<?php
	//checks was session started by admin, if not so stops php script
	include "includes/authorization-admin.php";	

	//initializes session
	if (session_status() == PHP_SESSION_NONE) session_start();
	
	require_once "includes/utility-functions.php";
	require_once "models/companies.php";
	
	//checks was field filled, if so creates company
	if (!empty($_POST["company"])) 
		insertCompany($_POST["company"],$_POST["country"]);
	
	//redirects to companies page
	redirect("companies.php",false);
?>
