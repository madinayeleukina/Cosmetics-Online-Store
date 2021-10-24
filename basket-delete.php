<?php
	//initializes session
	if (session_status() == PHP_SESSION_NONE) session_start();
	require_once "includes/utility-functions.php";
	
	$result = "false";
	
	//checks are there items in basket, if so deletes them
	if (!empty($_GET["itemid"]) && !empty($_SESSION["basket"]) && array_key_exists($_GET["itemid"],$_SESSION["basket"])) {
		unset($_SESSION["basket"][$_GET["itemid"]]);
		$result = "true";                                                 
	}

	echo $result;
?>