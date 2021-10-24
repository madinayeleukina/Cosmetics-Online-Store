<html>

  <head>
	<title>Sign up</title>
	<link rel="stylesheet" type="text/css" href="css/form-layout.css">
    <link rel="stylesheet" type="text/css" href="css/page-layout.css">
  </head>
  
  <body>
  
	<?php include("templates/header-template.php"); ?>
	
	<main>
      	<div id="signup-form">
      		<h1>Register</h1>
            <form method="post" action="signup-submit.php" class="bwform">
              	<div id="signup-form-left">
                    <label>Your name:</label>
                    <input type="text" name="name" required>
                    <label>Your surname:</label>
                    <input type="text" name="surname" required>
                    <label>Your father name:</label>
                    <input type="text" name="fathername" required>
                    <label>Email:</label>
                    <input type="email" name="email" required>
                    <label>Password:</label>
                    <input type="password" name="password" required>
                    <label>Repeat password:</label>
                    <input type="password" name="repeatpassword" required>
                </div>
                <div id="signup-form-right">
					<label>Your country:</label>
					<select name="country" required>
						<option value="kazakhstan">Kazakhstan</option>
					</select>
					<label>Your region:</label>
					<select name="region" required>
						<option value="North Kazakhstan region">North Kazakhstan Region</option>
					</select>
					<label>Your city:</label>
					<select name="city" required>
						<option value="Petropavlovsk">Petropavlovsk</option>
						<option value="Bishkul">Bishkul</option>
					</select>
					<label>Your address:</label>
                    <input type="text" name="address" required>
					<label>Your mobile number:</label>
                    <input type="text" name="mobilenumber" required>
                </div>
                <div class="center">
                    <input type="submit" value="Sign up">
					<div class="a-changeformm">
						<br><a class="a-changeform" href="signin-form.php">I have an account</a>
					</div>
                </div>
            </form>
      	<div>
	</main>
                    
    <?php include_once("templates/footer-template.php"); ?>
    
  </body>
  
  
</html>