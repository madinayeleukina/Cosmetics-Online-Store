<?php
	//checks was session started by admin, if not so stops php script
	include "includes/authorization-admin.php";	
	
	//initializes session
	if (session_status() == PHP_SESSION_NONE) session_start();
	
	require_once "includes/utility-functions.php";
	require_once "models/categories.php";
	
?>

<html>
	<head>
		<meta charset=utf-8/>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    	<link rel="stylesheet" type="text/css" href="css/page-layout.css"/>
		<link rel="stylesheet" type="text/css" href="css/form-layout.css"/>
		<link rel="stylesheet" type="text/css" href="css/modal-layout.css"/>
		
    	<title>Categories</title> 

		
	</head>
	
	<body>
<?php 	include_once("templates/header-template.php"); ?>
		
		<main  id="page_wrap">
            <section>
				<h1 class="title-ln">
                	<span class="page-title">Categories</span>
                </h1>
				<div class="categories-left">
					<h2>Cosmetics</h2>
					
					<form method="post" action="category-insert.php?type=cosmetics" class="bwform categoryAddForm">
						<input type="text" name="category" placeholder="Enter category" required>
						<input type="submit" value="Add new category">
					</form>
					
					
					<table style="font-size: 26px;">
<?php
					$categoriesArr = getCategories("cosmetics");
					foreach($categoriesArr as $row):
						echo "<tr>";
							echo "<td>".$row["category"]."</td>";
?>	
							<td><a href="category-delete.php?categoryid=<?php echo $row["categoryID"]; ?>" class="button">Delete</a></td>
							
							<td>
								<a class="openmodal">Update</a>
								
								<div class="modal">
									<div class="modalcontent categories">
										<label class="closemodal">&times;</label>
										<form action="category-update.php?categoryid=<?php echo $row["categoryID"]; ?>" method="post" class="bwform">
											<label>Enter new category name:</label>
											<input type="text" name="category" value="<?php echo $row["category"]; ?>" required>
											<input type="submit" value="Update">
										</form>
									</div>
								</div>
							</td>
						
						
						</tr>
<?php
					endforeach;
?>		
					</table>
					
					
				</div>
				<div class="categories-right">
					<h2>Household products</h2>
					
					
					<form method="post" action="category-insert.php?type=householdproducts" class="bwform categoryAddForm">
						<input type="text" name="category" placeholder="Enter category" required>
						<input type="submit" value="Add new category">
					</form>
					
					
					<table style="font-size: 26px;">
					<br>
<?php
					$categoriesArr = getCategories("householdproducts");
					foreach($categoriesArr as $row):
						echo "<tr>";
						echo "<td>".$row["category"]."</td>";
?>	
						<td><a href="category-delete.php?categoryid=<?php echo $row["categoryID"]; ?>" class="button">Delete</a></td>
						<td>
							<a class="openmodal">Update</a>
							<div class="modal">
								<div class="modalcontent categories">
									<label class="closemodal">&times;</label>
									<form action="category-update.php?categoryid=<?php echo $row["categoryID"]; ?>" method="post" class="bwform">
										<label>Enter new name:</label>
										<input type="text" name="category" value="<?php echo $row["category"]; ?>" required>
										<input type="submit" value="Update">
									</form>
								</div>
							</div>
						</td>
					
						
						
						</tr>		
<?php
					endforeach;
?>		
					</table>
					
					
					<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
					<script type="text/javascript">
						$(document).ready(function() {
							//opens modal
							$(".openmodal").click(function() {
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
				</div>
            </section>
		</main>
		
<?php 	include_once("templates/footer-template.php"); ?>
	
	</body>
</html>