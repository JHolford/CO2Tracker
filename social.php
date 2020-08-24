<?php


$socialData = gzinflate($_COOKIE['socialJSON']);
// $socialDataDecoded= json_decode($_COOKIE['socialJSON'],true);
$socialDataDecoded= json_decode($socialData,true);
$socialDataDecoded= json_decode($socialDataDecoded,true);


echo ("hello, this is the social.php content!");
echo ("<br />");
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
  echo ($detail);
  echo ("<br />");
  echo ("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; In total, they have saved: <b>");
  echo (number_format((float)($carbonValue/1000), 2, '.', ''));
  echo ('</b>kgs of CO2');
  if ($_COOKIE["CO2Count"]<$carbonValue){
    $CO2Diff = $carbonValue-$_COOKIE["CO2Count"];
    echo ("<br />");
    echo ("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; They are <i>");
    echo (number_format((float)($CO2Diff/1000), 2, '.', ''));
    echo ('</i>kgs ahead of you!');

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


?>
