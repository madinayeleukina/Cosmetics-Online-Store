<?php
	//connects to database
	require_once "includes/db-connect.php";
	
	//returns all orders with full details
	function getOrdersDetails() {
		global $conn;
		
		$stmt = mysqli_prepare($conn,
		"SELECT Orders.orderID, Users.userID, date_format(Orders.orderDate,'%Y-%m-%d') AS orderDate, Orders.completionDate, CONCAT(Users.name,' ',Users.surname) AS customer, SUM(Items.price) AS amount 
		FROM ((Items INNER JOIN OrdersItems ON Items.itemID = OrdersItems.itemID) 
			INNER JOIN Orders ON OrdersItems.orderID = Orders.orderID) 
			INNER JOIN Users ON Orders.userID = Users.userID 
		GROUP BY Orders.orderID
		ORDER BY Orders.orderID DESC");
		
		$success = mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		
		$resultArr = false;
		if ($success && mysqli_num_rows($result)>=0) 
			$resultArr = mysqli_fetch_all($result, MYSQLI_ASSOC);
		
		return $resultArr;
	}
	
	//returns total amount of order
	function getOrderTotals($orderid) {
		global $conn;
		
		$stmt = mysqli_prepare($conn,
		"SELECT (SUM(Items.price)) AS totalprice
		FROM (Orders INNER JOIN OrdersItems ON Orders.orderID = OrdersItems.orderID) INNER JOIN Items ON OrdersItems.itemID = Items.itemID
		WHERE Orders.orderID = ?");
		mysqli_stmt_bind_param($stmt, "i", $orderid);
		
		$success = mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		
		$resultArr = false;
		if ($success && mysqli_num_rows($result)>=0) 
			$resultArr = mysqli_fetch_all($result, MYSQLI_ASSOC);
		
		return $resultArr;
	}
	
	//returns items of order
	function getOrdersItems($orderid) {
		global $conn;
		
		$stmt = mysqli_prepare($conn,
			"SELECT Items.itemID, Items.name AS itemname, OrdersItems.number, Items.price
			FROM (Orders 
			INNER JOIN OrdersItems ON Orders.orderID = OrdersItems.orderID)
			INNER JOIN Items ON OrdersItems.itemID = Items.itemID
			WHERE Orders.orderID = ? GROUP BY itemID");
		mysqli_stmt_bind_param($stmt, "i", $orderid);
		
		$success = mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		
		$resultArr = false;
		if ($success && mysqli_num_rows($result)>=0) 
			$resultArr = mysqli_fetch_all($result, MYSQLI_ASSOC);
		
		return $resultArr;		
	}
	
	//creates new order, adds items of order
	function checkout() {
		$orderid = -1;
		
		if (!empty($_SESSION["basket"]) && !empty($_SESSION["userid"]) && !empty($_SESSION["role"]) && $_SESSION["role"]=="user") {
			$userid = $_SESSION["userid"];
			
			global $conn;
			
			$stmt = mysqli_prepare($conn, "INSERT INTO Orders (userID, orderDate) VALUES (?, NOW())");
			mysqli_stmt_bind_param($stmt, "i", $userid);
			
			$success = mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			
			if ($success) {
				$orderid = mysqli_insert_id($conn);
				
				foreach(array_keys($_SESSION["basket"]) as $itemid) {
					$st = mysqli_prepare($conn, "INSERT INTO OrdersItems (orderID, itemID, number) VALUES (?, ?, ?)");
					mysqli_stmt_bind_param($st, "iii", $orderid, $itemid, $_SESSION["basket"][$itemid]);
					$succ = mysqli_stmt_execute($st);
					if (!$succ) {break; $orderid=-2;}
					
					
					$st = mysqli_prepare($conn, "UPDATE Items SET quantity = quantity-? WHERE itemID=?");
					mysqli_stmt_bind_param($st, "ii", $_SESSION["basket"][$itemid], $itemid);
					$succ = mysqli_stmt_execute($st);
					if (!$succ) {break; $orderid=-2;}
				}
				
				unset($_SESSION["basket"]);			
			}
			
		}
		
		return $orderid;
	}
	
	//returns all orders
	function getOrders() {
		global $conn;
		
		$stmt = mysqli_prepare($conn,"SELECT * FROM Orders");
		
		$success = mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		
		$resultArr = false;
		if ($success && mysqli_num_rows($result)>=0) 
			$resultArr = mysqli_fetch_all($result, MYSQLI_ASSOC);
		
		mysqli_stmt_close($stmt);
		
		return $resultArr;
	}
	
	//returns order
	function getOrder($orderID) {
		global $conn;
		
		$stmt = mysqli_prepare($conn,"SELECT * FROM Orders WHERE orderID = ?");
		mysqli_stmt_bind_param($stmt,"i",$orderID);
		
		$success = mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		
		$resultArr = false;
		if ($success && mysqli_num_rows($result)>=0) 
			$resultArr = mysqli_fetch_all($result, MYSQLI_ASSOC);
		
		mysqli_stmt_close($stmt);
		
		return $resultArr;
	}
	
	//updates completionDate of order
	function completeOrder($orderID,$completed) {
		global $conn;
		$stmt = "";
		
		if ($completed==true) {
			$stmt = mysqli_prepare($conn, 
				"UPDATE Orders
				SET completionDate=NOW()
				WHERE orderID = ?");
		}
		else {
			$stmt = mysqli_prepare($conn, 
				"UPDATE Orders
				SET completionDate=NULL
				WHERE orderID = ?");
		}
		mysqli_stmt_bind_param($stmt, "i", $orderID);
		$success = mysqli_stmt_execute($stmt);
		
		mysqli_stmt_close($stmt);
		
		return $success;
	}
	
	//updates order
	function updateOrder($orderID, $userID, $orderdate, $completiondate) {
		global $conn;
		
		$stmt = mysqli_prepare($conn, 
			"UPDATE Orders
			SET userID=?, orderDate=?, completionDate=?
			WHERE orderID = ?");
		mysqli_stmt_bind_param($stmt, "issi", $userID, $orderdate, $completiondate, $orderID);
		
		$success = mysqli_stmt_execute($stmt);
		
		mysqli_stmt_close($stmt);
		
		return $success;
	}
	
	/*
	function insertOrder($userID, $orderdate, $completiondate) {
		global $conn;
		
		$stmt = mysqli_prepare($conn, 
			"INSERT INTO Orders (userID, orderDate, completionDate) 
			VALUES (?, ?, ?)");
		mysqli_stmt_bind_param($stmt, "iss", $userID, $orderdate, $completiondate, $orderID);
		
		$success = mysqli_stmt_execute($stmt);
		
		mysqli_stmt_close($stmt);
		
		return $success;
	}*/
	
	//deletes order
	function deleteOrder($orderID) {
		global $conn;
		
		$stmt = mysqli_prepare($conn, "DELETE FROM Orders WHERE orderID = ?");
		mysqli_stmt_bind_param($stmt, "i", $orderID);
		
		$success = mysqli_stmt_execute($stmt);
		
		mysqli_stmt_close($stmt);
		
		return $success;
	}
	
	//deletes order items
	function deleteOrderItems($orderID) {
		global $conn;
		
		$stmt = mysqli_prepare($conn, "DELETE FROM OrdersItems WHERE orderID = ?");
		mysqli_stmt_bind_param($stmt, "i", $orderID);
		
		$success = mysqli_stmt_execute($stmt);
		
		mysqli_stmt_close($stmt);
		
		return $success;
	}
	
?>