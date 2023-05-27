<?php
session_start();
require_once('connect.php'); //Connect with connect.php

// Checking variables (method POST)
if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['loginSignUp']) && isset($_POST['passwordSignUp'])){
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $email = $_POST['loginSignUp'];
  $password = $_POST['passwordSignUp'];
  $date = date('Y-m-d H:i:s');


  $hashedPassword = password_hash($password, PASSWORD_DEFAULT); //Hashing the password

  $checkUserQuery = "SELECT * FROM `users` WHERE `Email` = ?";  // Download records from databaes

  // Add SQL injections protection 
  $stmt = mysqli_prepare($conn, $checkUserQuery);  
  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);

  // If there is error, show comunicate 
  if (mysqli_stmt_errno($stmt) !== 0) {
    echo "Błąd zapytania SELECT: " . mysqli_stmt_error($stmt);
}

  $resultCheckUser = mysqli_stmt_get_result($stmt);

  // Checking if there is the same email like emal in database. If yes - return to main page, if no - add record to database
  if(mysqli_num_rows($resultCheckUser) > 0) {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header('Location: ../../index.html');
    exit();
  } else {

    $addUserQuery = "INSERT INTO `users`(`Name`, `Surname`, `Email`, `Password`, `Date`) VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $addUserQuery);
    mysqli_stmt_bind_param($stmt, "sssss", $name, $surname, $email, $hashedPassword, $date);
    mysqli_stmt_execute($stmt);

    // If there is error, show comunicate 
    if (!$stmt) {
    die("Query failed: " . mysqli_error($conn));
    }

    // Create session and go to account page
    $user_id = mysqli_insert_id($conn);
    $_SESSION['user_id'] = $user_id;
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: account/account.php");
    exit();
  }
}

mysqli_close($conn);
?>