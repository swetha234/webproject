<?php
session_start();
$connection = mysqli_connect("localhost", "admin", "monarchs", "pet_finder") or die("Connection Failed");

global $connection;
global $connection;
global $connection;
if (isset($_POST['del'])) {

   $post_id =  $_POST['del'];
   $del = "DELETE from posts where post_id ='$post_id' ";
   $result =  mysqli_query($connection, $del);
   echo "success";
}
