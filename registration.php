<html>
 <head>
   <!-- Import Bootstrap and CSS file -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <link rel="stylesheet" href="Style.css" >

  <title>Registration</title>
 </head>
 <body class="sitewide">

<?php
// Include navbar
include("navbar.php");
?>
  <h2>Registration</h2>

  Please create a username and password below:

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
