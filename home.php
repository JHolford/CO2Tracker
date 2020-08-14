<?php
require_once('authorise.php');
include('connection.php');

// session_start();
//The rest of this script will not execute if the session check in authorise.php fails and
//the user will have been redirected to a different page
?>

<html>
 <head>
   <!-- Import Bootstrap and CSS file -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <!-- <link rel="stylesheet" href="cwStyle.css" > -->

  <title>Home page</title>
 </head>
 <body class="sitewide">

<?php
// Include navbar, comment functionality and vote functionality.
include("navbar.php");
if ($_COOKIE["CO2Increase"]!=0){
  echo '<script type="text/javascript">';
  if ($_COOKIE["CO2Saved"]=="true"){
    echo ' alert("Well Done! You\'ve just saved ';
    echo (number_format((float)($_COOKIE["CO2Increase"]/1000), 2, '.', ''));
    echo 'kg of CO2 compared to the UK Average for the tracked activity';
    if ($_COOKIE["Eco_Rec"]=="true"){
      echo ('\n\n To further improve your energy savings, try using an Eco setting, where available!');
    };
  }else{
    echo ' alert("Oh No! Unfortunately you\'ve just generated ';
    echo (number_format((float)(-$_COOKIE["CO2Increase"]/1000), 2, '.', ''));
    echo 'kg more CO2 compared to the UK Average for the tracked activity :(';
    if ($_COOKIE["Eco_Rec"]=="true"){
      echo ('\n\n To improve your energy savings, try using an Eco setting, where available!');
    };
  }
  echo '")</script>';
  setcookie("CO2Increase", 0);
  setcookie("Eco_Rec", "false");
}else{
  if ($_COOKIE["Eco_Rec"]=="true"){
    echo '<script type="text/javascript">';
    echo ' alert("To improve your energy savings, try using an Eco setting, where available!")';
    echo '</script>';
    setcookie("Eco_Rec", "false");
  };
};


?>
<!-- Centered Tabs -->
<!-- <ul class="nav nav-pills nav-justified"> -->
<?php
// $moduleQuery = "SELECT * FROM CO2Modules";
// $result = mysqli_query($conn, $moduleQuery);
// $moduleList = array();
//
//
// while ($row = mysqli_fetch_assoc($result)) {
//   echo ('<li><a data-toggle="pill" class="col-sm" href="#');
//   echo ($row["Module_Name"]);
//   echo ('">');
//   echo ($row["Module_Name"]);
//   echo ('</a></li>');
//
// };
//

?>
  <!-- <li><a data-toggle="pill" class="col-sm" href="#Home">| Home | </a></li>
  <li><a data-toggle="pill" class="col-sm" href="#Appliances">| Appliance Tracker | </a></li>
  <li><a data-toggle="pill" class="col-sm" href="#Social">| Social | </a></li> -->
  <?php

  ?>
</ul>

<div class="tab-content">
  <?php
  // Run mySQL query to pull the vehicles that are in the Top X from last week
  include("connection.php");
$moduleQuery = "SELECT * FROM CO2Modules";
$result = mysqli_query($conn, $moduleQuery);
$moduleList = array();

while ($row = mysqli_fetch_assoc($result)) {
  echo ('<div id="');
  echo ($row["Module_Name"]);
  echo ('" class="tab-pane fade in active">
    <h3>');
    echo ($row["Module_Name"]);
    echo('</h3>
    <p>');
    if ($row["JSON_Name"] != "") {


if ($row["Query1"]=="" || $row["Param1"]==""){

      // Create a new cURL resource
      $ch = curl_init($row["API_URL"]);
} else if ($row["Query2"]=="" || $row["Param2"]==""){
      // Create a new cURL resource
      $ch = curl_init($row["API_URL"].$row["Query1"].$row["Param1"]);

} else {
          // Create a new cURL resource
          $ch = curl_init($row["API_URL"].$row["Query1"].$row["Param1"].$row["Query2"].$row["Param2"]);
}

      // Set the username and password
      curl_setopt($ch, CURLOPT_USERPWD, $row['username:password']);

      // Set the content type to application/json
      curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));

      // Return response instead of outputting
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      // Execute the POST request
      ${$row["JSON_Name"]} = curl_exec($ch);

      // Close cURL resource
      curl_close($ch);

setcookie($row["JSON_Name"], ${$row["JSON_Name"]});

      // ${$row["JSON_Name"]} = $row["API_URL"];
    };
    include($row["Module_File"]);
    echo ('</p></div>');

  };


?>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

 </body>
</html>
