<?php
session_start();
// mysqli_close($conn);
include("connection.php");

// $username=$_SESSION['username'];
// echo ($username);
// $CO2query = "SELECT * FROM CO2Accounts";
// $CO2result = mysqli_query($conn, $CO2query);
// $CO2row = mysql_fetch_array($result);
// echo $row['CO2Count'];

//

// for ()
// $_SESSION['CO2Count'] = $CO2row[0];
echo($_SESSION['CO2Count'])
// mysqli_close($conn);
// include("connection.php");
?>
