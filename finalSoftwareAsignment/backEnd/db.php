<?php 
//connect to database 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_lb"; //exact name of database

//create connection
$conn = new mysqli($servername, $username,$password,$dbname);

//check connection
if ($conn->connect_error){
    die("Connection Failed: " . $conn->connect_error);
}

?>

