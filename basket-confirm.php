<?php
	//checks was session started by user
	include "includes/authorization-user.php";
	
	//initializes session
	if (session_status() == PHP_SESSION_NONE) session_start();
	
	require_once "includes/utility-functions.php";
	require_once "models/orders.php";
	require_once "models/users.php";
	
	//checks out basket items
	$orderid = checkout();
	//checks is there error, is so returns to basket page
	if ($orderid<0) redirect("basket.php",false);
	
	$userdetails = getLoggedInUser(); $userdetails = $userdetails[0];
	$itemsArr = getOrdersItems($orderid);
	$totalsArr = getOrderTotals($orderid); $totalsArr = $totalsArr[0];
?>
<html>
	<head>
		<meta charset=utf-8/>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    	<link rel="stylesheet" type="text/css" href="css/page-layout.css"/>
		<link rel="stylesheet" type="text/css" href="css/table-layout.css"/>
		<title>Order</title> 	
	</head>
	
	<body>
		<?php include_once("templates/header-template.php"); ?>
		
		<main  id="page_wrap">
            <section>
				<h1 class="title-ln">
                	<span class="page-title">Order details</span>
                </h1>
				<p>Thank you for your order! Your order details are below. We will send you your order as soon as possible.</p>
				<div class="delivery-details">
					<p>Delivery details</p>
					<p><?php echo $userdetails["name"]." ".$userdetails["surname"] ?></p>
					<p><?php echo $userdetails["address"] ?></p>
					<p><?php echo $userdetails["city"].", ".$userdetails["region"] ?></p>
				</div>
				<div class="items">
					<table>
						<tr>
							<th>Item</td>
							<th>Number</td>
							<th>Price</td>
							<th>Subtotal</td>
						</tr>
<?php	
					foreach($itemsArr as $row):
?>					
						<tr id=<?php echo $row["itemID"]; ?>>
							<td><?php echo $row["itemname"]; ?></td>
							<td><?php echo $row["number"]; ?></td>
							<td><?php echo $row["price"]; ?></td>
							<td><?php echo $row["number"]*$row["price"]; ?></td>
						</tr>
<?php
					endforeach;
?>					
					</table>
				</div>
				<div class="totals">
					<p><strong>Total price: </strong><?php echo $totalsArr["totalprice"]; ?></p>
				</div>
            </section>
		</main>
		
		<?php include_once("templates/footer-template.php"); ?>
	
	</body>
</html>