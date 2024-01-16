<?php
include 'db.php';
include 'classes.php';
session_start();

$post = new Posts($conn);

if (isset($_POST['submit'])){
    $userID = $_SESSION['userID'];
    $postID = $_POST['postID'];
    $comment = $_POST['comment'];
    $time = date("Y-m-d H:i:s");

    //passes the variables through the addComment method
    if ($post->addComment($userID, $postID, $comment, $time)){
        header("Location: ../frontEnd\index.php");
        exit;

    }else{
        echo "There is an issue!";
    }

$conn->close();
}
?>