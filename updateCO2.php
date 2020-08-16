<?php
include("connection.php");
mysqli_close($conn);
include("connection.php");
session_start();
$CO2Increase=0;

function darkenBackground() {

  if ($_COOKIE["CO2Increase"]!=0){
    if ($_COOKIE["CO2Saved"]==1){
      if ($_COOKIE['BackGreen']>245){
          setcookie('BackGreen', 255);
      } else {
         setcookie('BackGreen', $_COOKIE['BackGreen']+10);
      }
    } else {
       if ($_COOKIE['BackGreen']<10){
         setcookie('BackGreen', 0);
     } else {
        setcookie('BackGreen', $_COOKIE['BackGreen']-10);
       };
    }

  };


};

// echo $_COOKIE["Appliance_JSON"];
$Appliance_JSON1 = $_COOKIE["Appliance_JSON"];
$Appliance_JSON = json_decode($_COOKIE["Appliance_JSON"],true);



// function prettyPrint( $json )
// {
//     $result = '';
//     $level = 0;
//     $in_quotes = false;
//     $in_escape = false;
//     $ends_line_level = NULL;
//     $json_length = strlen( $json );
//
//     for( $i = 0; $i < $json_length; $i++ ) {
//         $char = $json[$i];
//         $new_line_level = NULL;
//         $post = "";
//         if( $ends_line_level !== NULL ) {
//             $new_line_level = $ends_line_level;
//             $ends_line_level = NULL;
//         }
//         if ( $in_escape ) {
//             $in_escape = false;
//         } else if( $char === '"' ) {
//             $in_quotes = !$in_quotes;
//         } else if( ! $in_quotes ) {
//             switch( $char ) {
//                 case '}': case ']':
//                     $level--;
//                     $ends_line_level = NULL;
//                     $new_line_level = $level;
//                     break;
//
//                 case '{': case '[':
//                     $level++;
//                 case ',':
//                     $ends_line_level = $level;
//                     break;
//
//                 case ':':
//                     $post = " ";
//                     break;
//
//                 case " ": case "\t": case "\n": case "\r":
//                     $char = "";
//                     $ends_line_level = $new_line_level;
//                     $new_line_level = NULL;
//                     break;
//             }
//         } else if ( $char === '\\' ) {
//             $in_escape = true;
//         }
//         if( $new_line_level !== NULL ) {
//             $result .= "\n".str_repeat( "\t", $new_line_level );
//         }
//         $result .= $char.$post;
//     }
//
//     return $result;
// }
//
//
// prettyPrint( $Appliance_JSON1 ) === prettyPrint( prettyPrint( $Appliance_JSON1 ) );

$CO2ValuesArr = array();
$url = "https://api.carbonkit.net/3.6/categories/Kitchen_generic/items;values?kWhPerYear=0";
$resStart = 0;
$resLimit = 50;
$pswd = "v8s60:BasicAPIPassword1";

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
// echo $JSON1;
// echo $JSON;


foreach ($CO2_JSON1['items'] as $item) {
  // echo 'uid: ' . $item['uid'].'<br />';
  // echo 'Values: ';
  foreach ($item['values'] as $paths) {
    if ($paths['path']=="kWhPerCycle"){
    // print_r($paths);
    // print_r($paths['value']);
    $CO2ValuesArr[$item['uid']]=$paths['value'];
  }}
  // echo '<br />';
  // echo '<br />';
}

    // prettyPrint( $JSON ) === prettyPrint( prettyPrint( $JSON ) );
// echo "hello";
// print_r($CO2ValuesArr);
$resStart=$resStart+$resLimit;
} while ($CO2_JSON1["resultsTruncated"]);



$ApplianceQuery = "SELECT * FROM CO2Appliances";
$AppResult = mysqli_query($conn, $ApplianceQuery);

while ($row = mysqli_fetch_assoc($AppResult)) {
	$appname=$row["Appliance_Name"];
  if ($_POST[$appname]<>0) {
  // echo "<br />";
  // echo "<br />";
  // echo ($row["Appliance_Name"]);
  // echo "<br />";
  $CO2IncPerRow=0;

	if ($row["Appliance_CO2"]!=0){
    $CO2IncPerRow = $row["Appliance_CO2_Avg"]-($_POST[$appname]*$row["Appliance_CO2"]);
	} else {
        if(isset($_POST[$appname."_Eco1"]) && isset($_POST[$appname."_Eco2"])) {
          // echo ($_POST[$appname."_Eco1"]);
          // echo ($_POST[$appname."_Eco2"]);
          $CO2IncPerRow = $_POST[$appname]*($CO2ValuesArr[$row["API_Normal"]]-$CO2ValuesArr[$row["API_Eco2"]])*28307;


        } else {
          if(isset($_POST[$appname."_Eco2"])) {
            // echo ($_POST[$appname."_Eco2"]);
            $CO2IncPerRow = $_POST[$appname]*($CO2ValuesArr[$row["API_Eco1"]]-$CO2ValuesArr[$row["API_Eco2"]])*28307;


          } else {
            if(isset($_POST[$appname."_Eco1"])) {
              // echo ($_POST[$appname."_Eco1"]);
              $CO2IncPerRow = $_POST[$appname]*($CO2ValuesArr[$row["API_Normal"]]-$CO2ValuesArr[$row["API_Eco1"]])*28307;
            } else {
                setcookie('Eco_Rec', 1);
            };


    // $CO2IncPerRow = $_POST[$appname]*($CO2ValuesArr[$row["API_Normal"]]-$CO2ValuesArr[$row["API_Eco1"]])*28307;
    // echo "<br /> Normal: ";
    // echo $CO2ValuesArr[$row["API_Normal"]];
    // echo "<br /> Eco1: ";
    // echo $CO2ValuesArr[$row["API_Eco1"]];
    // echo "<br /> Eco2: ";
    // echo $CO2ValuesArr[$row["API_Eco2"]];

}}};

		//$CO2IncPerRow = $_POST[$appname]*($row["Appliance_CO2"]-)
  // echo "<br /> Inc Per Row: ";
  // echo $CO2IncPerRow;
	$CO2Increase=$CO2Increase+$CO2IncPerRow;
  // echo "<br /> Increase: ";
  // echo $CO2Increase;
}
};


$username=$_SESSION["username"];
$CO2UPQuery = "UPDATE CO2Accounts SET CO2Count=CO2Count+$CO2Increase WHERE username='$username'";
$CO2UPResult = mysqli_query($conn, $CO2UPQuery);
setcookie('CO2Count', ($_COOKIE['CO2Count']+$CO2Increase));
// mysqli_fetch_assoc($CO2UPResult);

// echo $username;
// echo $CO2Increase;
setcookie('CO2Increase', $CO2Increase);
if ($CO2Increase>0){
  setcookie('CO2Saved', 1);
};
if ($CO2Increase<0){
  setcookie('CO2Saved', 0);
};
// echo "Pre run";
// darkenBackground();
// echo "Post run";

header("Location: home.php");
exit;
?>
