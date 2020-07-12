  <nav role="navigation" class="navbar foreground fixed-top" >
    <!-- If the username is set, show logout button and the users name -->
    <?php if (isset($_SESSION["username"])){
    echo ('<a class="navbar-brand" href="home.php" style="color:#1c1c1c">Carbon Footprint Estimator!</a>');
    echo ('<a class="navbar-center" href="logout.php" style="color:#1c1c1c"> Hello ');
    echo ($_SESSION["username"]);
    echo ('! Logout? </a>');
  }
  else{
    // Show login redirect button
    echo ('<a class="navbar-brand" href="login.php" style="color:#1c1c1c">Carbon Footprint Estimator!</a>');
    echo ('<a class="navbar-center" href="login.php" style="color:#1c1c1c"> Login </a>');
  }
?>
  </nav>
  <br/>
  <br/>
  <br/>
