<?php include("connection.php"); ?>
<?php
session_start();
$username = $_POST['username'];
$password = $_POST['password'];
// $secretKey = "6LfUCe4UAAAAAOuI6VfUIgOHXRhlvzZjgfNHV0jP";
// $responseKey = $_POST['g-recaptcha-response'];

$hash = password_hash($password, PASSWORD_DEFAULT);

// $userIP= $_SERVER['REMOTE_ADDR'];

//Implement google reCaptcha v2 API call
// $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
// $response= file_get_contents($url);
// $_SESSION['responseG'] = $response;
//
// $result=json_decode($response);


// if ($result->success){



if ($password==""){
	$location = 'badauth.php';
	header("Location: $location");
	return;
}
/*
 * This uses a simple array to store a set of valid login combinations.  These would normally
 * be stored as a hashed string
 * in a database of some sort.  The hashed versions would be compared so the actual
 * password never has to be stored
 */
$passQuery = "SELECT * FROM CO2Accounts";
$result = mysqli_query($conn, $passQuery);
$passlist = array();
while($row = mysqli_fetch_assoc($result)) {
					$usernameLookup = $row['username'];
					$passwordLookup = $row['password'];
					$passlist[$usernameLookup]=$passwordLookup;
				}

				mysqli_close($conn);



if(password_verify($password,$passlist[$username])){
	// SUCCESS
	session_start();
	//session_regenerate_id();
	$_SESSION['id'] = session_id();
	$_SESSION['username'] = $username;
	// $_SESSION['voteList'] = array();

	//Set admin status.
	//Not currently utilised as there is no direct link to secure-admin.php
	//However, secure-admin.php can still be accessed by directly editing the url
	//this tests whether or not you are an Admin

	// if($username=='v8s60'){
	// 	$_SESSION['admin'] = true;
	// }else{
	// 	$_SESSION['admin'] = false;
	// }

	$location = 'home.php';
}else{
	// FAILURE
	$location = 'badauth.php';
}

header("Location: $location");
exit;

$location = 'badauth.php';
header("Location: $location");
return;
?>
