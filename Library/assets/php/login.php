<?php
session_start();
require_once('connect.php');

// Checking variables (method POST)
if (isset($_POST['login']) && isset($_POST['password'])) {
  $login = $_POST['login'];
  $password = $_POST['password'];

  // Download record from database 
  $checkUserQuery = "SELECT * FROM `users` WHERE `Email` = ?";

  // SQL injection protection 
  $stmt = mysqli_prepare($conn, $checkUserQuery);
  mysqli_stmt_bind_param($stmt, "s", $login);
  mysqli_stmt_execute($stmt);
  $resultCheckUser = mysqli_stmt_get_result($stmt);

  // Checking Email. If this email is the same email from database, verify password, if not - dont log
  if (mysqli_num_rows($resultCheckUser) > 0) {
    $user = mysqli_fetch_assoc($resultCheckUser);
    $hashedPassword = $user['Password'];
  
  // Check Password. If password is correct - log, if not - go to main page
    if (password_verify($password, $hashedPassword)) {
      $_SESSION['user_id'] = $user['ID'];
      mysqli_stmt_close($stmt);
      mysqli_close($conn);
      header("Location: account/account.php");
      exit();
    }
  }

  mysqli_stmt_close($stmt);
  mysqli_close($conn);
  header('Location: ../../index.html');
  exit();
}

$conn->close();
?>