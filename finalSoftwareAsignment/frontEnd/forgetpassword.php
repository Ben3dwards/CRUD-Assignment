<?php 
    include '..\backEnd\db.php';
    //include 'backEndClass\postsCommentsFunction.php';
    session_start();  // Start a new or resume the existing session
   
    if (empty($_SESSION['username'])) {
        // Session variable 'user_email' is not set, so redirect to the login page
        header("Location: signUp.php");
        exit;
    }else{
        echo "User ID: " . $_SESSION['userID'];
    }

    
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-    scale=1.0">
  <title>Forgot Password</title>
  <link rel="stylesheet" href="static/styles.css">
</head>

<body>
  <div id="menu">
    <a href="index.php">
      <h2>Litteria Brevia</h2>
      <h3>This is not complete yet</h3>
    </a>
  </div>

  <div id="main">
    <p>Enter your username:</p><input>
    <p>Enter your email:</p><input>
    <input type="submit" value="submit">
    <p>Already have an account? <a href="../frontEnd/signUp.php">Sign In</a></p>


</body>



</html>