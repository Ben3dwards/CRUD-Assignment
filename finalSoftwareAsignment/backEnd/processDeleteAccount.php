<?php
include 'db.php';
include 'classes.php';
session_start();

//creates new user object
$user = new User($conn);

$deleteAccount = $user->deleteAccount($_SESSION['userID']);

    if ($deleteAccount === true){
        session_destroy();
        header("Location: ../frontEnd\signIn.php");
        exit;

    }else{
        //debugging if the method deleteAccount doesnt work
        echo "There is an issue!";
        echo $_SESSION['userID'];
        echo $deleteAccount;
    }

$conn->close();

?>