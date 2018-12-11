<?php
     session_start();
   $per_page=5;
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }
    else{
        $page =1;
    }

    
    $start_from= ($page-1) * $per_page; $connection=mysqli_connect("localhost","admin","monarchs","pet_finder") or die("Connection Failed");

     $user_posts= "select users.user_image,users.dp_value, users.last_name,users.users_id,topics.topic_title,posts.topic_id,posts.post_id,posts.post_title,posts.post_content from posts,topics,users where posts.topic_id = topics.topic_id and posts.users_id = users.users_id and global is not NULL order by post_date DESC LIMIT $start_from,$per_page
     ";
    $result = mysqli_query($connection,$user_posts);
    $posts = [];  

  
    while($row_result=mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $row_result['post_content'] = htmlspecialchars_decode($row_result['post_content']);
        $posts[] = $row_result;
    }
        
    echo json_encode(
        array('result' => $result, 'session' => $_SESSION, 'posts' => $posts)
    );
?>