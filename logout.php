<?php
	session_start();
	session_unset();
	session_destroy();

	// $_SESSION = array(); // Unset all session variables.
	// 	session_destroy(); // Destroys all data registered to a session


	header('Location:./index.php');
	exit();
?>