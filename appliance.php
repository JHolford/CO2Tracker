<?php

include("connection.php");

$ApplianceQuery = "SELECT * FROM CO2Appliances";
$AppResult = mysqli_query($conn, $ApplianceQuery);
echo ("<form action='updateCO2.php' method='post'>");

// setcookie('Appliance_JSON', $Appliance_JSON);
// echo $Appliance_JSON;
// echo ('</br>');
// echo $_COOKIE['Appliance_JSON'];
// echo ('</br>');
while ($row = mysqli_fetch_assoc($AppResult)) {
  echo ("<label style='font-size:30'>");
  echo ($row["Appliance_Name"]);
  echo (":</label><br /><span style='color:grey'>");
  echo ($row["Appliance_CO2_Desc"]);
  echo("</span><br>");
  echo ("<input type='number' id='");
  echo ($row["Appliance_Name"]);
  echo ("' name='");
  echo ($row["Appliance_Name"]);
  echo ("' value='0'><br>");
  if ($row["Eco_Mode1"]){
    echo ("<input type='checkbox' id='");
    echo ($row["Appliance_Name"]);
    echo ("_Eco1' name='");
    echo ($row["Appliance_Name"]);
    echo ("_Eco1' value='");
    echo ($row["Appliance_Name"]);
    echo ("_Eco1'>");
    echo ("<label for='");
    echo ($row["Appliance_Name"]);
    echo ("_Eco1'>");
    echo ($row["Eco_Mode1_Desc"]);
    echo ("</label><br>");
  }
  if ($row["Eco_Mode2"]){
    echo ("<input type='checkbox' id='");
    echo ($row["Appliance_Name"]);
    echo ("_Eco2' name='");
    echo ($row["Appliance_Name"]);
    echo ("_Eco2' value='");
    echo ($row["Appliance_Name"]);
    echo ("_Eco2'>");
    echo ("<label for='");
    echo ($row["Appliance_Name"]);
    echo ("_Eco2'>");
    echo ($row["Eco_Mode2_Desc"]);
    echo ("</label><br>");
  }
echo ("<br>");
};
echo ("<input type='submit' value='Submit'>");
echo ("</form>");

// $_SESSION('Appliance_Data') = $Appliance_JSON;
// echo $_SESSION('Appliance_Data');

?>
