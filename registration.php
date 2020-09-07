<!-- This authentication system is adapted from the Web Tech Module Coursework -->
<html>
 <head>
   <!-- Import Bootstrap and CSS file -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <link rel="stylesheet" href="Style.css" >

  <title>Registration</title>
 </head>
 <body>

<?php
// Include navbar
include("navbar.php");

// If account creation has failed, show alert letting the user know that they were unsuccessful and why
   if(isset($_COOKIE['AccountCreated'])){
       if ($_COOKIE['AccountCreated']==2){
       // Generic Failure
       echo ("<script type='text/javascript'>alert('Account creation failed, please try again!');</script>");
       setcookie("AccountCreated", 0);
     };
     if ($_COOKIE['AccountCreated']==3){
     // Username already taken
     echo ("<script type='text/javascript'>alert('Account creation failed! Username already taken!');</script>");
     setcookie("AccountCreated", 0);
   };
   };
?>
  <h2>Registration</h2>

  Please create a username and password below:
<!-- Form that will send user details to a php file that inserts new user records -->
  <form action="insertRecord.php" method="POST">
   Enter your username:<br />
   <input type="text" name="username" />
   <br />
   Enter your password:<br />
   <input type="password" name="password" />
   <br />
   <input type="submit" value="Register" />
  </form>

 </body>
</html>
