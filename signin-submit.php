<?php
	//initializes session
	if (session_status() == PHP_SESSION_NONE) session_start();
	
	require_once "includes/utility-functions.php";
	require_once "models/users.php";
	
	//checks were all fields filled, if so logs in
	if (!empty($_POST["email"]) && !empty($_POST["password"])) login($_POST["email"], $_POST["password"]);
	
	//redirects to homepage
	redirect("index.php", false);
?>