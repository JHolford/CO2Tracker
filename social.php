<?php

if (!isset($_COOKIE['socialJSON'])){
  header("Location: home.php");
  exit;
} else {
$socialData = gzinflate($_COOKIE['socialJSON']);
// $socialDataDecoded= json_decode($_COOKIE['socialJSON'],true);
$socialDataDecoded= json_decode($socialData,true);
$socialDataDecoded= json_decode($socialDataDecoded,true);


echo ("<h4>Based on ");
echo ($_SESSION["username"]);
echo ("'s friends list, the following friends were found:</h4><br />");
// for ($i = 0; $i < count($socialData);$i++){
//   echo ($i);
// };
$sortedArray = array();
foreach ($socialDataDecoded['posts'] as $socialItems){
  $dataForInsert=$socialItems["fName"]." ".$socialItems["sName"]."! User Since: ".$socialItems["userSince"];
  $sortedArray[$dataForInsert]=$socialItems["carbonSaved"];
    // foreach ($socialItems[] as $socialItems){
};

arsort($sortedArray);

foreach ($sortedArray as $detail => $carbonValue){
  echo ("<h5>");
  echo ($detail);
  echo ("</h5>");
  echo ("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; In total, they have saved: <b>");
  echo (number_format((float)($carbonValue/1000), 2, '.', ''));
  echo ('</b>kgs of CO2');
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




// };
// print_r($socialDataDecoded);
// echo ("<br />");
// echo ("<br />");
// echo ("<br />");
// echo ("<br />");
// if (is_array($socialDataDecoded)) {
//   foreach($socialDataDecoded as $obj) {
//     $objDecoded = json_decode($obj);
//     foreach($objDecoded as $objItem) {
//       echo $objItem;
//       echo ("<br />");
//     };
//   };
// } else {
//     echo 'no results';
// };

};
?>
