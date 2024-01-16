<?php 
include "db.php";
include "classes.php";

$post = new Posts($conn);


//process the deletion of the post
if (isset($_POST['submit'])){
    $postID = $_POST['postID'];


    if ($post->deletePost($postID)){
        header("Location: ../frontEnd\profile.php");
        exit;

    }else{
        echo "There is an issue!";
    }

$conn->close();
}
    
?>