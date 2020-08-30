<?php

require_once('authorise.php');
include('connection.php');

?>

<html>
<head>


<!-- Import Bootstrap and CSS file -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="Style.css" >


<title>Home page</title>

<?php

// If the background green level has been set by a module, use that background green level. If not, default to 223 (Same as login screen)

if (isset ($_COOKIE['BackGreen'])){
  $BackGreen =  $_COOKIE['BackGreen'];
} else {
  $BackGreen = "223";
  setcookie('BackGreen', 223);
};
?>

 </head>
 <!-- Background green level can be adjusted by modules to show a subtle positive outcome by editing the $_COOKIE['BackGreen'] -->
 <body style="background-color: rgb(203,<?php echo $BackGreen;?>,189)">


<?php
// Include navbar
include("navbar.php");

//If the the CO2 figure has been updated. Give an alert, either positive or negative, and adjust the background green level according to whether or not the CO2 saved has increased or descreased.
if ($_COOKIE["CO2Increase"]!=0){
  echo '<script type="text/javascript">';
  if ($_COOKIE["CO2Saved"]==1){
    // CO2 figure has increased = so positive outcome
    // Increase background green level
    if ($_COOKIE['BackGreen']>250){
        setcookie('BackGreen', 255);
    } else {
       setcookie('BackGreen', $_COOKIE['BackGreen']+5);
    };
    // Give the user a positive message for encouragement
    echo (' if(alert("');
    //Generate random number and based on this number, change the positive phrase shown to the user.
    // 10 Phrases because of Fogg's research
    $phraseChoice=rand(1,10);
    switch ($phraseChoice){
      case 1:
        echo ('Well Done!');
        break;
      case 2:
        echo ('Fantastic!');
        break;
      case 3:
        echo ('I\'m impressed!');
        break;
      case 4:
        echo ('Nice work!');
        break;
      case 5:
        echo ('Hurray for you!');
        break;
      case 6:
        echo ('Outstanding!');
        break;
      case 7:
        echo ('You\'re the best!');
        break;
      case 8:
        echo ('Wonderful!');
        break;
      case 9:
        echo ('Way to go!');
        break;
      case 10:
        echo ('You\'ve made progress!');
        break;
}

    echo ('\n\nYou\'ve just saved ');
    // Display CO2 figure in kg and round to 2 decimal places
    echo (number_format((float)($_COOKIE["CO2Increase"]/1000), 2, '.', ''));
    echo 'kg of CO2 compared to the UK Average for the tracked activity';
    // if an appliance was tracked that has an Eco mode, but a eco mode was not used then prompt the user to use the eco mode next time.
    if ($_COOKIE["Eco_Rec"]==1){
      echo ('\n\nTo further improve your energy savings, try using an Eco setting, where available!');
    };
  }else{
    // CO2 figure decreased = negative outcome
    // Decrease the background green level
    if ($_COOKIE['BackGreen']<5){
      setcookie('BackGreen', 0);
  } else {
     setcookie('BackGreen', $_COOKIE['BackGreen']-5);
   };
   // Give the user negative feedback
    echo ' if(alert("Oh No!\n\nUnfortunately you\'ve just generated ';
    // Display CO2 figure in kg and round to 2 decimal places
    echo (number_format((float)(-$_COOKIE["CO2Increase"]/1000), 2, '.', ''));
    echo 'kg more CO2 compared to the UK Average for the tracked activity :(';
    // if an appliance was tracked that has an Eco mode, but a eco mode was not used then prompt the user to use the eco mode next time.
    if ($_COOKIE["Eco_Rec"]==1){
      echo ('\n\n To improve your energy savings, try using an Eco setting, where available!');
    };
  }
// On closing the alert window, refresh the page. This updates the background color to the new value
  echo '")){} else window.location.reload()</script>';
// reset cookies to prevent additional alerts
  setcookie("CO2Increase", 0);
  setcookie("Eco_Rec", 0);
}else{
// Even if no CO2 change is detected, if an appliance was tracked that has an Eco mode, but a eco mode was not used then prompt the user to use the eco mode next time.
  if ($_COOKIE["Eco_Rec"]==1){
    echo '<script type="text/javascript">';
    // Although reloading the page in this context (No background green level changes), the oage is reloaded for consistency.
    echo ' if(alert("To improve your energy savings, try using an Eco setting, where available!")){} else window.location.reload()';
    echo '</script>';
    //reset cookies to prevent additional alerts
    setcookie("Eco_Rec", 0);
  };
};

?>


<!-- Create a container for the content for each tab (Using Bootstraps tutorials) -->
<div class="tab-content">
  <?php



//Create a simple hometab that is the default landing page. This is the template that is produced for each module in the upcoming query
// Create container for individual tab content. With header
  echo ('<div id="Home" class="tab-pane fade in active show"><h3>Home</h3>');
// Include actual tab content using external php files
  include('hometab.php');
  echo ('</div>');

// Query the database for the list of modules and associated data (Module file name and API info)
$moduleQuery = "SELECT * FROM CO2Modules";
$result = mysqli_query($conn, $moduleQuery);



while ($row = mysqli_fetch_assoc($result)) {
  echo ('<div id="');
  echo ($row["Module_Name"]);
  echo ('" class="tab-pane fade"><h3>');
  echo ($row["Module_Name"]);
  echo('</h3>');

  // If the database specifies that a JSON file is to be created, then generate the API call:
  if ($row["JSON_Name"] != "") {
    // Build the API call with the appropriate number of parameters per the database:
    if ($row["Query1"]=="" || $row["Param1"]==""){

      // Create a new cURL resource
      $ch = curl_init($row["API_URL"]);

    } else if ($row["Query2"]=="" || $row["Param2"]==""){
      // Create a new cURL resource with one parameter
      $ch = curl_init($row["API_URL"].$row["Query1"].$row["Param1"]);
    } else {
        // Create a new cURL resource with two parameters
        $ch = curl_init($row["API_URL"].'&'.$row["Query1"].'='.$row["Param1"].'&'.$row["Query2"].'='.$row["Param2"]);
    }

    // Set the username and password
    if ($row['username:password']!=""){
    curl_setopt($ch, CURLOPT_USERPWD, $row['username:password']);
    };

    // Edit request type to GET (Default is POST), if applicable
    if ($row['Get']==1){
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    };

    // Set the content type to application/json
    if ($row['contentType']!=""){
    curl_setopt($ch, CURLOPT_HTTPHEADER, array($row['contentType']));
    };
    // Return response instead of outputting
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the request
    ${$row["JSON_Name"]} = curl_exec($ch);

      // Save the JSON to a Cookie
    setcookie($row["JSON_Name"], gzdeflate(${$row["JSON_Name"]},9));

    // Close cURL resource
    curl_close($ch);


    };
    // Add the module file to fill the tab content
    include($row["Module_File"]);
    // Close the tab's container
    echo ('</div>');

  };

?>
<!-- CLose the tab-content container -->
</div>


<!-- Include the required bootstrap scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
