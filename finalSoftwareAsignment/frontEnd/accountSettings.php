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

    
    <section id="editProfile">
        <div id = "editProfile" class="editProfile">
            <h2>Edit Profile</h2>
            <form id="profileForm" action="..\backEnd\updateProfile.php" method="post"><br>
            <label for="username">Change user name:</label><br>
            <input type="text" id="username" name="username" required><br><br>

            <!--<label for="picture">Upload Picture:</label>
            <input type="file" id="picture" name="picture"><br> --> <!--We cant store pictures in the database right now -->

            <label for="bio">Edit Bio:</label><br>
            <textarea id="bio" name="bio"></textarea><br><br>

            <input id ="EditBio_button" class ="EditBio_button" type="submit" value="Save Changes" name="submit"><br>
            <br>
            </form>
        </div>

        <div id="changePassword" class="changePassword">
          <form id="updatePassword" action="../backEnd/processUpdatePassword.php" method="post">
            <label for="password">New password: </label><br>
            <input type="password" id="password" name="password"><br><br>

            <input id ="changePassword_button" class ="changePassword_button" type="submit" value="Save Changes" name = "submit"><br>
            <?php
            //inform user that there password has or hasnt changed
            if (isset($_SESSION['passwordChanged'])){
                $passwordChange = $_SESSION['passwordChanged'];
                echo "<p>$passwordChange</p>";
                unset($_SESSION['passwordChanged']); //unset the session
              }
            ?>
          </form>
        </div>
    </section>


    <div id="deleteAccount" class ="deleteAccount">
      <br><h3>Delete Account</h3><br>
      <a id="deleteAccount_button" class="deleteAccount_button" href="..\backEnd\processDeleteAccount.php"><button>Delete Account</button></a>
    </div>

  </body>
    <script src="script.js"></script>

</html>