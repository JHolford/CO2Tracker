<?php

  // IMPORTANT: Change the connection parameters to reflect our MySQL setup...
  //            Server name: katara.scam.keele.ac.uk
  //            Username: your username (eg. v0x00)
  //            Password: your username twice (eg. v0x00v0x00 NOT your usual login password)

  $servername = "katara.scam.keele.ac.uk";
  $username = "v8s60";
  $password = "v8s60v8s60";
  $dbname = "v8s60";

  // $servername = 'localhost';
  // $username = 'root';
  // $password = '';
  // $dbname = 'v8s60';

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
  if (!$conn) {
  	die("Connection failed: " . mysqli_connect_error());
  // } else {
    // die("Connection successful");
  }
?>
