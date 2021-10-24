<?php
	//checks was session started by admin, if not so stops php script
	include "includes/authorization-admin.php";	

	//initializes session
	if (session_status() == PHP_SESSION_NONE) session_start();
	
	require_once "includes/utility-functions.php";
	require_once "models/companies.php";
	
	//deletes company
	deleteCompany($_GET["companyid"]);
	
	//redirects to companies page
	redirect("companies.php",false);
?>
