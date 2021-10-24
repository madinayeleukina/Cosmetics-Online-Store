<?php
	//connects to database
	require_once "includes/db-connect.php";
	
	//returns all companies
	function getCompanies() {
		global $conn;
		
		$stmt = mysqli_prepare($conn,"SELECT * FROM Companies");
		
		$success = mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		
		$resultArr = false;
		if ($success && mysqli_num_rows($result)>=0) 
			$resultArr = mysqli_fetch_all($result, MYSQLI_ASSOC);
		
		mysqli_stmt_close($stmt);
		
		return $resultArr;
	}
	
	//returns company
	function getCompany($companyID) {
		global $conn;
		
		$stmt = mysqli_prepare($conn,"SELECT * FROM Companies WHERE companyID = ?");
		mysqli_stmt_bind_param($stmt,"i",$companyID);
		
		$success = mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		
		$resultArr = false;
		if ($success && mysqli_num_rows($result)>=0) 
			$resultArr = mysqli_fetch_all($result, MYSQLI_ASSOC);
		
		mysqli_stmt_close($stmt);
		
		return $resultArr;
	}
	
	//updates company
	function updateCompany($companyID, $name, $country) {
		global $conn;
		
		$stmt = mysqli_prepare($conn, 
			"UPDATE Companies
			SET name = ?, country = ?
			WHERE companyID = ?");
		mysqli_stmt_bind_param($stmt, "ssi", $name, $country, $companyID);
		
		$success = mysqli_stmt_execute($stmt);
		
		mysqli_stmt_close($stmt);
		
		return $success;
	}
	
	//creates new company
	function insertCompany($name, $country) {
		global $conn;
		
		$stmt = mysqli_prepare($conn, 
			"INSERT INTO Companies (name, country) 
			VALUES (?, ?)");
		mysqli_stmt_bind_param($stmt, "ss", $name, $country);
		
		$success = mysqli_stmt_execute($stmt);
		
		mysqli_stmt_close($stmt);
		
		return $success;
	}
	
	//deletes company
	function deleteCompany($companyID) {
		global $conn;
		
		$stmt = mysqli_prepare($conn, "DELETE FROM Companies WHERE companyID = ?");
		mysqli_stmt_bind_param($stmt, "i", $companyID);
		
		$success = mysqli_stmt_execute($stmt);
		
		mysqli_stmt_close($stmt);
		
		return $success;
	}
	
?>