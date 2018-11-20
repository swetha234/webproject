<?php 
  session_start();
  $connection=mysqli_connect("localhost","admin","monarchs","pet_finder") or die("Connection Failed");
  global $connection;

  insertPost($connection, $_POST['topic_id'], $_POST['title'], $_POST['content']);

  function insertPost($connection, $topic_id, $post_title, $post_content) {

    /**
     * TODO store user id in sesssion ra so that I can use $_SESSION['user_id']
     */

    $post_title = htmlspecialchars(addslashes($post_title)); 
    $post_content = htmlspecialchars(addslashes($post_content));
    $users_id = $_SESSION["users_id"];  

    $insert = "insert into posts(users_id,topic_id,post_title,post_content,post_date,global) values ('$users_id','$topic_id','$post_title','$post_content',NOW(),NULL)";
      
    $result = mysqli_query($connection,$insert);
    echo json_encode(
        array('result' => $result, 'session' => $_SESSION, 'id' => mysqli_insert_id($connection))
    );
  }
?>