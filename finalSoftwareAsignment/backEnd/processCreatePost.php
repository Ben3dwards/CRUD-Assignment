<?php
include 'db.php';
include 'classes.php';
session_start();

$post = new Posts($conn);

if (isset($_POST['submit'])){
    $userID = $_SESSION['userID'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $time = date("Y-m-d H:i:s");

    if ($post->createPost($userID, $title, $content, $time)){
        //sucess: 
        header("Location: ../frontend/index.php");
        exit;
    }else{
        //error
        echo "There was an issue!";
    }

$conn->close();
}
?>