<?php 
include 'db.php';
include 'classes.php';
session_start();

$user = new User($conn);
$userID = $_SESSION['userID'];

if (isset($_POST['submit'])){
    $password = $_POST['password'];


    if ($user->updatePassword($userID, $password)){
        header("Location: ../frontEnd\accountSettings.php");
        $_SESSION['passwordChanged'] = "Your password has updated!";
        exit;

    }else{
        //Session to tell the user if there was an issue when trying to update the post
 
        $_SESSION['passwordChanged'] = "Please try again, we encounted an issue."; 
        header("Location: ../frontEnd/accountSettings.php");
        exit;
    }

$conn->close();
}
?>