<?php

//Class for all user interactions
class User{
    private $conn;

    //The contructor connects to database as all methods are passed to the sql database
    public function __construct($conn){
        $this->conn = $conn;
    }

    //method to add a new account 
    public function addUser($userName, $name, $email, $password, $bio){
        //check if the email exists.
        if ($this->checkEmail($email)){
            return false;
        }
        //check if the username exists
        if ($this->checkUsername($userName)){
            return false;
        }

        //hash the password by chatgpt
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        //add to the database

        $sql = "INSERT INTO  tbl_users(username, name, email, password, bio) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssss', $userName, $name, $email, $hashedPassword, $bio);

        if ($stmt->execute()){
            return true;
        }else{
            echo "error: " . $stmt->error; //debugging
            return false;
        }

    }

    //Method to Log in
    public function logIn($email, $password){

        //prepairing the sql statement
        $sql = "SELECT userID, username, password FROM tbl_users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);

        //checks if $stmt exists, used for debugging and pottential errors. Could be removed later....
        if ($stmt){
            $stmt->bind_param("s", $email);

            if($stmt->execute()){
                $stmt->bind_result($userID, $username, $hashedPassword);

                if ($stmt->fetch()){
                    //chatGPT hashing fix
                    if (password_verify($password, $hashedPassword)){
                    return [
                        "userID" => $userID,
                        "username" => $username
                    ];
                }else{
                    return false; //incorrect password
                }
            }else{
                return false; //user not found
            }
        }else{
            return false; //execution failed
        }
    }else{
        return false; //statement prep failed
    }
}

    //Method to delete account
    public function deleteAccount($userID){
        //mass delete due to foreign key constraints. Will perminantly delete everything to do with this user.

        //delete all blog posts
        $sqlBlogPosts = "DELETE FROM tbl_blogPosts WHERE userID = ?";
        $stmtBlogPosts = $this->conn->prepare($sqlBlogPosts);
        $stmtBlogPosts->bind_param('i', $userID);
        $stmtBlogPosts->execute();

        //delete all comments
        $sqlComments = "DELETE FROM tbl_comments WHERE userID = ?";
        $stmtComments = $this->conn->prepare($sqlComments);
        $stmtComments->bind_param('i', $userID);
        $stmtComments->execute();

        //delete all reactions
        $sqlReactions = "DELETE FROM tbl_reaction WHERE userID = ?";
        $stmtReactions = $this->conn->prepare($sqlReactions);
        $stmtReactions->bind_param('i', $userID);
        $stmtReactions->execute();

        //delete User from table
        $sqlUser = "DELETE FROM tbl_users WHERE userID = ?";
        $stmtUser = $this->conn->prepare($sqlUser);
        $stmtUser->bind_param('i', $userID);

        if($stmtUser->execute()){
            return true;
        }else{
            return false; //error
        }
    }

    //Method to update account
    public function editAccount($userID, $newUsername, $newBio){
        $sql = "UPDATE tbl_users SET username = ?, bio = ? WHERE userID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssi', $newUsername, $newBio, $userID);

        if ($stmt->execute()){
            //Somthing to alert the user this has worked
            return true;
        }else{
            //issue one why it didnt work
            return false;
        }


    }

    //method to update password
    public function updatePassword($userID, $password){
        //hash the password by chatgpt
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        //update the database
        $sql = "UPDATE tbl_users SET password = ? WHERE userID = ?"; 
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si',$hashedPassword,$userID);

        if ($stmt->execute()){
            return true;
        }else{
            echo "error: " . $stmt->error; //debugging
            return false;
        }

    }

    //method to check if an email already exists
    public function checkEmail($email){
        $sql = "SELECT * FROM tbl_users WHERE email = ?"; //line of sql
        $stmt = $this->conn->prepare($sql); //Prepares the execution of the sql statement

        //executes the sql statement
        if($stmt){
            $stmt->bind_param("s", $email);
                    
            if ($stmt->execute()){
                $result = $stmt->get_result();

                if ($result->num_rows > 0){
                    return true; //Needs to have a way of telling the user that this email already exists 
                }else{
                    return false;
                }
            }

        }
    }

    //method to check if a username already exists
    public function checkUsername($userName){
        $sql = "SELECT * FROM tbl_users WHERE username = ?"; //line of sql
        $stmt = $this->conn->prepare($sql); //Prepares the execution of the sql statement

        //executes the sql statement
        if($stmt){
            $stmt->bind_param("s", $userName);
                    
            if ($stmt->execute()){
                $result = $stmt->get_result();

                if ($result->num_rows > 0){
                    return true; //Needs to have a way of telling the user that this email already exists (I would assume js would be used)
                }else{
                    return false;
                }
            }

        }
    }

    //method to retrieve user information
    public function userInformation($userID){
        $sql = "SELECT username, name, bio FROM tbl_users WHERE userID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $userID);

        if ($stmt->execute()){
            $stmt->bind_result($username, $name, $bio);

            if ($stmt->fetch()){
                $userDetails = array (
                    "username"=>$username,
                    "name"=>$name,
                    "bio"=>$bio
                );
                return $userDetails;
            }else{
                return $userDetails;
            }
        }else{
            //error
            return false;
        }

    }



}

