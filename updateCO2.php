<?php
include("connection.php");
mysqli_close($conn);
include("connection.php");
session_start();

// Reset CO2Increase amount
$CO2Increase=0;

// decode the Appliance JSON
$data = gzinflate($_COOKIE['Appliance_JSON']);
$dataDecoded= json_decode($data,true);
// Create the Array that will be used to compare kWhPerCycle of different Appliance IDs
$CO2ValuesArr = array();

// Loop through initial JSON and enter each item's ID along with its kWhPerCycle
foreach ($dataDecoded['items'] as $item) {

  foreach ($item['values'] as $paths) {
    if ($paths['path']=="kWhPerCycle"){

      $CO2ValuesArr[$item['uid']]=$paths['value'];
    };
  };

};

// If the results of the first call are Truncated, the call will need to
// be repeated with different start points to ensure that we have all of the items
if ($dataDecoded["resultsTruncated"]){
  // The API url could be loaded from the database as on the home page, however this would add
  // unneccessary load to the server considering that this updateCO2.php is dedicated to the Appliance page anyway
$url = "https://api.carbonkit.net/3.6/categories/Kitchen_generic/items;values?kWhPerYear=0";
$resStart = 51;
$resLimit = 50;
$loopNumber=1;
$pswd = "v8s60:BasicAPIPassword1";
// Loop through the new data at least once
do {
// Create a new cURL resource
  $ch = curl_init($url."&resultStart=".$resStart."&resultLimit=".$resLimit);

  // Set the username and password
  curl_setopt($ch, CURLOPT_USERPWD, $pswd);

  // Set the content type to application/json
  curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));

  // Return response instead of outputting
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  // Execute the POST request
  $CO2_JSON = curl_exec($ch);

  // Close cURL resource
  curl_close($ch);

$CO2_JSON1 =json_decode($CO2_JSON,true);



foreach ($CO2_JSON1['items'] as $item) {

  foreach ($item['values'] as $paths) {
    if ($paths['path']=="kWhPerCycle"){

    $CO2ValuesArr[$item['uid']]=$paths['value'];
  }}

}


$resStart=$resStart+$resLimit;
// Stop looping when the results are no longer truncated
} while ($CO2_JSON1["resultsTruncated"]);
};


// This section compares values from our CO2ValuesArr array
// to the ID's of our items from the database.
// It then performs a calculation based on those figures to
// know how much needs to be added to our total
$ApplianceQuery = "SELECT * FROM CO2Appliances";
$AppResult = mysqli_query($conn, $ApplianceQuery);

while ($row = mysqli_fetch_assoc($AppResult)) {
	$appname=$row["Appliance_Name"];
  // Only perform calculation if the value entered isn't zero
  if ($_POST[$appname]<>0) {
  $CO2IncPerRow=0;
// If values were manually entered on the database (For instance, with our kettle)
// then it uses the manual figures
	if ($row["Appliance_CO2"]!=0){
    $CO2IncPerRow = $row["Appliance_CO2_Avg"]-($_POST[$appname]*$row["Appliance_CO2"]);
	} else {
    // Now it checks to see the combination of Eco mode settings to determine the calculation
        if(isset($_POST[$appname."_Eco1"]) && isset($_POST[$appname."_Eco2"])) {
          $CO2IncPerRow = $_POST[$appname]*($CO2ValuesArr[$row["API_Normal"]]-$CO2ValuesArr[$row["API_Eco2"]])*283.07;


        } else {
          if(isset($_POST[$appname."_Eco2"])) {
            $CO2IncPerRow = $_POST[$appname]*($CO2ValuesArr[$row["API_Eco1"]]-$CO2ValuesArr[$row["API_Eco2"]])*283.07;


          } else {
            if(isset($_POST[$appname."_Eco1"])) {
              $CO2IncPerRow = $_POST[$appname]*($CO2ValuesArr[$row["API_Normal"]]-$CO2ValuesArr[$row["API_Eco1"]])*283.07;
            } else {
              // If there is an eco mode available but not used, then update the Eco recommendation value to 1
              // This will prompt an alert on the homepage when the page loads
                setcookie('Eco_Rec', 1);
            };


}}};

// Tally the total from each row
	$CO2Increase=$CO2Increase+$CO2IncPerRow;

}
};

// SQL Query to update the CO2Count for the user to the new total
$username=$_SESSION["username"];
$CO2UPQuery = "UPDATE CO2Accounts SET CO2Count=CO2Count+$CO2Increase WHERE username='$username'";
$CO2UPResult = mysqli_query($conn, $CO2UPQuery);

// Update the cookies to reflect new value
setcookie('CO2Count', ($_COOKIE['CO2Count']+$CO2Increase));
setcookie('CO2Increase', $CO2Increase);
// Set cookie depending on whether or not CO2 has been saved or not
if ($CO2Increase>0){
  setcookie('CO2Saved', 1);
};
if ($CO2Increase<0){
  setcookie('CO2Saved', 0);
};

// Return to homepage
header("Location: home.php");
exit;
?>
