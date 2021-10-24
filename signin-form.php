<html>
  
  <head>
	<title>Sign in</title>
	<link rel="stylesheet" type="text/css" href="css/form-layout.css">
    <link rel="stylesheet" type="text/css" href="css/page-layout.css">
  </head>
  
  <body>
	
	<?php include("templates/header-template.php"); ?>
	
	<main>
    	<div id="signin-form">
          	<h1>Sign in</h1>
            <form method="post" action="signin-submit.php" class="bwform">
                <label>Email:</label>
                <input type="text" name="email" required>
                <label>Password:</label>
                <input type="password" name="password" required>
                <div class="center">
                    <input type="submit" value="Sign in">
					<div class="a-changeformm">
						<br><a class="a-changeform" href="signup-form.php">Don't have account</a>
					</div>
                </div>
            </form>
     	</div>
    </main>
                    
    <?php include_once("templates/footer-template.php"); ?>
      
  </body>
  
  
</html>