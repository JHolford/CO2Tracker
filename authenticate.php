<?php
// This authentication system is adapted from the Web Tech Module Coursework. However, with the Google reCaptcha system removed.
include("connection.php");
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
// } else {
	// die("Connection successful");
}
session_start();

$username = $_POST['username'];
$password = $_POST['password'];
// Hash the password
$hash = password_hash($password, PASSWORD_DEFAULT);
// Redirect user if no password is entered
if ($password==""){
	$location = 'badauth.php';
	header("Location: $location");
	return;
}
/*
 * This uses a simple array to store a set of valid login combinations.  These would normally
 * be stored as a hashed string
 * in a database of some sort.  The hashed versions would be compared so the actual
 * password never has to be stored.
 */

$passQuery = "SELECT * FROM co2accounts";
$result = mysqli_query($conn, $passQuery);
$passlist = array();

while($row = mysqli_fetch_assoc($result)) {
	$usernameLookup = $row['username'];
	$passwordLookup = $row['password'];
	$passlist[$usernameLookup]=$passwordLookup;
	// Load the current user's CO2Count and save to cookie
	if ($row['username']==$username){
		setcookie('CO2Count', $row['CO2Count']);
	};
}

mysqli_close($conn);

if(password_verify($password,$passlist[$username])){
	// SUCCESS
	// session_start();
	session_regenerate_id();
	$_SESSION['id'] = session_id();
	$_SESSION['username'] = $username;

setcookie('Eco_Rec',0);
setcookie('CO2Increase',0);

	$location = 'home.php#home';
}else{
	// FAILURE
	$location = 'badauth.php';
}

header("Location: $location");
exit;

$location = 'badauth.php';
header("Location: $location");
return;
?>
