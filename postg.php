
<?php 
	session_start();
	$connection=mysqli_connect("localhost","admin","monarchs","pet_finder") or die("Connection Failed");

   global $connection; 
 
   $user = $_SESSION['email'];
   $get_user = "select * from users where email = '$user'";
   $run_user = mysqli_query($connection,$get_user);
   $row=mysqli_fetch_array($run_user);
   $users_id_global = $row['users_id'];
    $user_image = $row['user_image'];
   
   $title = htmlspecialchars(addslashes($_POST['title']));
  
   
   $content = htmlspecialchars(addslashes($_POST['summernote']));

  

   $topic = $_POST['topic'];
   $output ='';
// 
//$topic_is_global = "select global from posts where topic"




//to insert data 
   $insert = "insert into posts(users_id,topic_id,post_title,post_content,post_date,global) values ('$users_id_global','$topic','$title','$content',NOW(),'1')";

$run_insert = mysqli_query($connection,$insert);
  
            
 


//to get topic title
$get_topictitle = "select topic_title from topics where topic_id ='$topic'";
$run_get_topictitle = mysqli_query($connection,$get_topictitle);
$row_result= mysqli_fetch_array($run_get_topictitle);
$topic_title = $row_result['topic_title'];

//to get all other user data 
$user_posts= "select * from posts INNER JOIN users where global is not NULL and users.users_id = posts.users_id order by post_id DESC LIMIT 1";
 $run_user_posts = mysqli_query($connection,$user_posts);
//$row_groups = mysqli_fetch_array($run_user_posts,MYSQLI_ASSOC);
    

if($run_user_posts->num_rows>0)
{
$postresult= mysqli_fetch_array($run_user_posts);
        
$post_id = $postresult['post_id'];
$last_name = $postresult['last_name'];
$post_date = $postresult['post_date'];
        
        
        
    
$output = "<div id='posts'> 
<p> <img src='user/user_images/".$user_image."' width='50', height='50' ></p><h3>Group Name : <a href='group_profile.php?topic_id=".$topic."'>".$topic_title."</a></h3>
<p>Username:  <a href='my_profile.php?topic_id=".$users_id_global."'>".$last_name."</a></p>
<p>Topic: ".$title."</p>
<p>Content : ".$content."</p>
<p>Posted Date: ".$post_date."</p>
<br> <i ";
    
if (userLiked($post_id,$users_id_global))
    {
        $output .="class='fa fa-thumbs-up like-btn' ";
    } 
else{
        $output .="class='fa fa-thumbs-o-up like-btn' ";
}
$output .="data-id ='".$post_id."' data-id1 = '".$users_id_global."'></i><span class ='likes'>".getLikes($post_id)."</span>&nbsp;&nbsp;&nbsp;&nbsp <i ";


if (userDisliked($post_id,$users_id_global))
    {
        $output .="class='fa fa-thumbs-down dislike-btn' ";
    } 
else{
        $output .="class='fa fa-thumbs-o-down dislike-btn' ";
}
$output .="data-id ='".$post_id."' data-id1 = '".$users_id_global."'></i><span class ='dislikes'>".getDisLikes($post_id)."</span>
<a href='single.php?post_id=".$post_id."' style='float:right;'><button> See Replies or Reply to this </button></a>";
    
    
    
    
    
//    
//<span class ='likes'>".getLikes($post_id)."</span>&nbsp;&nbsp;&nbsp;&nbsp <i class = 'fa fa-thumbs-o-down dislike-btn' data-id ='".$post_id."' data-id1 = '".$users_id_global."'></i>
//<span class='dislikes'>".getDislikes($post_id)."</span> 
//<a href='single.php?post_id=".$post_id."' style='float:right;'><button> See Replies or Reply to this </button></a>";      
      if ($users_id_global== 21){
                
                
            
                  $output .= "<i class='fa fa-trash delete' data-id='$post_id' style='font-size:24px; color:black; float:right;'> </i>";
                
        }
    
//$output = $output+new_output;
echo $output ;
    
}




// Get total number of likes for a particular post
function getLikes($post_id)
{
  global $connection;
  $sql = "SELECT COUNT(*) FROM rating 
  		  WHERE post_id = $post_id AND rating_action='like'";
  $rs = mysqli_query($connection, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}




// Get total number of dislikes for a particular post
function getDislikes($post_id)
{
  global $connection;
  $sql = "SELECT COUNT(*) FROM rating 
  		  WHERE post_id = $post_id AND rating_action='dislike'";
  $rs = mysqli_query($connection, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

// Get total number of likes and dislikes for a particular post
function getRating($post_id)
{
  global $connection;
  $rating = array();
  $likes_query = "SELECT COUNT(*) FROM rating WHERE post_id = $post_id AND rating_action='like'";
  $dislikes_query = "SELECT COUNT(*) FROM rating 
		  			WHERE post_id = $post_id AND rating_action='dislike'";
  $likes_rs = mysqli_query($connection, $likes_query);
  $dislikes_rs = mysqli_query($connection, $dislikes_query);
  $likes = mysqli_fetch_array($likes_rs);
  $dislikes = mysqli_fetch_array($dislikes_rs);
  $rating = [
  	'likes' => $likes[0],
  	'dislikes' => $dislikes[0]
  ];
  return json_encode($rating);
}



function userLiked($post_id, $users_id)
{
  global $connection;
  $sql = "SELECT * FROM rating WHERE users_id=$users_id 
  		  AND post_id=$post_id AND rating_action='like'";
    
  $result = mysqli_query($connection, $sql);
  if (mysqli_num_rows($result) > 0) {
  	return true;
  }else{
  	return false;
  }
}



// Check if user already dislikes post or not
function userDisliked($post_id, $users_id)
{
  global $connection;
  $sql = "SELECT * FROM rating WHERE users_id=$users_id 
  		  AND post_id=$post_id AND rating_action='dislike'";
  $result = mysqli_query($connection, $sql);
  if (mysqli_num_rows($result) > 0) {
  	return true;
  }else{
  	return false;
  }
}




?>