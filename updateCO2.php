<?php
include("connection.php");
mysqli_close($conn);
include("connection.php");
session_start();
$CO2Increase=0;

echo $_COOKIE["Appliance_JSON"];
$Appliance_JSON1 = $_COOKIE["Appliance_JSON"];
$Appliance_JSON = json_decode($_COOKIE["Appliance_JSON"],true);



function prettyPrint( $json )
{
    $result = '';
    $level = 0;
    $in_quotes = false;
    $in_escape = false;
    $ends_line_level = NULL;
    $json_length = strlen( $json );

    for( $i = 0; $i < $json_length; $i++ ) {
        $char = $json[$i];
        $new_line_level = NULL;
        $post = "";
        if( $ends_line_level !== NULL ) {
            $new_line_level = $ends_line_level;
            $ends_line_level = NULL;
        }
        if ( $in_escape ) {
            $in_escape = false;
        } else if( $char === '"' ) {
            $in_quotes = !$in_quotes;
        } else if( ! $in_quotes ) {
            switch( $char ) {
                case '}': case ']':
                    $level--;
                    $ends_line_level = NULL;
                    $new_line_level = $level;
                    break;

                case '{': case '[':
                    $level++;
                case ',':
                    $ends_line_level = $level;
                    break;

                case ':':
                    $post = " ";
                    break;

                case " ": case "\t": case "\n": case "\r":
                    $char = "";
                    $ends_line_level = $new_line_level;
                    $new_line_level = NULL;
                    break;
            }
        } else if ( $char === '\\' ) {
            $in_escape = true;
        }
        if( $new_line_level !== NULL ) {
            $result .= "\n".str_repeat( "\t", $new_line_level );
        }
        $result .= $char.$post;
    }

    return $result;
}


prettyPrint( $Appliance_JSON1 ) === prettyPrint( prettyPrint( $Appliance_JSON1 ) );







$ApplianceQuery = "SELECT * FROM CO2Appliances";
$AppResult = mysqli_query($conn, $ApplianceQuery);

while ($row = mysqli_fetch_assoc($AppResult)) {
	$appname=$row["Appliance_Name"];
	if ($row["Appliance_CO2"] !=0){
		$CO2IncPerRow = $_POST[$appname]*$row["Appliance_CO2"];
	} else {
		// if $Appliance_JSON['items'];
		// echo $Appliance_JSON1->$row["API_Normal"]->kWhPerCycle;

		}

		//$CO2IncPerRow = $_POST[$appname]*($row["Appliance_CO2"]-)

	$CO2Increase=$CO2Increase+$CO2IncPerRow;
};
$username=$_SESSION["username"];
$CO2UPQuery = "UPDATE CO2Accounts SET CO2Count=CO2Count+$CO2Increase WHERE username='$username'";
$CO2UPResult = mysqli_query($conn, $CO2UPQuery);
// mysqli_fetch_assoc($CO2UPResult);

// echo $username;
// echo $CO2Increase;


// header("Location: home.php");
// exit;
?>
