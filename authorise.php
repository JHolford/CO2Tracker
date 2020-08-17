<?php

// This file is reused from the Web Tech Module Coursework
// If the session check is unsuccessful the browser is redirected to the badauth page.
//Otherwise this file does nothing (so the file that includes it will carry on as normal)

session_start();


if($_SESSION['id'] != session_id() || empty($_SESSION['username'])){
	// Either the session ID is incorrect or the username has not been set.
	header("Location: badauth.php");
	session_destroy();
	exit;
}

?>
