<<<<<<< Updated upstream
<!-- Create navbar fixed to the top of the screen -->
<nav style="background:#F6F4D2" role="navigation" class="navbar foreground fixed-top">

    <?php
    $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
    if ($curPageName=="login.php"){
    // Show login redirect button (With home button replaced by login button as the user is not
    // able to access the home page without being logged in)
    echo ('<a class="navbar-brand" href="login.php" style="color:#A44A3F">Carbon Footprint Estimator!</a>');
    echo ('<a class="navbar-center" href="login.php" style="color:#A44A3F"> Login </a>');
  }
  else{

     // If the username is set, show logout button and the users name
    if (isset($_SESSION["username"])){
    echo ('<a class="navbar-brand" href="home.php" style="color:#A44A3F">Carbon Footprint Estimator!</a>');

    // CO2 Saving as a list item in the navbar to maintain good relative positions of nav items
    echo ('<li class="noBullet"><span style="color:#A44A3F" class="col-sm" href="#">Current CO2 Saving: ');
    // Convert CO2 to kg and display to 2 decimal places
    echo (number_format((float)($_COOKIE["CO2Count"]/1000), 2, '.', ''));
    echo ('kg</span></li>');
?>
<!-- Centered Tabs from Bootstrap's tutorials -->
<ul class="nav nav-pills ">
<?php
// Default to having the basic Home tab be active.
// This is so that the whole system still functions even with no modules being added on
echo ('<li class="active"><a data-toggle="pill" class="nav-item col-sm" href="#Home">Home</a></li>');

    $moduleQuery = "SELECT * FROM co2modules";
    $result = mysqli_query($conn, $moduleQuery);
// Generate additional tabs based on modules listed in the database
    while ($row = mysqli_fetch_assoc($result)) {
      echo ('<li><a data-toggle="pill" class="nav-item col-sm" href="#');
      echo ($row["Module_Name"]);
      echo ('">');
      echo ($row["Module_Name"]);
      echo ('</a></li>');

    };
// Add a logout button to the right hand side of the navbar
    echo ('</ul><a class="navbar-center ml-auto  justify-content-end" href="logout.php" style="color:#A44A3F"> Hello ');
    echo ($_SESSION["username"]);
    echo ('! Logout? </a>');
  }
  else{
    // Show login redirect button
    echo ('<a class="navbar-brand" href="login.php" style="color:#A44A3F">Carbon Footprint Estimator!</a>');
    echo ('<a class="navbar-center" href="login.php" style="color:#A44A3F"> Login </a>');
  };
}
  ?>

  </nav>
  <!-- Include a couple of line breaks to prevent content being obscured by the navbar -->
  <br/>
  <br/>
  <br/>
=======
<!-- Create navbar fixed to the top of the screen -->
<nav style="background:#F6F4D2" role="navigation" class="navbar foreground fixed-top">

    <?php
    $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
    if ($curPageName=="login.php"){
    // Show login redirect button (With home button replaced by login button as the user is not
    // able to access the home page without being logged in)
    echo ('<a class="navbar-brand" href="login.php" style="color:#A44A3F">Carbon Footprint Estimator!</a>');
    echo ('<a class="navbar-center" href="login.php" style="color:#A44A3F"> Login </a>');
  }
  else{

     // If the username is set, show logout button and the users name
    if (isset($_SESSION["username"])){
    echo ('<a class="navbar-brand" href="home.php" style="color:#A44A3F">Carbon Footprint Estimator!</a>');

    // CO2 Saving as a list item in the navbar to maintain good relative positions of nav items
    echo ('<li class="noBullet"><span style="color:#A44A3F" class="col-sm" href="#">Current CO2 Saving: ');
    // Convert CO2 to kg and display to 2 decimal places
    echo (number_format((float)($_COOKIE["CO2Count"]/1000), 2, '.', ''));
    echo ('kg</span></li>');
?>
<!-- Centered Tabs from Bootstrap's tutorials -->
<ul class="nav nav-pills ">
<?php
// Default to having the basic Home tab be active.
// This is so that the whole system still functions even with no modules being added on
echo ('<li class="active"><a data-toggle="pill" class="nav-item col-sm" href="#Home">Home</a></li>');

    $moduleQuery = "SELECT * FROM co2modules";
    $result = mysqli_query($conn, $moduleQuery);
// Generate additional tabs based on modules listed in the database
    while ($row = mysqli_fetch_assoc($result)) {
      echo ('<li><a data-toggle="pill" class="nav-item col-sm" href="#');
      echo ($row["Module_Name"]);
      echo ('">');
      echo ($row["Module_Name"]);
      echo ('</a></li>');

    };
// Add a logout button to the right hand side of the navbar
    echo ('</ul><a class="navbar-center ml-auto  justify-content-end" href="logout.php" style="color:#A44A3F"> Hello ');
    echo ($_SESSION["username"]);
    echo ('! Logout? </a>');
  }
  else{
    // Show login redirect button
    echo ('<a class="navbar-brand" href="login.php" style="color:#A44A3F">Carbon Footprint Estimator!</a>');
    echo ('<a class="navbar-center" href="login.php" style="color:#A44A3F"> Login </a>');
  };
}
  ?>

  </nav>
  <!-- Include a couple of line breaks to prevent content being obscured by the navbar -->
  <br/>
  <br/>
  <br/>
>>>>>>> Stashed changes
