<?php
	//initializes session
	if (session_status() == PHP_SESSION_NONE) session_start();
	
	require_once "models/items.php";

	$itemsArr = getItem($_GET["itemid"]);
	$row = $itemsArr[0];
?>
<html>
	<head>
		<meta charset=utf-8/>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    	<link rel="stylesheet" type="text/css" href="css/page-layout.css"/>
		<link rel="stylesheet" type="text/css" href="css/table-layout.css"/>
		<link rel="stylesheet" type="text/css" href="css/item-details-layout.css"/>
		<script type="text/javascript" src="js/add-remove-basket.js"></script>
		<title><?php echo $row["name"]; ?></title> 	
	</head>
	
	<body>
		<?php include_once("templates/header-template.php"); ?>
		
		<main  id="page_wrap">
            <section>
			<div class="row">
				<div class="image">
					<img src="data:image/jpeg;base64, <?php echo base64_encode($row["photo"]); ?> " class="item-image" height="300px" width="300px"/>
				</div>
				
				<div class="details">
					<h1 class="title-ln">
						<span class="page-title"><?php echo $row["name"]; ?></span>
					</h1>
					
					<span class="price"><?php echo $row["price"]; ?> kzt</span><br>
				
				
<?php	
				//checks was session started by admin
				if (!empty($_SESSION["userid"]) && $_SESSION["role"]=="admin"):
?>			
					<span class="quantity"><?php echo $row["quantity"]; ?> pcs left</span><br>
<?php
				else:
?>
					<div class="add-to-basket">
						<span>Choose the number:</span>
						<input type="number" value="1" id="number"><br>
						<a onclick="addToBasketNumber(<?php echo $row["itemID"]; ?>)" class="btn">Add to basket</a>
					</div>
<?php
				endif;
?>	
				</div>
				</div>

				<br>
				<div class="description">
					<span class="description-title">Description:</span><br>
					<span class="text"><?php echo $row["description"]; ?></span>
				</div>
				
            </section>
		</main>
		
		<?php include_once("templates/footer-template.php"); ?>
	
	</body>

</html>