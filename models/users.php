<?php
	//initializes session
	if (session_status() == PHP_SESSION_NONE) session_start();
	
	//connects to database
	require_once "includes/db-connect.php";
	
	//logs in
	function login($email, $password) {
		if (!empty($email) && !empty($password)) {
			global $conn;
			
			$stmt = mysqli_prepare($conn, "SELECT userID, email, name, surname, hashedpassword, role FROM Users WHERE email = ?");
			mysqli_stmt_bind_param($stmt, "s", $email);
			
			$success = mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$row = mysqli_fetch_assoc($result);
			mysqli_stmt_close($stmt);
			
			if ($success && mysqli_num_rows($result)>0) {
				if (password_verify($password, $row["hashedpassword"])) {
					$_SESSION["userid"] = $row["userID"];
					$_SESSION["email"] = $row["email"];
					$_SESSION["name"] = $row["name"];
					$_SESSION["surname"] = $row["surname"];
					$_SESSION["role"] = $row["role"];
				}
				else 
					echo "Password or login is incorrect: ".$password;
			}
			else 
				echo "There is no such user";
			
			mysqli_close($conn);
		}
	}
	
	//logs out
	function logout() {
		session_unset();
		session_destroy();
	}
	
	//checks is user logged in
	function isUserLoggedIn() {
		$loggedIn = !empty($_SESSION["userid"]) && $_SESSION["userid"]>=0;
		return $loggedIn;
	}
	
	//returns role of user
	function getUserRole() {
		$userRole = "";
		
		if (!empty($_SESSION["role"])) {
			$userRole = $_SESSION["role"];
		}
		
		return $userRole;
	}
	
	//returns user
	function getLoggedInUser() {
		global $conn;
		
		$resultArr = false;
		
		if (!empty($_SESSION["userid"])) {
			$stmt = mysqli_prepare($conn,"SELECT * FROM Users WHERE userID = ?");
			mysqli_stmt_bind_param($stmt, "i", $_SESSION["userid"]);
			
			$success = mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			
			if ($success && mysqli_num_rows($result)>=0) 
				$resultArr = mysqli_fetch_all($result, MYSQLI_ASSOC);
		}
		
		return $resultArr;
	}
	
	//checks does user exist
	function isUserExists($email) {
		global $conn;
		
		$userExists = false;
		
		$stmt = mysqli_prepare($conn,"SELECT email FROM Users WHERE email = ?");
		mysqli_stmt_bind_param($stmt, "s", $email);
		
		$success = mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		mysqli_stmt_close($stmt);
		
		if ($success && mysqli_num_rows($result)>=1) $userExists = true;
		
		return $userExists;
	}
	
	//checks is user first
	function isFirstUser() {
		global $conn;
		
		$first = false;
		
		$stmt = mysqli_prepare($conn,"SELECT COUNT(*) AS numusers FROM Users");
		
		$success = mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		mysqli_stmt_close($stmt);
		
		if ($success && mysqli_num_rows($result)>=0) {
			$resultArr = mysqli_fetch_all($result, MYSQLI_ASSOC);
			if (!empty($resultArr[0]) && $resultArr[0]["numusers"]==0)
				$first = true;
		}
		
		return $first;
	}
	
	//returns all users
	function getUsers() {
		global $conn;
		
		$stmt = mysqli_prepare($conn,"SELECT * FROM Users");
		
		$success = mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		
		$resultArr = false;
		if ($success && mysqli_num_rows($result)>=0) 
			$resultArr = mysqli_fetch_all($result, MYSQLI_ASSOC);
		
		mysqli_stmt_close($stmt);
		
		return $resultArr;
	}
	
	//returns user
	function getUser($userID) {
		global $conn;
		
		$stmt = mysqli_prepare($conn,"SELECT * FROM Users WHERE userID = ?");
		mysqli_stmt_bind_param($stmt,"i",$userID);
		
		$success = mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		
		$resultArr = false;
		if ($success && mysqli_num_rows($result)>=0) 
			$resultArr = mysqli_fetch_all($result, MYSQLI_ASSOC);
		
		mysqli_stmt_close($stmt);
		
		return $resultArr;
	}
	
	//updates user
	function updateUser($userID, $name, $surname, $fathername, $email, $password, $country, $region, $city, $address, $telephonenumber, $role) {
		global $conn;
		
		$stmt = mysqli_prepare($conn, 
			"UPDATE Users
			SET name=?, surname=?, fatherName=?, email=?, hashedpassword=?, country=?, region=?, city=?, address=?, telephoneNumber=?, role=?
			WHERE usedID = ?");
		mysqli_stmt_bind_param($stmt, "sssssssssssi", $name, $surname, $fathername, $email, $password, $country, $region, $city, $address, $telephonenumber, $role, $userID);
		
		$success = mysqli_stmt_execute($stmt);
		
		mysqli_stmt_close($stmt);
		
		return $success;
	}
	
	//creates user
	function insertUser($name, $surname, $fathername, $email, $password, $country, $region, $city, $address, $telephonenumber, $role) {
		global $conn;
		
		$stmt = mysqli_prepare($conn, 
			"INSERT INTO Users (name,surname,fatherName,email,hashedpassword,country,region,city,address,telephoneNumber,role) 
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		mysqli_stmt_bind_param($stmt, "sssssssssss", $name, $surname, $fathername, $email, $password, $country, $region, $city, $address, $telephonenumber, $role);
		
		$success = mysqli_stmt_execute($stmt);
		
		mysqli_stmt_close($stmt);
		
		return $success;
	}
	
	//deletes user
	function deleteUser($userID) {
		global $conn;
		
		$stmt = mysqli_prepare($conn, "DELETE FROM Users WHERE userID = ?");
		mysqli_stmt_bind_param($stmt, "i", $userID);
		
		$success = mysqli_stmt_execute($stmt);
		
		mysqli_stmt_close($stmt);
		
		return $success;
	}
	
?>