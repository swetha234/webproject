<?php
session_start();
require("connection.php");

global $connection;
if (isset($_GET['action'])) {

  $topic_id = $_GET['topic_id'];

  $action = $_GET['action'];
  switch ($action) {


    case 'archive':
      $sql = "update archive_info set archive_action='archive' WHERE topic_id = $topic_id";
      mysqli_query($connection, $sql);
      echo "success";
      break;

    case 'unarchive':
      $sql = "update archive_info set archive_action='unarchive' WHERE topic_id = $topic_id";
      mysqli_query($connection, $sql);
      break;

    default:
      break;
  }


  exit(0);
}