<?php
	//connects to database
	require_once "includes/db-connect.php";
	
	//returns categories of certain type
	function getCategories($type) {
		global $conn;
		
		$stmt = mysqli_prepare($conn,"SELECT * FROM Categories WHERE type=?");
		mysqli_stmt_bind_param($stmt,"s",$type);
		
		$success = mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		
		$resultArr = false;
		if ($success && mysqli_num_rows($result)>=0) 
			$resultArr = mysqli_fetch_all($result, MYSQLI_ASSOC);
		
		mysqli_stmt_close($stmt);
		
		return $resultArr;
	}
	
	//returns all categories
	function getAllCategories() {
		global $conn;
		
		$stmt = mysqli_prepare($conn,"SELECT * FROM Categories");
		
		$success = mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		
		$resultArr = false;
		if ($success && mysqli_num_rows($result)>=0) 
			$resultArr = mysqli_fetch_all($result, MYSQLI_ASSOC);
		
		mysqli_stmt_close($stmt);
		
		return $resultArr;
	}
	
	//returns category
	function getCategory($categoryID) {
		global $conn;
		
		$stmt = mysqli_prepare($conn,"SELECT * FROM Categories WHERE categoryID = ?");
		mysqli_stmt_bind_param($stmt,"i",$categoryID);
		
		$success = mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		
		$resultArr = false;
		if ($success && mysqli_num_rows($result)>=0) 
			$resultArr = mysqli_fetch_all($result, MYSQLI_ASSOC);
		
		mysqli_stmt_close($stmt);
		
		return $resultArr;
	}
	
	//updates category
	function updateCategory($categoryID, $category, $type) {
		global $conn;
		
		$stmt = mysqli_prepare($conn, 
			"UPDATE Categories
			SET category = ?, type = ?
			WHERE categoryID = ?");
		mysqli_stmt_bind_param($stmt, "ssi", $category, $type, $categoryID);
		
		$success = mysqli_stmt_execute($stmt);
		
		mysqli_stmt_close($stmt);
		
		return $success;
	}
	
	//creates new category
	function insertCategory($category, $type) {
		global $conn;
		
		$stmt = mysqli_prepare($conn, 
			"INSERT INTO Categories (category, type) 
			VALUES (?,?)");
		mysqli_stmt_bind_param($stmt, "ss", $category, $type);
		
		$success = mysqli_stmt_execute($stmt);
		
		mysqli_stmt_close($stmt);
		
		return $success;
	}
	
	//deletes category
	function deleteCategory($categoryID) {
		global $conn;
		
		$stmt = mysqli_prepare($conn, "DELETE FROM Categories WHERE categoryID = ?");
		mysqli_stmt_bind_param($stmt, "i", $categoryID);
		
		$success = mysqli_stmt_execute($stmt);
		
		mysqli_stmt_close($stmt);
		
		return $success;
	}
	
?>