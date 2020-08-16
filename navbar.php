  <nav style="background:#F6F4D2" role="navigation" class="navbar foreground fixed-top">

    <?php
    $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
    if ($curPageName=="login.php"){
    // Show login redirect button
    echo ('<a class="navbar-brand" href="login.php" style="color:#A44A3F">Carbon Footprint Estimator!</a>');
    echo ('<a class="navbar-center" href="login.php" style="color:#A44A3F"> Login </a>');
  }
  else{

     // If the username is set, show logout button and the users name
    if (isset($_SESSION["username"])){
    echo ('<a class="navbar-brand" href="home.php" style="color:#A44A3F">Carbon Footprint Estimator!</a>');
    ?>
    <!-- Centered Tabs -->


    <?php

    echo ('<li class="noBullet"><span style="color:#A44A3F" class="col-sm" href="#">Current CO2 Saving: ');
    echo (number_format((float)($_COOKIE["CO2Count"]/1000), 2, '.', ''));
    // echo (round_to_2dp($_COOKIE["CO2Count"]/1000));
    echo ('kg</span></li>');
?>
<ul class="nav nav-pills ">
<?php
echo ('<li class="active"><a data-toggle="pill" class="nav-item col-sm" href="#Home">Home</a></li>');


    $moduleQuery = "SELECT * FROM CO2Modules";
    $result = mysqli_query($conn, $moduleQuery);
    $moduleList = array();


    while ($row = mysqli_fetch_assoc($result)) {
      echo ('<li><a data-toggle="pill" class="nav-item col-sm" href="#');
      echo ($row["Module_Name"]);
      echo ('">');
      echo ($row["Module_Name"]);
      echo ('</a></li>');

    };



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
  <br/>
  <br/>
  <br/>
