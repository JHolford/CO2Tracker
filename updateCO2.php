<?php
include("connection.php");
mysqli_close($conn);
include("connection.php");
session_start();
$CO2Increase=0;

$ApplianceQuery = "SELECT * FROM CO2Appliances";
$AppResult = mysqli_query($conn, $ApplianceQuery);

while ($row = mysqli_fetch_assoc($AppResult)) {
	$appname=$row["Appliance_Name"];
	$CO2IncPerRow = $_POST[$appname]*$row["Appliance_CO2"];
	$CO2Increase=$CO2Increase+$CO2IncPerRow;
};
$username=$_SESSION["username"];
$CO2UPQuery = "UPDATE CO2Accounts SET CO2Count=CO2Count+$CO2Increase WHERE username='$username'";
$CO2UPResult = mysqli_query($conn, $CO2UPQuery);
// mysqli_fetch_assoc($CO2UPResult);

// echo $username;
// echo $CO2Increase;


header("Location: home.php");
exit;
?>
