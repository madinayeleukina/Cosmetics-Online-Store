<?php
	//initializes session
	if (session_status() == PHP_SESSION_NONE) session_start();
	require_once "models/items.php";

	$itemsArr = getBasketItems();
?>
<html>
	<head>
		<meta charset=utf-8/>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    	<link rel="stylesheet" type="text/css" href="css/page-layout.css"/>
		<link rel="stylesheet" type="text/css" href="css/table-layout.css"/>
		<script type="text/javascript" src="js/add-remove-basket.js"></script>
		<title>Basket</title> 	
	</head>
	
	<body>
		<?php include_once("templates/header-template.php"); ?>
		
		<main  id="page_wrap">
            <section>
				
				<h1 class="title-ln">
                	<span class="page-title">Basket</span>
                </h1>
				
<?php
			//checks is basket not empty, if so shows its items
			if ($itemsArr):
?>				
				<div id="items">
					<table>
						<tr>
							<th>Item</th>
							<th></th>
							<th>Price</th>
							<th>Number</th>
							<th>Subtotal</th>
							<th></th>
						</tr>
<?php
					foreach($itemsArr as $row):
?>					
						<tr id='<?php echo $row["itemID"] ?>'>
							<td><?php echo "<img src='data:image/jpeg;base64, ".base64_encode($row["photo"])."' class='item-image' height='180px' width='180px'/>"; ?></td>
							<td><?php echo $row["itemname"]; ?></td>						
							<td><?php echo $row["price"]; ?></td>
							<td><?php echo $_SESSION["basket"][$row["itemID"]]; ?></td>
							<td><?php echo $row["price"]*$_SESSION["basket"][$row["itemID"]]; ?></td>
							<td><button class="deleteBtn" onclick="removeFromBasket(<?php echo $row["itemID"]; ?>)">+</button></td>
						</tr>
<?php
					endforeach;
?>
					</table>
				</div>
				
<?php
			//checks was session started by user, if so checks out items
			if (!empty($_SESSION["userid"]) && !empty($_SESSION["role"]) && $_SESSION["role"]=="user"):
?>
				<a href="basket-confirm.php" class="btn">Checkout items</a>
<?php
			//checks was session started by visitor, if so prints message to login
			else:
?>
				<h3>Log in to checkout items</h3>
<?php
			endif;
?>


<?php
			//checks is basket empty, if so prints message
			else:
?>
				<h3>The basket is empty</h3>
<?php
			endif;
?>
            </section>
		</main>
		
		<?php include_once("templates/footer-template.php"); ?>
	
	</body>

</html>