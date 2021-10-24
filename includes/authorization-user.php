<?php
	//initializes session
	if (session_status() == PHP_SESSION_NONE) session_start();
	
	//checks was session started by user, if not so prints message
	if (empty($_SESSION["userid"]) || $_SESSION["role"]!="user")
		die("You don't have access");
?>