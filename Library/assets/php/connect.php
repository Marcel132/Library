<?php
  $servername = "localhost:3308";
  $username = "root";
  $password = "";
  $database = "library";
  
  $conn = new mysqli($servername, $username, $password, $database);

  if ($conn->connect_error) {
      echo "<script>console.log('Connection failed: " . $conn->connect_error . "');</script>";
  } else {
      echo "<script>console.log('Connected successfully with database');</script>";
  }
?>