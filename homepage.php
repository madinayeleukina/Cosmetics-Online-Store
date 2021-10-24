<?php	
	//initializes session
	if (session_status() == PHP_SESSION_NONE) session_start();
	
	require_once "includes/utility-functions.php";
	require_once "models/categories.php";
	require_once "models/companies.php";
	require_once "models/items.php";

	$categoriesArr = getCategories("cosmetics");
	$companiesArr = getCompanies();
	$itemsCompaniesCategoriesArr = getItemsCompaniesCategories("cosmetics");
?>
<html>
	<head>
		<?php include_once("templates/head-template.php"); ?>
		<link rel="stylesheet" type="text/css" href="css/modal-layout.css"/>
		<link rel="stylesheet" type="text/css" href="css/form-layout.css"/>
    	<script type="text/javascript" src="js/show-category-items.js"></script>
		<script type="text/javascript" src="js/add-remove-basket.js"></script>
    	<title>Homepage</title> 	
	</head>
	
	<body>
		<?php include "templates/header-template.php"; ?>
		
		<main  id="page_wrap">
            <section>
				
				<!---BANNER--->
			
				<div class="banner">
                	<img src="img/homepage-banner.jpg" height="300px" width="1200px">
<?php		
				if (!empty($_SESSION["userid"]) && $_SESSION["role"]=="admin"):
?>			
					<a class="banner-update change">Update</a>
					
					<!---BANNER MODAL--->
					
					<div class="modal">
						<div class="modalcontent updatebanner">
							<label class="closemodal">&times;</label>
							<form action="banner-update.php" method="post" enctype="multipart/form-data" class="bwform">
								<label>Enter banner image</label><br>
								<input type="file" name="image" required><br>	
								<input type="submit" value="Update banner image" id="btnSubmit">
							<form>
						</div>
					</div>
					
					<!---BANNER SCRIPT--->
					
					<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
					<script type="text/javascript">
						$(document).ready(function() {
							//opens modal
							$(".banner-update").click(function() {
								var $modal = $(this).next();
								$($modal).fadeIn("1000");
							});
							//closes modal
							$(".closemodal").click(function() {
								var $modal2 = $(this).parent().parent();
								$($modal2).fadeOut("800");
							});
						});
					</script>
<?php
				endif;
?>
                </div>
				
                <h1 class="section-title-ln" id="center">
                	<span class="section-title">Just arrived cosmetics</span>
                </h1>
				
            	<div class="set">  	
<?php
				$i = 0;
				foreach($itemsCompaniesCategoriesArr as $row):
?>					

					<div class = "itemsList-item category-<?php echo $row["categoryID"]; ?>">
						<a href="item-details.php?itemid= <?php echo $row["itemID"]; ?>">
							<img src="data:image/jpeg;base64, <?php echo base64_encode($row["photo"]); ?> " class="item-image" height="256px" width="256px"/>
							<span class="itemsList-item-title"><?php echo $row["itemname"]; ?></span>
						</a>
						<span class="itemsList-item-title"><?php echo $row["price"]; ?> kzt</span>
<?php
					if (!empty($_SESSION["userid"]) && $_SESSION["role"]=="user" || empty($_SESSION["userid"])):
	
						if ($row["quantity"]>0):
?>	
							<div>
								<a onclick="addToBasket(<?php echo $row["itemID"]; ?>)" class = "btn">Add to basket</a>
							</div>
<?php
						else:
?>
							<div class = itemsList-item-button>
								<a>Not available now</a>
							</div>
<?php				
						endif;

					else:
?>
						<div class = "itemsList-item-change">
							<a class = "openupdatemodal">Update</a>
							<a class = "delete-button" href="item-delete.php?from=cosmetics.php&itemid=<?php echo $row["itemID"]; ?>">Delete</a>
						</div>
						
						<div class="modal">
							<div class="modalcontent updateitem">
								<label class="closemodal">&times;</label>
								<form action="item-update.php?from=cosmetics.php&itemid=<?php echo $row["itemID"]; ?>" method="post" enctype="multipart/form-data" class="bwform">
									<label>Enter item name</label><br>
									<input type="text" name="name" value="<?php echo $row["itemname"]; ?>" required><br>
									<label>Enter item price</label><br>
									<input type="number" name="price" value="<?php echo $row["price"]; ?>" required><br>
									<label>Enter item quantity</label><br>
									<input type="number" name="quantity" value="<?php echo $row["quantity"]; ?>" required><br>
									<label>Enter item photo(if you want to change)</label><br>
									<input type="file" name="photo"><br>
									<label>Enter item description</label><br>
									<textarea name="description" cols="40" rows="2" required><?php echo $row["description"]; ?></textarea><br>
									<label>Enter item company</label><br>
									<select name="companyid" required>   <!--- --->
<?php
									foreach($companiesArr as $roww):
?>										
					
										<option <?php echo 'value="'.$roww["companyID"].'"'; ?> <?php if ($roww["companyID"]==$row["companyID"]) echo " selected "; ?>>
											<?php echo $roww["name"]; ?>
										</option>
