<?php
	//connects to database
	require_once "includes/db-connect.php";
	
	//returns items in basket
	function getBasketItems() {
		$resultArr = false;
		
		if (!empty($_SESSION["basket"])) {
			global $conn;
			
			$items = implode(", ", array_keys($_SESSION["basket"]));
			
			$stmt = mysqli_prepare($conn,
				"SELECT *, Items.name AS itemname, Companies.name AS companyname
				FROM Items 
				INNER JOIN Companies ON Items.companyID = Companies.companyID 
				INNER JOIN Categories ON Items.categoryID = Categories.categoryID
				WHERE Items.itemID IN (".$items.") ORDER BY itemID DESC");
			
			$success = mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			
			if ($success && mysqli_num_rows($result)>=0) 
				$resultArr = mysqli_fetch_all($result, MYSQLI_ASSOC);
			
			mysqli_stmt_close($stmt);
		}
		
		return $resultArr;
	}
	
	//returns all items with full details
	function getItemsCompaniesCategories($type) {
		global $conn;
		
		$stmt = mysqli_prepare($conn,
			"SELECT *, Items.name AS itemname, Companies.name AS companyname
			FROM Items 
			INNER JOIN Companies ON Items.companyID = Companies.companyID 
			INNER JOIN Categories ON Items.categoryID = Categories.categoryID
			WHERE Categories.type=? ORDER BY itemID DESC");
		mysqli_stmt_bind_param($stmt,"s",$type);
		
		$success = mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		
		$resultArr = false;
		if ($success && mysqli_num_rows($result)>=0) 
			$resultArr = mysqli_fetch_all($result, MYSQLI_ASSOC);
		
		mysqli_stmt_close($stmt);
		
		return $resultArr;
	}
	
	//returns all items
	function getItems() {
		global $conn;
		
		$stmt = mysqli_prepare($conn,"SELECT * FROM Items ORDER BY itemID DESC");
		
		$success = mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		
		$resultArr = false;
		if ($success && mysqli_num_rows($result)>=0) 
			$resultArr = mysqli_fetch_all($result, MYSQLI_ASSOC);
		
		mysqli_stmt_close($stmt);
		
		return $resultArr;
	}
	
	//returns item
	function getItem($itemID) {
		global $conn;
		
		$stmt = mysqli_prepare($conn,"SELECT * FROM Items WHERE itemID = ?");
		mysqli_stmt_bind_param($stmt,"i",$itemID);
		
		$success = mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		
		$resultArr = false;
		if ($success && mysqli_num_rows($result)>=0) 
			$resultArr = mysqli_fetch_all($result, MYSQLI_ASSOC);
		
		mysqli_stmt_close($stmt);
		
		return $resultArr;
	}
	
	//updates item
	function updateItem($itemID, $name, $price, $quantity, $photo, $description, $companyID, $categoryID) {
		global $conn;
		
		if (!empty($photo)) {
			$stmt = mysqli_prepare($conn, 
				"UPDATE Items 
				SET name=?,price=?,quantity=?,photo=?,description=?,companyID=?,categoryID=?
				WHERE itemID = ?");
			mysqli_stmt_bind_param($stmt, "sdissiii", $name, $price, $quantity, $photo, $description, $companyID, $categoryID, $itemID);
		} else {
			$stmt = mysqli_prepare($conn, 
				"UPDATE Items 
				SET name=?,price=?,quantity=?,description=?,companyID=?,categoryID=?
				WHERE itemID = ?");
			mysqli_stmt_bind_param($stmt, "sdisiii", $name, $price, $quantity, $description, $companyID, $categoryID, $itemID);
		}
		
		$success = mysqli_stmt_execute($stmt);
		
		mysqli_stmt_close($stmt);
		
		return $success;
	}
	
	//creates new item
	function insertItem($name, $price, $quantity, $photo, $description, $companyID, $categoryID) {
		global $conn;
		
		$stmt = mysqli_prepare($conn, 
			"INSERT INTO Items (name,price,quantity,photo,description,companyID,categoryID) 
			VALUES (?, ?, ?, ?, ?, ?, ?)");
		mysqli_stmt_bind_param($stmt, "sdissii", $name, $price, $quantity, $photo, $description, $companyID, $categoryID);
		
		$success = mysqli_stmt_execute($stmt);
		
		mysqli_stmt_close($stmt);
		
		return $success;
	}
	
	//deletes item
	function deleteItem($itemID) {
		global $conn;
		
		$stmt = mysqli_prepare($conn, "DELETE FROM Items WHERE itemID = ?");
		mysqli_stmt_bind_param($stmt, "i", $itemID);
		
		$success = mysqli_stmt_execute($stmt);
		
		mysqli_stmt_close($stmt);
		
		return $success;
	}
	
?>