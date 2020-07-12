<html>
 <head>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <link rel="stylesheet" href="cwStyle.css" >

   <?php
   session_start();

    ?>
  <title>Login</title>
  <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->
 </head>
 <body class="sitewide">

   <?php
   include("navbar.php");
   ?>
<!-- Create container in the centre of the screen -->
         <div  class="row  vertical-center justify-content-center">
             <div class="popout">
                <div class="popout">
               <h2> Login </h2>

  Please enter your username and password below:

  <form action="authenticate.php" method="POST">
   Enter your username:<br />
   <input type="text" name="username" />
   <br />
   Enter your password:<br />
   <input type="password" name="password" />

    <p />
    <!-- Include Google reCaptcha v2 -->
   <!-- <div class="g-recaptcha" data-sitekey="6LfUCe4UAAAAAOnUBfNaaKTHaazje2W1OFw18aPv"></div> -->

   <input type="submit" value="Login" />

	</form>

  <!-- <form action="guest.php" method="POST">
  <input type="submit" value="View Site as Guest!" />
  </form> -->

  <form action="registration.php" method="POST">
  <input type="submit" value="Register?" />
  </form>

</div>
</div>
</div>

 </body>
</html>
