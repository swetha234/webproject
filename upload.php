<?php
session_start();
$connection=mysqli_connect("localhost","admin","monarchs","pet_finder") or die("Connection Failed");
  global $connection;


 if($_FILES["file"]["name"] != ''){

    $user_id = $_SESSION['users_id'];
  	$test = explode(".", $_FILES["file"]["name"]);
    $actual =$_FILES["file"]["name"];
  	$extension =end($test);
     
    $name = "<a href=user/user_images/$actual>".$actual."</a>";
    
    $location = './user/user_images/'.$actual;
    move_uploaded_file($_FILES["file"]["tmp_name"], $location);
      $insert = "INSERT INTO posts (users_id,topic_id,post_content,post_date,global)VALUES ('$user_id','1','$name',NOW(),'1')";
      $run = mysqli_query($connection,$insert);
     
     
     if($run)
     {
         echo"success";
     }
     else{
         
         echo"fail";
     }
 }
