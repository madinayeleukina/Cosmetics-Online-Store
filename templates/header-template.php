<header>
	<h1 id="header-title"> Welcome to the store</h1>
	<nav>
	
<?php
	//initializes session
	if (session_status() == PHP_SESSION_NONE) session_start();
	
	require_once "models/users.php";
	
	//shows header for visitor
	if (!isUserLoggedIn()):
?>
		<ul>
			<li><a href="homepage.php">HOME</a></li>
			<li><a href="cosmetics.php">COSMETICS</a></li>
			<li><a href="householdproducts.php">HOUSEHOLD PRODUCTS</a></li>
			<li><a href="basket.php">BASKET</a></li>
			<li id="login"><a href="signin-form.php">LOGIN</a></li>			
		</ul>
<?php
	//shows header for user
	elseif (getUserRole() == "user"):
?>
		<ul>
			<li><a href="homepage.php">HOME</a></li>
			<li><a href="cosmetics.php">COSMETICS</a></li>
			<li><a href="householdproducts.php">HOUSEHOLD PRODUCTS</a></li>
			<li><a href="basket.php">BASKET</a></li>
			<li id="logout">
				<label> <?php echo $_SESSION["name"]." ".$_SESSION["surname"]; ?> </label>
				<a href="logout.php" class="button">LOGOUT</a>
			</li>			
		</ul>
<?php
	//shows header for admin
	elseif (getUserRole() == "admin"):
?>
		<ul>
			<li><a href="homepage.php">HOME</a></li>
			<li><a href="cosmetics.php">COSMETICS</a></li>
			<li><a href="householdproducts.php">HOUSEHOLD PRODUCTS</a></li>
			<li><a href="companies.php">COMPANIES</a></li>
			<li><a href="categories.php">CATEGORIES</a></li>
			<li><a href="sales.php">SALES</a></li>
			<li id="logout">
				<label> <?php echo $_SESSION["name"]." ".$_SESSION["surname"]; ?> </label>
				<a href="logout.php" class="button">LOGOUT</a>
			</li>			
		</ul>
<?php
	endif;
?>
	</nav>
</header>