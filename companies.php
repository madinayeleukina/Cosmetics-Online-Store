<?php
	//checks was session started by admin, if not so stops php script
	include "includes/authorization-admin.php";	
	
	//initializes session
	if (session_status() == PHP_SESSION_NONE) session_start();
	
	require_once "includes/utility-functions.php";
	require_once "models/companies.php";
	
?>

<html>
	<head>
		<meta charset=utf-8/>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    	<link rel="stylesheet" type="text/css" href="css/page-layout.css"/>
		<link rel="stylesheet" type="text/css" href="css/form-layout.css"/>
		<link rel="stylesheet" type="text/css" href="css/modal-layout.css"/>
		
    	<title>Companies</title> 

		
	</head>
	
	<body>
<?php 	include_once("templates/header-template.php"); ?>
		
		<main  id="page_wrap">
            <section>
				<h1 class="title-ln">
                	<span class="page-title">Companies</span>
                </h1>
					
				<form method="post" action="company-insert.php" class="bwform">
					<input type="text" name="company" placeholder="Enter company" required>
					<input type="text" name="country" placeholder="Enter country" required>
					<input type="submit" value="Add new company">
				</form>
				
				
				<table style="font-size: 26px;">
<?php
				$companiesArr = getCompanies();
				
				foreach($companiesArr as $row):
					echo "<tr>";
						echo "<td>".$row["name"]."(".$row["country"].")</td>";
?>	
						<td><a href="company-delete.php?companyid=<?php echo $row["companyID"]; ?>" class="button">Delete</a></td>
							
						<td>
							<a class="openmodal">Update</a>
							<div class="modal">
								<div class="modalcontent companies">
									<label class="closemodal">&times;</label>
									<form action="company-update.php?companyid=<?php echo $row["companyID"]; ?>" method="post" class="bwform">
										<label>Enter new name:</label>
										<input type="text" name="company" value="<?php echo $row["name"]; ?>" required>
										<label>Enter new country:</label>
										<input type="text" name="country" value="<?php echo $row["country"]; ?>" required>
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
            </section>
		</main>
		
<?php 	include_once("templates/footer-template.php"); ?>
	
	</body>
</html>