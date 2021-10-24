<?php
	//redirects to another page
	function redirect($link, $delayed = false, $permanent = false) {
		if (!headers_sent() && !$delayed) 
			header('Location: '.$link, true, ($permanent === true) ? 301 : 302);
		else {
			echo "<a href = '$link'>Click here.</a>";
			echo "<script type='text/javasript'> ".
				 "setTimeout(function() { ".
				 "window.location.href = '$link';}, 5000);".
				 "</script>";
		}
		exit();
	}
?>