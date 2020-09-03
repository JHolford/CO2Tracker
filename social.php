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
  $dataForInsert=$socialItems["fName"]." ".$socialItems["sName"];
  $sortedArray[$dataForInsert]=$socialItems["carbonSaved"];
};
$dataForInsert=$_SESSION["username"]." (You)";
$sortedArray[$dataForInsert]=$_COOKIE["CO2Count"];
// Sort the array by value. In this case, the carbon value creating a form of leaderboard
arsort($sortedArray);

// echo ("<div style='margin-left:auto; margin-right:auto'>");
// Output the array in a readable format for the user
echo ("<div style='float:left'>");
echo ("<table>");
echo ("<tr>");
echo ("<th>#</th>");
echo ("<th>&nbsp&nbsp&nbsp</th>");
echo ("<th>Name   </th>");
echo ("<th>&nbsp&nbsp&nbsp</th>");
echo ("<th>CO2 Saved</th>");
echo ("</tr>");
$leaderboardPosition = 1;
foreach ($sortedArray as $detail => $carbonValue){
  echo ("<tr>");
  echo ("<td>$leaderboardPosition</td>");
  echo ("<td>&nbsp&nbsp&nbsp</td>");
  echo ("<td>$detail</td>");
  echo ("<td>&nbsp&nbsp&nbsp</td>");
  $formattedCO2 = number_format((float)($carbonValue/1000), 2, '.', '');
  echo ("<td>$formattedCO2 kgs</td>");
  echo ("</tr>");
  $leaderboardPosition++;

}
echo ("</table>");
echo ("</div>");
// Barchart below
echo ("<div style='float:right'>");
echo ("Barchart!");
echo ("</div>");
};
?>
