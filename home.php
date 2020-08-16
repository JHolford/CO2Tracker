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
   <link rel="stylesheet" href="Style.css" >

  <title>Home page </title>

<!-- <script>
include('darkenFunction.php');
</script> -->

<?php

if (isset ($_COOKIE['BackGreen'])){
  $BackGreen =  $_COOKIE['BackGreen'];
} else {
  $BackGreen = "223";
  setcookie('BackGreen', 223);
};
?>

 </head>
 <body style="background-color: rgb(203,<?php echo $BackGreen;?>,189)">


<?php
// Include navbar, comment functionality and vote functionality.
include("navbar.php");
if ($_COOKIE["CO2Increase"]!=0){
  echo '<script type="text/javascript">';
  if ($_COOKIE["CO2Saved"]==1){
    if ($_COOKIE['BackGreen']>250){
        setcookie('BackGreen', 255);
    } else {
       setcookie('BackGreen', $_COOKIE['BackGreen']+5);
    };

    echo ' if(alert("Well Done! You\'ve just saved ';
    echo (number_format((float)($_COOKIE["CO2Increase"]/1000), 2, '.', ''));
    echo 'kg of CO2 compared to the UK Average for the tracked activity';
    if ($_COOKIE["Eco_Rec"]==1){
      echo ('\n\n To further improve your energy savings, try using an Eco setting, where available!');
    };
  }else{
    if ($_COOKIE['BackGreen']<5){
      setcookie('BackGreen', 0);
  } else {
     setcookie('BackGreen', $_COOKIE['BackGreen']-5);
   };
    echo ' if(alert("Oh No! Unfortunately you\'ve just generated ';
    echo (number_format((float)(-$_COOKIE["CO2Increase"]/1000), 2, '.', ''));
    echo 'kg more CO2 compared to the UK Average for the tracked activity :(';
    if ($_COOKIE["Eco_Rec"]==1){
      echo ('\n\n To improve your energy savings, try using an Eco setting, where available!');
    };
  }
  echo '")){}
else    window.location.reload()</script>';
  setcookie("CO2Increase", 0);
  setcookie("Eco_Rec", 0);
}else{
  if ($_COOKIE["Eco_Rec"]==1){
    echo '<script type="text/javascript">';
    echo ' if(alert("To improve your energy savings, try using an Eco setting, where available!")){}
  else    window.location.reload()';
    echo '</script>';
    setcookie("Eco_Rec", 0);
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

  echo ('<div id="Home" class="tab-pane fade in active show"><h3>Home</h3>');
  include('hometab.php');
  echo ('</div>');

$moduleQuery = "SELECT * FROM CO2Modules";
$result = mysqli_query($conn, $moduleQuery);
$moduleList = array();

while ($row = mysqli_fetch_assoc($result)) {
  echo ('<div id="');
  echo ($row["Module_Name"]);
  echo ('" class="tab-pane fade">
    <h3>');
    echo ($row["Module_Name"]);
    echo('</h3>');

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
    echo ('</div>');

  };

?>
</div>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

 </body>
</html>
