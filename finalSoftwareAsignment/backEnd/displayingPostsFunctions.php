<?php
///This is used just so the index and profile pages dont have loads of php inside of it.
include 'db.php';
include 'classes.php';

function homepagePosts(){
    //global variable so the connection to the database is available
    global $conn;

    $posts = new Posts($conn);
    $allPosts = $posts->displayPosts();

    //loops out every single post
    if (count($allPosts) > 0){
        foreach ($allPosts as $post){
            echo "<h2>{$post['title']}</h2>";
            echo "<p>By: {$post['username']}</p>";
            echo "<p>{$post['content']}</p>";
            echo "<p>{$post['timePosted']}</p>";
            echo "<br>";
            echo "<h4>Comments</h4>";
            $posts->displayComments($post['postID']);
            addComment($post['postID']);
        }
    }else{
        echo "<h2> Looks like your feed is empty! </h2>";
    }
}



function addComment($postID){
    //Add comments
    echo "<form id='addcomment' class ='addcomment' action='..\backEnd\processComment.php' method='post'>";
    echo "<input id='addcomment' class ='addcomment' type='hidden' name='postID' value='{$postID}'>";
    echo "<textarea id='addcomment_textbox' class ='addcomment_textbox' name='comment' placeholder='Add a comment' required></textarea><br>";
    echo "<button id='addcomment_button' class ='addcomment_button' type='submit' name='submit'>Add Comment</button>";
    echo "</form>";
}
?>
