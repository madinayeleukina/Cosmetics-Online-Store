<?php
	//initializes session
	if (session_status() == PHP_SESSION_NONE) session_start();
	
	require_once "models/users.php";
	require_once "includes/utility-functions.php";
	
	//logs out
	logout();
	
	//redirects to homepage
	redirect("index.php",false);
?>