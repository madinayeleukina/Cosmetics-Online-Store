<?php
	//checks was session started by admin, if not so stops php script
	include "includes/authorization-admin.php";	

	//initializes session
	if (session_status() == PHP_SESSION_NONE) session_start();
	
	require_once "includes/utility-functions.php";

	$imgtmpname = $_FILES["image"]["tmp_name"];
	
	//updates banner image
	move_uploaded_file($imgtmpname,"img/homepage-banner.jpg");
	
	//redirects to homepage
	redirect("index.php",false);
?>