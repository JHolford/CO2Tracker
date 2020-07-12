<?php


//destroys the session so next time session_start() is run a new session id will be generated
session_start();
session_destroy();
unset($_SESSION['username']);
?>

<html>
 <head>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <link rel="stylesheet" href="cwStyle.css" >
  <title>Logout</title>
 </head>
 <body class="sitewide">
   <?php
   include("navbar.php");
   ?>
  <h2>Logout</h2>

  You have been successfully logged out.
  <p>
  To return to the login page, click <a href="login.php">here</a>.

 </body>
</html>
