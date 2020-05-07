<?php
session_start();
require("connection.php");

global $connection;
global $connection;
global $connection;
if (isset($_POST['del'])) {

   $post_id =  $_POST['del'];
   $del = "DELETE from posts where post_id ='$post_id' ";
   $result =  mysqli_query($connection, $del);
   echo "success";
}
