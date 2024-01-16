<?php
include 'db.php';
include 'classes.php';


//This function is called in profile.php
function profileDetails(){
    global $conn;
    $user = new User($conn);

    if (isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];
        $userDetails = $user->userInformation($userID);

        if ($userDetails) {
            // Display the retrieved user details on the profile page
            echo "<p>Username: {$userDetails['username']}</p>";
            echo "<br>";
            echo "<p>Bio: {$userDetails['bio']}</p>";
        } else {
            // Handle the case where user details couldn't be retrieved
            echo "Error retrieving user details.";
        }
    } else {
        // User is not logged in, handle accordingly
        echo "User not logged in.";
    }
}   


//This function is called in profile.php
function profilePosts($userID){
    global $conn;
    $posts = new Posts($conn);

    $allPosts = $posts->profilePosts($userID);
    //Echos every single result that was taken from the above method 
    if(count($allPosts) > 0){
        foreach($allPosts as $post){
            echo "<h3>{$post['title']}</h3>";
            echo "<p>By: {$post['username']}</p>";
            echo "<p>{$post['content']}</p>";
            echo "<p>{$post['timePosted']}</p>";
            echo "<br>";
            echo "<form method='post' action='..\backEnd\deletePost.php'>";
            echo "<input type='hidden' name='postID' value='{$post['postID']}'>";
            echo "<button type='submit' name='submit'>Delete Post</button>";
            echo "</form>";
        }
    }else{
        echo "<h2> Looks like your feed is empty! </h2>";
    } 
}
?>