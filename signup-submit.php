<?php
	//initializes session
	if (session_status() == PHP_SESSION_NONE) session_start();
	
	require_once "includes/utility-functions.php";
	require_once "models/users.php";
	
	//checks does password meet requirments, if not so prints message. checks does user exists, if so prints message else signs up
	if (strlen($_POST["password"])>=6 && $_POST["password"]==$_POST["repeatpassword"]) {
			
		if (!isUserExists($_POST["email"])) {
			$hashedpassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
			$role = isFirstUser() ? "admin" : "user";
			
			$success = insertUser($_POST["name"], $_POST["surname"], $_POST["fathername"], $_POST["email"], $hashedpassword, $_POST["country"], $_POST["region"], 
									$_POST["city"], $_POST["address"], $_POST["mobilenumber"], $role);
	
			if ($success) {
				login($_POST["email"], $_POST["password"]);
				redirect("index.php", false);
			}
			else {
				echo "Sorry, there are some server problems:( Please, try again later.";
				redirect("index.php", true);
			}
		}
		else {
			echo "There is an user with the same email.";
			redirect("signup-form.php", true);
		}
	}
	else {
		echo "Some of the fields are empty or the password's length is less than 6 or passwords don't match";
		redirect("signup-form.php", true);
	}
?>