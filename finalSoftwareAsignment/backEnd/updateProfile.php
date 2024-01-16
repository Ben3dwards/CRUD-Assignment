<?php 
include 'db.php';
include 'classes.php';
session_start();

$user = new User($conn);

if (isset($_POST['submit'])){
    $username = $_POST['username'];
    $bio = $_POST['bio'];


    if ($user->editAccount($_SESSION['userID'], $username, $bio)){
        header("Location: ../frontEnd\profile.php");
        exit;

    }else{
        //debugging, if this happens there is an issue with the if $user->editaccount
        echo "There is an issue!";
    }

$conn->close();
}
?>