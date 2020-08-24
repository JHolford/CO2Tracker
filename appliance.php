<?php

include("connection.php");

if (!isset($_COOKIE['Appliance_JSON'])){
  header("Location: home.php");
  exit;
} else {

// Query the appliance list from the database
$ApplianceQuery = "SELECT * FROM CO2Appliances";
$AppResult = mysqli_query($conn, $ApplianceQuery);

// Create a form that will post values to a page that will update the values of the CO2 counter
echo ("<form action='updateCO2.php' method='post'>");

while ($row = mysqli_fetch_assoc($AppResult)) {
  // Give each appliance its own header
  echo ("<label style='font-size:27'>");
  echo ($row["Appliance_Name"]);
  // A description on how to use the input is pulled from the database
  echo (":</label><br /><span class='CO2Desc'>");
  echo ($row["Appliance_CO2_Desc"]);
  echo("</span><br>");
  // Number input box, that prevents negative numbers
  echo ("<input type='number' onkeypress='return event.charCode >= 48' min='0' id='");
  echo ($row["Appliance_Name"]);
  echo ("' name='");
  echo ($row["Appliance_Name"]);
  // Default value to zero
  echo ("' value='0'><br>");

  // If there is an Eco mode set in the database, then generate a tick box for the eco mode (As using eco modes are optional)
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
  // Same as above, but for a second eco mode
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
// Once all the appliances have been listed, add a submit button at the bottom.
// This could probably be moved to a floating point on the page so that it is always present
echo ("<input class='button' type='submit' value='Submit'>");
echo ("</form>");
};
?>
