<?php 
    include '..\backEnd\db.php';
    include '..\backEnd\processProfile.php';
    session_start();  // Start a new or resume the existing session
   
    if (empty($_SESSION['username'])) {
        // Session variable 'user_email' is not set, so redirect to the login page
        header("Location: signUp.php");
        exit;
    }

    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../scripts/styles.css">
    <title>Profile page</title>
  </head>

  <body>
  <div id="banner" class="banner">
    <ul class="LOGO">
      <img src="https://t3.ftcdn.net/jpg/04/45/30/52/360_F_445305267_3K9H9hVzh1Ib8BRh0D8LuvVlfOb5muXa.jpg" alt="LOGO">
    </ul>
    <div id="accountMenu" class="accountMenu">
      <a href="index.php"><h2>Litteria Brevia</h2></a>
    </div>
    <div id = "mainHeader" class="mainHeader">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="createPost.php">Create Post</a></li>
        <li><a href="..\frontEnd\accountSettings.php">Account Settings</a></li>
        <li><a href="..\backEnd\signOut.php">Sign Out</a></li>
      </ul>
    </div>
  </div>


    <div id = "userInfo" class="userInfo">
      <?php 
        //called from processProfile.php
        profileDetails(); 
      ?>
    </div>

    <div id = "userPosts" class ="userPosts">
      <h2>Your posts</h2>
      <?php 
        //called from processProfile.php
        profilePosts($_SESSION['userID']); 
      ?>
    </div>


  </body>
    <script src="script.js"></script>

</html>