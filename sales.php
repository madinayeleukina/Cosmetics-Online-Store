<?php
	//checks was session started by admin, if not so stops php script
	include "includes/authorization-admin.php";	
	
	//initializes session
	if (session_status() == PHP_SESSION_NONE) session_start();
	
	require_once "includes/utility-functions.php";
	require_once "models/orders.php";
	
	$resultArr = getOrdersDetails();
?>

<html>
	<head>
		<meta charset=utf-8/>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    	<link rel="stylesheet" type="text/css" href="css/page-layout.css"/>
		<link rel="stylesheet" type="text/css" href="css/table-layout.css"/>
		<title>Sales</title> 	
	</head>
	
	<body>
		<?php include_once("templates/header-template.php"); ?>
		
		<main  id="page_wrap">
            <section>
				
				<h1 class="title-ln">
                	<span class="page-title">Sales</span>
                </h1>
				
				<table>
					<tr>
						<th>Customer</th>
						<th>Order Date</th>
						<th>Completion Date</th>
						<th>Completed</th>
						<th>Amount</th>
					</tr>
<?php
				foreach($resultArr as $row):
?>					
					<tr id='<?php echo $row["orderID"] ?>'>
						<td><?php echo $row["customer"]; ?></td>
						<td><?php echo $row["orderDate"]; ?></td>						
						<td><?php echo $row["completionDate"]; ?></td>
						<td>
							<form method="post" action="sales-update.php?orderid=<?php echo $row["orderID"]; ?>">
								<input type="checkbox" style="zoom: 1.5;" name="isreceived" <?php if (isset($row["completionDate"])) echo "checked"; ?> onChange="this.form.submit()">								
							</form>
						
						</td>
						<td><?php echo $row["amount"]; ?></td>
					</tr>
<?php
				endforeach;
?>
				</table>
				
            </section>
		</main>
		
		<?php include_once("templates/footer-template.php"); ?>
	
	</body>

</html>