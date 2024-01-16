<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href= "../scripts/styles.css">
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
      <h1>Sign In</h1><br>
      <form id="signIn" action = "..\backEnd\processSignIn.php" method="post">
        <label for="email">Enter your email:</label>
        <input type="email" id="email_signin" name="email" required><br>

        <label for = "password">Enter your password</label>
        <input type = "password" id = "password_signin" name = "password" required><br>

        <br><input id="signIn_button" class="signIn_button" type = "submit" name="submit">
      </form>

      <?php
        //incorect email/password
        if (isset($_SESSION['loginError'])){
          $error = $_SESSION['loginError'];
          echo "<h4>$error</h4>";
          unset($_SESSION['loginError']); //unset the session
        }

      ?>

        <p>Don't have an account? <a href="SignUp.php">Create one</a></p>
        <p><a href="forgetpassword.php">Forgot your password?</a></p>
    </div>
  
  <script src="script.js" defer></script>
  </body>
</html>
