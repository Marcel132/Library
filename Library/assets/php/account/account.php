<?php
  session_start();
  require_once('../connect.php');

  if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    $getUserQuery = "SELECT * FROM `users` WHERE `ID` = ?";
    $stmt = mysqli_prepare($conn, $getUserQuery);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    $name = $user['Name'];
    $surname = $user['Surname'];
    $email = $user['Email'];

    mysqli_stmt_close($stmt);
  } else {
    header('Location: ../../../index.html');
    exit();
  }
?>


<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteka</title>

  <link rel="stylesheet" href="../../css/account.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;1,100&display=swap" rel="stylesheet">

</head>
<body>
  <nav class="navigation">
    <h1 class="logo">Biblioteka</h1>
    <div id="profile">
      <div id="profile-button"><img src="../../../img/account.svg" alt="profile"></div>
    </div>
  </nav>

  <main>
    <div class="container">
      <button type="submit" id="add-book-btn">+ Dodaj Książkę</button>

      <div id="account" class="main-content">
        <div id="account-info">
          <b>Imię:</b> <?php echo $name; ?> <br>
          <b>Nazwisko:</b> <?php echo $surname; ?><br>
          <b>Adres email:</b> <?php echo $email; ?><br>
        </div>

        <div id="log-out"><a href="../logout.php">Wyloguj się</a></div>
      </div>

      <div id="books" class="books">
        <?php
          require_once('../connect.php');

          $takeBookQuery = "SELECT * FROM `books` WHERE `ID_user` = ?";
          $stmt = mysqli_prepare($conn, $takeBookQuery);
          mysqli_stmt_bind_param($stmt, "i", $userId);
          mysqli_stmt_execute($stmt);
          $resultTakeBook = mysqli_stmt_get_result($stmt);

          while($row = mysqli_fetch_assoc($resultTakeBook)){
          $getTitle = $row['Title'];
          $getAuthor = $row['Author'];
          $getPages = $row['Pages'];
          $getIsRead = $row['isRead'];

          if($getIsRead == '0'){
            $getIsRead = "Nie przeczytane";
          } else {
            $getIsRead = "Przeczytane";
          }

          echo '<div class="book">
            <h4> Tytuł: ' . $getTitle . '</h4>
            <p> Autor: ' . $getAuthor . '</p>
            <p> Ilość stron: ' . $getPages . '</p>
            <p> Status: ' . $getIsRead . '</p>
          </div>';
          }
          mysqli_stmt_close($stmt);
          mysqli_close($conn);
        ?>
      </div>

      <div id="library" class="main-content">  
        <form id="add-books-form" action="../library.php" method="post">
          <h3>Dodaj Książkę</h3>
          <input class="input"
          id="title"
          name="title"
          type="text"
          placeholder="Tytuł"
          required
          >
          <input class="input"
          id="author"
          name="author"
          type="text"
          placeholder="Autor"
          required
          >
          <input class="input"
          id="pages"
          name="pages"
          type="text"
          placeholder="Ilość stron"
          required
          >
          <div class="is-read">
            <label for="is-read">Czy przeczytałeś to?</label>
            <input type="checkbox" class="checkbox" name="isRead" value="1">
          </div>
          <button id="sumbit-add-book" class="sumbit-button" type="submit">Dodaj Książkę</button>
        </form>
      </div>
    </div>
  </main>
  <footer class="footer">
    <p>Copyright &copy;
      <script>
        document.write(new Date().getFullYear());
      </script>
      <a href="https://github.com/Marcel132">
      Marcel132
      <img src="../../../img/github.svg" alt="link to github Marcel132"></a>
    </p>
  </footer>
  <script src="../../js/variable.js"></script>
  <script src="../../js/account.js"></script>
  <script src="../../js/session.js"></script>
</body>
</html>