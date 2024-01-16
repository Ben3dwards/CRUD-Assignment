<?php 
include 'db.php';
include 'classes.php';

$user = new User($conn);
session_start();

//Post data all from the form inside on signIn.php
if (isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $loggedInUser = $user->logIn($email, $password);

 
    if ($loggedInUser){
        $_SESSION['user_email'] = $email;
        $_SESSION['userID'] = $loggedInUser['userID'];
        $_SESSION['username'] = $loggedInUser['username'];
        header("Location: ../frontEnd\index.php");
        exit;

    }else{
        //Checks if the return value is false from classes.php
        $_SESSION['loginError'] = "Incorrect email or password";
        header("Location: ../frontEnd/signIn.php");
        exit;
    }

$conn->close();
}