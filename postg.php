<?php 
	session_start();
	$connection=mysqli_connect("localhost","admin","monarchs","pet_finder") or die("Connection Failed");

   global $connection; 
 
   $user = $_SESSION['email'];
   $get_user = "select * from users where email = '$user'";
   $run_user = mysqli_query($connection,$get_user);
   $row=mysqli_fetch_array($run_user);
   $users_id = $row['users_id'];
 
   
   $title = htmlspecialchars(addslashes($_POST['title']));
  
   
   $content = htmlspecialchars(addslashes($_POST['content']));

  

   $topic = $_POST['topic'];
 

   $insert = "insert into posts(users_id,topic_id,post_title,post_content,post_date,global) values ('$users_id','$topic','$title','$content',NOW(),'1')";
 



//$user_posts= "select * from posts where global is not NULL and post_date= NOW() order by DESC LIMIT";
// $run_user_posts = mysqli_query($connection,$user_posts);
//while($postresult= mysqli_fetch_array($run_user_posts)){
//    
//    $result['message'][]= $postresult;
//    
//    
//}
//
//echo json_encode($result);




if(mysqli_query($connection,$insert)){

        echo "<h3>posted to timeline</h3>";
    }

?>