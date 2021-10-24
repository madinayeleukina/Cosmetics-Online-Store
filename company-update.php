<?php
	//checks was field filled, if so creates category
	include "includes/authorization-admin.php";	

	//initializes session
	if (session_status() == PHP_SESSION_NONE) session_start();
	
	require_once "includes/utility-functions.php";
	require_once "models/companies.php";
	
	//updates company
	updateCompany($_GET["companyid"],$_POST["company"],$_POST["country"]);
	
	//redirects to companies page
	redirect("companies.php",false);
?>