class Posts{
    private $conn;

    //The contructor connects to database as all methods are passed to the sql database
    public function __construct($conn){
        $this->conn = $conn;
    }

    //method to create posts
    public function createPost($userID, $title, $content, $timePosted){
        $sql = "INSERT INTO tbl_blogposts (userID, title, content, timePosted) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('isss', $userID, $title, $content, $timePosted);

        if ($stmt->execute()){
            echo "SQL Query: " . $sql;
            return true;
        }else{
            echo "SQL Query doesn't work" . $sql; // echo sql query debugging
            return false;
        }
    }
    //method to delete posts and its comments
    public function deletePost($postID){
        //delete all the comments first
        $sqlDeleteComments = "DELETE FROM tbl_comments WHERE postID = ?";
        $stmtDeleteComments = $this->conn->prepare($sqlDeleteComments);
        $stmtDeleteComments->bind_param('i', $postID);
        $stmtDeleteComments->execute();

        //delete posts
        $sqlDeletePost = "DELETE FROM tbl_blogPosts WHERE postID = ?";
        $stmtDeletePost = $this->conn->prepare($sqlDeletePost);
        $stmtDeletePost->bind_param('i', $postID);

        //execute SQL statement
        if ($stmtDeletePost->execute()){
            return true;
        }else{
            return false;
        }
    }
    
    //method to edit posts

    //method to delete comments
    public function deleteComment($commentID){
        $sql = "DELETE FROM tbl_comments WHERE commentID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $commentID);

        if ($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    //method to display posts on home screen
    public function displayPosts(){
        //sql statement. Joins the tbl_users onto tbl_blogposts
        $sql = "SELECT tbl_blogposts.postID, tbl_blogposts.userID, tbl_blogposts.title, tbl_blogposts.content, tbl_blogposts.timePosted, tbl_users.username
        FROM tbl_blogposts
        INNER JOIN tbl_users ON tbl_blogposts.userID = tbl_users.userID
        ORDER BY tbl_blogposts.timePosted DESC;";
        $stmt = $this->conn->prepare($sql);

        if ($stmt){
            $stmt->execute();
            $result = $stmt->get_result();
            $posts = $result->fetch_all(MYSQLI_ASSOC);
            return $posts;
        }else{
            return arrary(); //return an empty array if theres an error
        }
    }

    //method to display users personal posts
    public function profilePosts($userID){
        //sql statement joins tbl_users onto tbl_blogposts and then retrieves only the data with the userID
        $sql = "SELECT tbl_blogposts.postID, tbl_blogposts.userID, tbl_blogposts.title, tbl_blogposts.content, tbl_blogposts.timePosted, tbl_users.username
        FROM tbl_blogposts
        INNER JOIN tbl_users ON tbl_blogposts.userID = tbl_users.userID
        WHERE tbl_blogposts.userID = ?
        ORDER BY tbl_blogposts.timePosted DESC;";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('i', $userID);
            $stmt->execute();
            $result = $stmt->get_result();
            $posts = $result->fetch_all(MYSQLI_ASSOC);
            return $posts;
        } else {
            return array(); // Return an empty array if there's an error
        }
    }
    

    //method to display comments to corresponding post
    public function displayComments($postID){
        //SQL joins tbl_users onto tbl_comments and retrieves the data from the userID
        $sql = "SELECT tbl_comments.commentID, tbl_comments.commentText, tbl_comments.timePosted, tbl_users.username
        FROM tbl_comments
        INNER JOIN tbl_users ON tbl_comments.userID = tbl_users.userID
        WHERE tbl_comments.postID = ?
        ORDER BY tbl_comments.timePosted DESC";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('i', $postID);
            $stmt->execute();
            $result = $stmt->get_result();
            $comments = $result->fetch_all(MYSQLI_ASSOC);

            //Loop to iterate through every single comment
            if(count($comments) > 0){
                foreach($comments as $comment){
                    echo "<p><b>{$comment['username']}:</b> {$comment['commentText']}</p>";
                }
            } else {
                echo "<p>Be the first to comment!</p>";
            }
        } else {
            return array(); // Return an empty array if there's an error
        }
}

    //method to comment on posts
    //very similar to create post, just changed where its stored
    public function addComment($userID, $postID, $content, $timePosted){
        $sql = "INSERT INTO tbl_comments (userID, postID, commentText, timePosted) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('iiss', $userID, $postID, $content, $timePosted);

        if ($stmt->execute()) {
            echo "SQL Query: " . $sql; //echo the SQL query
            return true;
        } else {
            echo "SQL Query does not work: " . $sql; //echo the SQL query
            echo "Error: " . $stmt->error;
            return false;
        }
    }

    //method to edit comment
    
    //method to react to a post
    public function reactPost($postID){
        
    }
}

?>