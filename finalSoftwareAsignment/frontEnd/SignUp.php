<?php session_start();  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Form Data</title>
    <link rel="stylesheet" href="../scripts/styles.css">
  </head>

  <body>
  <div id="banner" class="banner">
  <ul class="LOGO">
    <img src="https://t3.ftcdn.net/jpg/04/45/30/52/360_F_445305267_3K9H9hVzh1Ib8BRh0D8LuvVlfOb5muXa.jpg" alt="LOGO">
  </ul>
  <div id="accountMenu" class="accountMenu">
    <a href="index.php"><h2>Litteria Brevia</h2></a>
  </div>
</div>

      <div id="accountForm" class="accountForm">
        <h1>Sign Up</h1><br>

        <form id="signUp" action = "../backEnd/processSignUp.php" method="post">
          <label for="email">Enter your email:</label>
          <input type="email" id="email" name="email" required><br>

          <label for="name">Enter your name:</label>
          <input type="text" id="name" name="name" required><br>

          <label for="username">Enter your username:</label>
          <input type="text" id="username" name="username" required><br>

          <label for="bio">Enter your bio:</label>
          <input type="text" id="bio" name="bio" required><br>

          <label for = "password">Enter your password: </label>
          <input type = "password" id = "password" name="password"><br> 

          <label for = "password">Re-enter your password: </label>
          <input type = "password" id = "passwordConfirm" name = "passwordConfirm" required><br>

          <button id ="signUp_button" class ="signUp_button" type="type" name="submit">Sign up</button>

          <p id="errorText" style="color: red; display: none;">passwords dont match please try again</p>
        </form>
        

        <?php
        //Display that the username or email is taken
          if (isset($_SESSION['inUseError'])) {
            $error = $_SESSION['inUseError'];
            echo "<h4>$error</h4>";
            unset($_SESSION['inUseError']);
          }
        ?>

        <p>Already have an account? <a href="signIn.php">Sign In</a></p>
      </div>

  <script src="script.js" defer></script>
  </body>
</html>
