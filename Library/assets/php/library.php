<?php

session_start();
require_once('connect.php');

// Check method download records from database

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $user_id = $_SESSION['user_id'];
        
    $title = $_POST['title'];
    $author = $_POST['author'];
    $pages = $_POST['pages'];
    // If isRead = 0 it means isRead =  `Nie przeczytałem`. If 1 - `Przeczytałem`
    if (isset($_POST['isRead'])) {
        $isRead = $_POST['isRead'];

        $updateIsReadQuery = "UPDATE `books` SET `isRead` = ? WHERE `ID_user` = ?";
        $stmt = mysqli_prepare($conn, $updateIsReadQuery);
        mysqli_stmt_bind_param($stmt, "ii", $isRead, $userId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }


    // Add data from user to database
    $addBookQuery = "INSERT INTO `books`(`ID_user`, `Author`, `Title`, `Pages`, `isRead`) VALUES ('$user_id','$title','$author','$pages','$isRead')";
    $resultAddBook = mysqli_query($conn, $addBookQuery);


    if($resultAddBook){
        header('Location: account/account.php');
    } else {
        echo 'Wystąpił błąd podczas dodawania';
    }
    
}


$conn->close();


?>