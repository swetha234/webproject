<?php
session_start();
include "session.php";
    $connection=mysqli_connect("localhost","admin","monarchs","pet_finder") or die("Connection Failed");

$post_id = $_POST['post_id'];
            $users_id= $_POST['users_id'];
            $topic_id = $_POST['topic_id'];
            $post_title = $_POST['post_title'];
            $content= $_POST['post_content'];
            $post_date = $_POST['post_date'];

 $insert = "insert into posts(users_id,topic_id,post_title,post_content,post_date,global) values ('$users_id','$topic','$title','$content',NOW(),$global)";
 if(mysqli_query($connection,$insert)){
            
            echo "<h3>posted to timeline</h3>";
        }
?>