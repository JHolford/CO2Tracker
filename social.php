<<<<<<< Updated upstream
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
=======
<?php
// Create the array needed for the barchart, as per the tutorial/example from CanvasJS found online: https://canvasjs.com/php-charts/bar-chart/
$dataPoints = array();


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

// Also add values to chart array as per the CanvasJS tutorial/example found online:https://canvasjs.com/php-charts/bar-chart/
$dataPoints[]=array("y" => $formattedCO2 ,"label" => $detail );
}
echo ("</table>");
echo ("</div>");

// Reverse the datapoints for the barchart to mimic the order of the leaderboard
$dataPoints=array_reverse($dataPoints);

};
?>
<!-- The below barchart is created using the CanvasJS tutorial/example found online: https://canvasjs.com/php-charts/bar-chart/ -->
<script>
window.onload = function() {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: "CO2 Emissions saved by your friends"
	},
	axisY: {
		title: "kgs of CO2 saved",
		includeZero: true,
		prefix: "",
		suffix:  "kg"
	},
	data: [{
		type: "bar",
		yValueFormatString: "#,##0kg",
		indexLabel: "{y}",
		indexLabelPlacement: "inside",
		indexLabelFontWeight: "bolder",
		indexLabelFontColor: "white",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

}
</script>
<!-- The below barchart dependencies are from the CanvasJS tutorial/example found online: https://canvasjs.com/php-charts/bar-chart/  -->
<div id="chartContainer" style="height: 370px; width: 100%; margin-left:25%; margin-right:auto"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
>>>>>>> Stashed changes
