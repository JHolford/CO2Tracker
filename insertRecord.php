<!-- This file is reused from the Web Tech Module Coursework -->
<?php
include("connection.php");
session_start();
$newUsername = $_POST['username'];
//Break if user didn't set a username
if ($_POST['username']=="") {
	// FAILURE
	// echo ("<script type='text/javascript'>alert('Account creation failed, please try again!');</script>");
	setcookie("AccountCreated", 2);
	$location = 'registration.php';
	header("Location: $location");
	exit;
}
//Break if user didn't set a password
if ($_POST['password']=="") {
	// FAILURE
	// echo ("<script type='text/javascript'>alert('Account creation failed, please try again!');</script>");
	setcookie("AccountCreated", 2);
	$location = 'registration.php';
	header("Location: $location");
	exit;
}
else{
	//Encrypt password using sha1
$newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);


$passQuery = "SELECT * FROM co2accounts";
$result = mysqli_query($conn, $passQuery);
$passlist = array();
while($row = mysqli_fetch_assoc($result)) {
					$usernameLookup = $row['username'];
					$passwordLookup = $row['password'];
					$passlist[$usernameLookup]=$passwordLookup;
				}

mysqli_close($conn);
if($passlist[$newUsername]!=''){
	// already exists
	// echo ("<script type='text/javascript'>alert('Account creation failed! Username already taken!');</script>");
	setcookie("AccountCreated", 3);
	$location = 'registration.php';
	header("Location: $location");
	exit;
}else{



/*
 * This uses a simple array to store a set of valid login combinations.  These would normally
 * be stored as a hashed string
 * in a database of some sort.  The hashed versions would be compared so the actual
 * password never has to be stored
 */
include("connection.php");
$accountQuery = "INSERT INTO co2accounts (`Account_ID`,`username`,`password`,`CO2Count`) VALUES (NULL,'$newUsername','$newPassword',0)";
$accountAdd = mysqli_query($conn, $accountQuery);
mysqli_close($conn);
include("connection.php");
$passQuery = "SELECT * FROM co2accounts";
$result = mysqli_query($conn, $passQuery);
$passlist = array();
while($row = mysqli_fetch_assoc($result)) {
					$usernameLookup = $row['username'];
					$passwordLookup = $row['password'];
					$passlist[$usernameLookup]=$passwordLookup;
				}

				mysqli_close($conn);




if($passlist[$newUsername]==$newPassword){
	// SUCCESS
	// echo ("<script type='text/javascript'>alert('Account Created! Please login!');</script>");
	setcookie("AccountCreated", 1);
	$location = 'login.php';
}else{
	// FAILURE
	// echo ("<script type='text/javascript'>alert('Account creation failed, please try again!');</script>");
	setcookie("AccountCreated", 2);
	$location = 'registration.php';

}

}}
header("Location: $location");
exit;
?>
