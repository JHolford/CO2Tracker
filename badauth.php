<!-- This file is reused from the Web Tech Module Coursework -->
<html>
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="Style.css" >

    <title>Failed login</title>
  </head>
  <body>
    <?php
      include("navbar.php");
    ?>
    <div>
      <h2>Unauthorised Access</h2>

      <p>You are either typed the wrong password or attempted to view a page without logging in.</p>
      <p>To return to the login page, click <a href="login.php">here</a>.</p>
    </div>
  </body>
</html>
