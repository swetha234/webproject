<?php
session_start();
require("connection.php");
global $connection;
if (isset($_POST['msg'])) {


  $data = $_POST['msg'];
  $users_id = $_SESSION['users_id'];
  $chat_userid = $data['chat_userid'];
  $msg = htmlspecialchars(mysqli_real_escape_string($connection, $data['msg']));



  $query = "insert into chat (users_id,msg_content,msg_timestamp,msg_user_id) values ('$users_id','$msg',NOW(),'$chat_userid$users_id')";


  $run_query = mysqli_query($connection, $query);

  echo "success";
}