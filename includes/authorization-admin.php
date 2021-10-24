<?php
	//initializes session
	if (session_status() == PHP_SESSION_NONE) session_start();
	
	//checks was session started by admin, if not so prints message
	if (empty($_SESSION["userid"]) || $_SESSION["role"]!="admin")
		die("You don't have access");
?>