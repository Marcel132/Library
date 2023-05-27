<?php
session_start();

$response = array();

// Check if the user is logged in
if(isset($_SESSION['user_id'])){
  $response['isLoggedIn'] = true;
} else {
  $response['isLoggedIn'] = false;
}

// Set the response content type to JSON
header('Content-Type: application/json');

// Encode the response array as JSON and output it
echo json_encode($response);
?>