<?php
									endforeach;
?>
									</select><br>
									<label>Enter item category</label><br>
									<select name="categoryid" required>   <!--- --->
<?php
									foreach($categoriesArr as $roww):
?>							
										<option <?php echo 'value="'.$roww["categoryID"].'"'; ?> <?php if ($roww["categoryID"]==$row["categoryID"]) echo " selected "; ?>>
											<?php echo $roww["category"]; ?>
										</option>
<?php
									endforeach;
?>
									</select><br>							
									<input type="submit" value="Update product" id="btnSubmit">
								</form>
							</div>
						</div>
						
						<script type="text/javascript">
							$(document).ready(function() {
								//opens modal
								$(".openupdatemodal").click(function() {
									var $modal = $(this).parent().next();
									$($modal).fadeIn("1000");
								});
							});
						</script>
<?php
					endif;
?>
					</div>
					
<?php
				$i = $i + 1;
				if ($i == 4) break;
				endforeach;
?>						
                </div>
				
                <h1 class="section-title-ln" id="center">
                	<span class="section-title">Just arrived household products</span>
                </h1>			
				
                <div class="set">
<?php
				$categoriesArr = getCategories("householdproducts");
				$companiesArr = getCompanies();
				$itemsCompaniesCategoriesArr = getItemsCompaniesCategories("householdproducts");
				$i = 0;
				foreach($itemsCompaniesCategoriesArr as $row):
?>					
					
					<div class = "itemsList-item category-<?php echo $row["categoryID"]; ?>">
						<a href="item-details.php?itemid= <?php echo $row["itemID"]; ?>">
							<img src="data:image/jpeg;base64, <?php echo base64_encode($row["photo"]); ?> " class="item-image" height="256px" width="256px"/>
							<span class="itemsList-item-title"><?php echo $row["itemname"]; ?></span>
						</a>
						<span class="itemsList-item-title"><?php echo $row["price"]; ?> kzt</span>
<?php
					if (!empty($_SESSION["userid"]) && $_SESSION["role"]=="user" || empty($_SESSION["userid"])):
	
						if ($row["quantity"]>0):
?>	
							<div>
								<a onclick="addToBasket(<?php echo $row["itemID"]; ?>)" class="btn">Add to basket</a>
							</div>
<?php
						else:
?>
							<div class = itemsList-item-button>
								<a>Not available now</a>
							</div>
<?php				
						endif;

					else:
?>
						<div class = "itemsList-item-change">
							<a class = "openupdatemodal">Update</a>
							<a class = "delete-button" href="item-delete.php?from=householdproducts.php&itemid=<?php echo $row["itemID"]; ?>">Delete</a>
						</div>
						
						<div class="modal">
							<div class="modalcontent updateitem">
								<label class="closemodal">&times;</label>
								<form action="item-update.php?from=householdproducts.php&itemid=<?php echo $row["itemID"]; ?>" method="post" enctype="multipart/form-data" class="bwform">
									<label>Enter item name</label><br>
									<input type="text" name="name" value="<?php echo $row["itemname"]; ?>" required><br>
									<label>Enter item price</label><br>
									<input type="number" name="price" value="<?php echo $row["price"]; ?>" required><br>
									<label>Enter item quantity</label><br>
									<input type="number" name="quantity" value="<?php echo $row["quantity"]; ?>" required><br>
									<label>Enter item photo(if you want to change)</label><br>
									<input type="file" name="photo"><br>
									<label>Enter item description</label><br>
									<textarea name="description" cols="40" rows="2" required><?php echo $row["description"]; ?></textarea><br>
									<label>Enter item company</label><br>
									<select name="companyid" required>   <!--- --->
<?php
									foreach($companiesArr as $roww):
?>										
					
										<option <?php echo 'value="'.$roww["companyID"].'"'; ?> <?php if ($roww["companyID"]==$row["companyID"]) echo " selected "; ?>>
											<?php echo $roww["name"]; ?>
										</option>
<?php
									endforeach;
?>
									</select><br>
									<label>Enter item category</label><br>
									<select name="categoryid" required>   <!--- --->
<?php
									foreach($categoriesArr as $roww):
?>							
										<option <?php echo 'value="'.$roww["categoryID"].'"'; ?> <?php if ($roww["categoryID"]==$row["categoryID"]) echo " selected "; ?>>
											<?php echo $roww["category"]; ?>
										</option>
<?php
									endforeach;
?>
									</select><br>							
									<input type="submit" value="Update product" id="btnSubmit">
								</form>
							</div>
						</div>
						
						<script type="text/javascript">
							$(document).ready(function() {
								//opens modal
								$(".openupdatemodal").click(function() {
									var $modal = $(this).parent().next();
									$($modal).fadeIn("1000");
								});
							});
						</script>
<?php
					endif;
?>
					</div>
					
<?php
				$i = $i + 1;
				if ($i == 4) break;
				endforeach;
?>
                </div>
            </section>
		</main>
		
		<?php include_once("templates/footer-template.php"); ?>
	
	</body>
</html>