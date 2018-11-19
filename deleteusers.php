<?php 
	session_start();
	$connection=mysqli_connect("localhost","admin","monarchs","pet_finder") or die("Connection Failed");

   global $connection;  
if(isset($_GET['del'])){ 
    
      $members_user_id =  $_GET['del'];
      $del= "DELETE from user_group where users_id ='$members_user_id' ";
      $result =  mysqli_query($connection,$del);
      echo "success";

     
   }



?>
    