<nav class="navbar nav-pills navbar-light navbar-expand-md bg-faded justify-content-center">
    <!-- If the username is set, show logout button and the users name -->
    <?php if (isset($_SESSION["username"])){
    echo ('<a href="/" class="navbar-brand d-flex w-50 mr-auto">Carbon Footprint Estimator!</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
        <span class="navbar-toggler-icon"></span>
      </button><div class="navbar-collapse collapse w-100" id="collapsingNavbar">
        <ul class="navbar-nav w-100 justify-content-center">');


    $moduleQuery = "SELECT * FROM CO2Modules";
    $result = mysqli_query($conn, $moduleQuery);
    $moduleList = array();

    // <li class="nav-item active">
    //       <a class="nav-link" href="#">Link</a>
    // </li>
    while ($row = mysqli_fetch_assoc($result)) {
      echo ('<li class="nav-item active">
            <a class="nav-link" data-toggle="pill" href="#');
      echo ($row["Module_Name"]);
      echo ('">');
      echo ($row["Module_Name"]);
      echo ('</a></li>');

    };
    // </ul>
    //     <ul class="nav navbar-nav ml-auto w-100 justify-content-end">
    //         <li class="nav-item">
    //             <a class="nav-link" href="logout.php">Hello </a>
    //         </li>
    //         <li class="nav-item">
    //             <a class="nav-link" href="#">Right</a>
    //         </li>
    //         <li class="nav-item">
    //             <a class="nav-link" href="#">Right</a>
    //         </li>
    //     </ul>


    echo ('</ul>
        <ul class="nav navbar-nav ml-auto w-100 justify-content-end">
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Hello ');
    echo ($_SESSION["username"]);
    echo ('! Logout? </a>');
  }
  else{
    // Show login redirect button
    echo ('<a class="navbar-brand" href="login.php" style="color:#1c1c1c">Carbon Footprint Estimator!</a>');
    echo ('<a class="navbar-center" href="login.php" style="color:#1c1c1c"> Login </a>');
  };
$conn->close();

  ?>

  </nav>
  <br/>
  <br/>
  <br/>
