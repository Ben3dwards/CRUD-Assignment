<?php 
include 'db.php';
include 'classes.php';
session_start();

$user = new User($conn);

if (isset($_POST['submit'])){
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $bio = $_POST['bio'];


    if ($user->addUser($username, $name, $email, $password, $bio)){
        header("Location: ../frontEnd\signIn.php");
        exit;

    }else{
        //Session to tell the user that the email or username is in use  
        $_SESSION['inUseError'] = "Username or email already taken";
        header("Location: ../frontEnd/signUp.php");
        exit;
    }

$conn->close();
}
?>