<?php

//as the cookie can not be written and read on the same page load, this forces a refresh on first load.
if (!isset($_COOKIE['socialJSON'])){
  header("Location: home.php");
  exit;
} else {

// decode the Appliance JSON
$socialData = gzinflate($_COOKIE['socialJSON']);
$socialDataDecoded= json_decode($socialData,true);


//Show header explaining the page contents
echo ("<h4>Based on ");
echo ($_SESSION["username"]);
echo ("'s friends list, the following friends were found:</h4><br />");
// Disclaimer to show that no social media integration has actually been done.
// The data is pulled from a my-json-server: https://my-json-server.typicode.com/jholford/CO2DBJSON

echo ("<h6 style='color:grey'><b>DISCLAIMER:</b>The following data simulates social media integration using 'my-json-server'</h6><br />");

// Create the array which will contain all friends and their carbon saved amounts
$sortedArray = array();

// Build the data to be entered into the array from the JSON output.
foreach ($socialDataDecoded['posts'] as $socialItems){
  $dataForInsert=$socialItems["fName"]." ".$socialItems["sName"]."! User Since: ".$socialItems["userSince"];
  $sortedArray[$dataForInsert]=$socialItems["carbonSaved"];
};

// Sort the array by value. In this case, the carbon value creating a form of leaderboard
arsort($sortedArray);

// Output the array in a readable format for the user
foreach ($sortedArray as $detail => $carbonValue){
  echo ("<h5>");
  echo ($detail);
  echo ("</h5>");
  echo ("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; In total, they have saved: <b>");
  echo (number_format((float)($carbonValue/1000), 2, '.', ''));
  echo ('</b>kgs of CO2');
  // If the friend's carbon saved is higher, then incentivize the user to track more activities
  if ($_COOKIE["CO2Count"]<$carbonValue){
    $CO2Diff = $carbonValue-$_COOKIE["CO2Count"];
    echo ("<br />");
    echo ("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; They are <i>");
    echo (number_format((float)($CO2Diff/1000), 2, '.', ''));
    echo ('</i>kgs ahead of you. Keep tracking and you\'ll catch up in no time!');
  }
  echo ("<br />");
  echo ("<br />");
}
};
?>
