<?php
	$servername = "localhost";
	$username = "elm";
	$password = "elmpassword";
	$dbname = "elm_store";	
	
	//connects to database and checks connection
	try {
      	if ($conn = mysqli_connect($servername, $username, $password, $dbname)) {
          //allows cyrillic characters
			mysqli_set_charset($conn, "utf8");
		} else {
        	die("Connection failed: ".mysqli_connect_error()); 
        }
    } 
	catch(Exception $e) {
   		echo $e->getMessage();
    }

?>