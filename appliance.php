<?php

include("connection.php");

$ApplianceQuery = "SELECT * FROM CO2Appliances";
$AppResult = mysqli_query($conn, $ApplianceQuery);
echo ("<form action='updateCO2.php' method='post'>");

setcookie('Appliance_JSON', $Appliance_JSON);
// echo $Appliance_JSON;
// echo ('</br>');
// echo $_COOKIE['Appliance_JSON'];
// echo ('</br>');
while ($row = mysqli_fetch_assoc($AppResult)) {
  echo ("<label>");
  echo ($row["Appliance_Name"]);
  echo (":<span style='color:grey'>");
  echo ($row["Appliance_CO2_Desc"]);
  echo("</span></label><br>");
  echo ("<input type='number' id='");
  echo ($row["Appliance_Name"]);
  echo ("' name='");
  echo ($row["Appliance_Name"]);
  echo ("' value='0'><br><br>");

};
echo ("<input type='submit' value='Submit'>");
echo ("</form>");

// $_SESSION('Appliance_Data') = $Appliance_JSON;
// echo $_SESSION('Appliance_Data');

?>
