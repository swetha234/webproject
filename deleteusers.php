<?php
session_start();
require("connection.php");

global $connection;
$users_id = $_POST['users_id'];
$topic_id = $_POST['topic_id'];
$del = "DELETE from user_group where users_id ='$users_id' and topic_id = '$topic_id'";
$result =  mysqli_query($connection, $del);
echo "success";