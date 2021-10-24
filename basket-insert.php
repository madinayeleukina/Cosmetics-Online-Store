<?php
	//initializes session
	if (session_status() == PHP_SESSION_NONE) session_start();
	require_once "includes/utility-functions.php";
	
	$result = "false";
	
	//checks was number defined, if so adds several items to basket else adds one item to basket
	if (!empty($_GET["itemid"])) {
		if (empty($_SESSION["basket"])) $_SESSION["basket"] = [];
		
		if (empty($_GET["number"])) {
			if (!array_key_exists($_GET["itemid"],$_SESSION["basket"])) {
				$_SESSION["basket"][$_GET["itemid"]] = 1;
			}
			else {
				$_SESSION["basket"][$_GET["itemid"]]++;
			}
		}
		else {
			if (!array_key_exists($_GET["itemid"],$_SESSION["basket"])) {
				$_SESSION["basket"][$_GET["itemid"]] = $_GET["number"];
			}
			else {
				$_SESSION["basket"][$_GET["itemid"]]+= $_GET["number"];
			}
		}
		
		
		$result = "true";                                                         
	}

	echo $result;
?>