<!-- This file is adapted from the Web Tech Module Coursework with the google reCaptcha Module removed-->
<html>
 <head>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <link rel="stylesheet" href="Style.css" >

   <?php
   session_start();
   // Set the default BackGreen value on login
   setcookie('BackGreen', 223);
    ?>
  <title>Login</title>
 </head>
 <body>
   <!-- Include navbar -->
   <?php
   include("navbar.php");
// If account has just been created, show alert letting the user know that they were successful
   if(isset($_COOKIE['AccountCreated'])){
       if ($_COOKIE['AccountCreated']==1){
       // SUCCESS
       echo ("<script type='text/javascript'>alert('Account Created! Please login!');</script>");
       setcookie("AccountCreated", 0);
     };
   };
   ?>

<!-- Create container in the centre of the screen -->
         <div  class="row  justify-content-center">
             <div >
                <div >
               <h2> Login </h2>

  Please enter your username and password below:
<!-- Fairly standard login form -->
  <form action="authenticate.php" method="POST">
   Enter your username:<br />
   <input type="text" name="username" />
   <br />
   Enter your password:<br />
   <input type="password" name="password" />

    <p />

   <input class="button" type="submit" value="Login" />

	</form>
<!-- Registration button -->
  <form action="registration.php" method="POST">
  <input class="button" type="submit" value="Click here to register" />
  </form>

</div>
</div>
</div>

 </body>
</html>
