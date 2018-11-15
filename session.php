
<?php 


	//session_start();
	$connection=mysqli_connect("localhost","admin","monarchs","pet_finder") or die("Connection Failed");


        
        //function for getting topics
        function getTopics(){
        global $connection;
        $get_topics = "select * from topics";
        $run_topics = mysqli_query($connection,$get_topics);
                    
        while($row=mysqli_fetch_array($run_topics)){
                        
        $topic_id=$row['topic_id'];
        $topic_title = $row['topic_title'];
                        
        echo "<li><option value='$topic_id'>$topic_title</a></li>";
            
         }
        }



// if user clicks like or dislike button
if (isset($_POST['action'])) {
  $post_id = $_POST['post_id'];
  $action = $_POST['action'];   
$users_id = $_POST['users_id'];
  switch ($action) {
  	case 'like':
         $sql="INSERT INTO rating (users_id, post_id, rating_action) 
         	   VALUES ($users_id, $post_id, 'like') 
         	   ON DUPLICATE KEY UPDATE rating_action='like'";
         break;
  	case 'dislike':
          $sql="INSERT INTO rating (users_id, post_id, rating_action) 
               VALUES ($users_id, $post_id, 'dislike') 
         	   ON DUPLICATE KEY UPDATE rating_action='dislike'";
         break;
  	case 'unlike':
	      $sql="DELETE FROM rating WHERE users_id=$users_id AND post_id=$post_id";
	      break;
  	case 'undislike':
      	  $sql="DELETE FROM rating WHERE users_id=$users_id AND post_id=$post_id";
      break;
  	default:
  		break;
  }

  // execute query to effect changes in the database ...
  mysqli_query($connection, $sql);
  echo getRating($post_id);
  exit(0);
}



function inserttopic($topic_id){
    if (isset($_POST['join'])){
        global $connection; 
        global $users_id;
        $insertintotopic = "INSERT INTO user_group(users_id, topic_id) VALUES ('$users_id','$topic_id')";
        $run_insertintotopic = mysqli_query($connection,$insertintotopic);
        
        echo "<h2>You have been joined!  </h2>"; 
    }
    
    
}




//function for inserting posts
function insertPost($global){
    
    if (isset($_POST['sub'])){
        global $connection; 
        global $users_id;
        $title = htmlspecialchars(addslashes($_POST['title']));
        $content = htmlspecialchars(addslashes($_POST['content']));
        $topic = $_POST['topic'];
        $insert = "insert into posts(users_id,topic_id,post_title,post_content,post_date,global) values ('$users_id','$topic','$title','$content',NOW(),$global)";
        
        #$run = mysqli_query($connection,$insert);
        #$row2=mysqli_fetch_array($run);
        if(mysqli_query($connection,$insert)){
            
            echo "<h3>posted to timeline</h3>";
        }
    }
}

//function get_posts(){
//    global $con;
//    $get_posts = "select * from posts ORDER by 1 DESC LIMIT";
//    $run_posts = mysqliquery ($connection ,  $get_posts);
//    while (row_posts = mysqli_fetch_array(run_posts)){
//        
//        $post_id = $row_posts['post_id'];
//         $users_id = $row_posts['user_id'];
//        $post_title= $row['post_title'];
//        $content = $row_posts['post_content'];
//        $post_date = $row_posts['post_date'];
//        
//        $user = "select * from users where users_id ='$users_id' AND posts= 'YES'";
//        $run_user=mysqli_query($connection,$user);
//        $row_user=mysqli_fetch_array($run_user);
//        $user_name = $row_user['user_name'];
//        $user_image=
//        
//    }
    
    
    
    

function get_globalposts(){
//    var_dump("im in get global posts function");
    global $connection;
    
    $per_page=5;
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }
    else{
        $page =1;
    }
//    var_dump("<br>")
//    var_dump($page);
    
    $start_from= ($page-1) * $per_page;
    $user = $_SESSION['email'];
//    var_dump($user);
    
    $get_posts="select users_id from users where email='$user' ";
    $run_posts = mysqli_query($connection,$get_posts);
    while($row_posts = mysqli_fetch_array($run_posts,MYSQLI_ASSOC) ){
    
       $users_id_global = $row_posts['users_id'];
//       var_dump($users_id_global);
       
        //getting the user who has posted the thread
        $user_posts= "select * from posts where global is not NULL order by post_date DESC LIMIT $start_from,$per_page ";
    
        $run_user= mysqli_query($connection,$user_posts);
        while($row_user=mysqli_fetch_array($run_user,MYSQLI_ASSOC)){
//            echo ("<br>");
//            echo ("<br>");
//            var_dump($row_user);
             $post_id = $row_user['post_id'];
            $users_id= $row_user['users_id'];
            $topic_id = $row_user['topic_id'];
            $post_title = $row_user['post_title'];
            $content= $row_user['post_content'];
            $post_date = $row_user['post_date'];
            //to get topic title
            $topic_title_query = "select topic_title from topics where topic_id='$topic_id'";
            $run_post_title = mysqli_query($connection,$topic_title_query);

                while($row_post_title=mysqli_fetch_array($run_post_title,MYSQLI_ASSOC)){
                    $topic_title = $row_post_title['topic_title'];
//                    echo ("<br>");
//                    var_dump($topic_title);
//                    echo ("<br>");
//                    var_dump($users_id);
        
                    $user_details = "select * from users where users_id='$users_id'";
                    $run_user_details = mysqli_query($connection,$user_details);
                    while($row_user_details=mysqli_fetch_array($run_user_details,MYSQLI_ASSOC)){ 

                        $last_name = $row_user_details['last_name'];
//                        echo ("<br>");
//                        var_dump($last_name);
                        $user_image =$row_user_details['user_image']; 

//                        echo ("<br>");
//                        var_dump($user_image);
        
        ?>
        
       <div id='posts'>
        <p> <img src='user/user_images/<?php echo $user_image; ?>' width='50', height='50' ></p>
 <h3>Group Name : <a href='group_profile.php?topic_id=$topic_id'><?php echo $topic_title; ?></a></h3>
        <p>Username: <a href='user_profile.php?topic_id=$users_id'><?php echo $last_name; ?></a></p>
        <p>Topic:<?php echo $post_title; ?></p>
        <p>Content :<?php echo $content; ?></p>
        <p>Posted Date:<?php echo $post_date; ?></p>
        <!-- if user likes post, style button differently -->
       <i <?php if (userLiked($post_id,$users_id_global)): ?>
       class='fa fa-thumbs-up like-btn'
      	  <?php else: ?>
      		  class='fa fa-thumbs-o-up like-btn'
      	  <?php endif ?>
      	  data-id='<?php echo $post_id; ?>'
          data-id1 = '<?php echo $users_id_global; ?>'></i>
            
          <span class='likes'><?php echo getLikes($post_id); ?></span>
      	
      	&nbsp;&nbsp;&nbsp;&nbsp;

	    <!-- if user dislikes post, style button differently -->
      	<i 
      	  <?php if (userDisliked($post_id, $users_id_global)): ?>
      		  class='fa fa-thumbs-down dislike-btn'
      	  <?php else: ?>
      		  class='fa fa-thumbs-o-down dislike-btn'
      	  <?php endif ?>
      	  data-id='<?php echo $post_id; ?>'
           data-id1 = '<?php echo $users_id_global; ?>'></i>
      	<span class='dislikes'><?php echo getDislikes($post_id); ?></span>
            <a href='single.php?post_id=<?php echo $post_id; ?>' style='float:right;'><button> See Replies or Reply to this</button></a>  
        
    <!-- for deleting -->
     <?php       
      if ($users_id_global== 21){
                
                
            
                  echo "<i class='fa fa-trash delete' data-id='$post_id' style='font-size:24px; color:black; float:right;'> </i>";
                
        }
                        
                        ?>
      	
</div><br>


       <?php
        
           
        
        }
        
    }
    
        }
}
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



function get_groups($users_id){
    #echo $users_id;
    global $connection;
//    $per_page=5;
//    if (isset($_GET['page'])) {
//        $page = $_GET['page'];
//    }
//    else{
//        $page =1;
//    }
//    $start_from= ($page-1) * $per_page;
   
    $get_groups="select topic_id from topics where choose='public' and topic_id not in (select topic_id from user_group where users_id = '$users_id')";
    $run_groups = mysqli_query($connection,$get_groups);
    
    while($row_groups = mysqli_fetch_array($run_groups) ){
    
        $topic_id = $row_groups['topic_id'];
        $get_topic_name="select topic_title from topics where topic_id = '$topic_id'";
        $run_get_topic_name =mysqli_query($connection,$get_topic_name);
        while($row_topic_name=mysqli_fetch_array($run_get_topic_name,MYSQLI_ASSOC) ){
    
        
        $topic_title = $row_topic_name['topic_title'];
            ?>
        <div id='groups'>
        <form action='join.php' method ='get'>
    
        <h3><a href='join.php?topic_id=<?php echo $topic_id; ?>&topic_title=<?php echo $topic_title; ?>'><?php echo $topic_title;  ?></a></h3>
              
<br>
            </form>
        </div> 

<?php
 
      }  
//        include("pagination.php");
 
       }
 }




 function insert_join(){  
     global $connection; 
    if (isset($_POST['join_submit'])){
        
        
        global $users_id;
        $insert_join = "insert into user_group(users_id,topic_id) values ('$users_id','$topic_id')";
        if(mysqli_query($connection,$insert_join)){
            
            echo "Success!";
        }
    
        }
     
     
                      }
function get_my_groups($users_id){
    #echo $users_id;
    global $connection;
//    $per_page=5;
//     $user = $_SESSION['email'];
//    if(isset($_GET['page'])) {
//        
//        $page = $_GET['page'];
//        }
//    else {
//        $page=1;
//    }
//    $start_from =($page-1) * $per_page;
    $get_groups="select topic_id from user_group where users_id = '$users_id'";
    $run_groups = mysqli_query($connection,$get_groups);
    
    while($row_groups = mysqli_fetch_array($run_groups,MYSQLI_ASSOC) ){
    
//        $topic_title = $row_groups['topic_title'];
        $topic_id = $row_groups['topic_id'];
        
        $get_topic_name="select topic_title from topics where topic_id = '$topic_id'";
        $run_get_topic_name =mysqli_query($connection,$get_topic_name);
        while($row_topic_name=mysqli_fetch_array($run_get_topic_name,MYSQLI_ASSOC) ){
    
        
        $topic_title = $row_topic_name['topic_title'];
        echo "<div id='groups'>
        
     
        <h3><a href='group_profile.php?topic_id=$topic_id'> $topic_title          </a>";
            if ($users_id== 21){
                
                if(archive($topic_id)== true){
                  
                    
            echo " <i class='fa fa-key arch' data-id='$topic_id' style='font-size:24px; color:black; float:right;'></i>";
                    
                }
                else{
                  echo "<i class='fa fa-lock arch' data-id='$topic_id' style='font-size:24px; color:black; float:right;'> </i>";
                }
        }
            
        echo "</h3></div></br>";
                
     
                        
        }
//        include("pagination.php");
        }
}
    

function get_user_posts(){
    global $connection;
//    $per_page=5;
//     $user = $_SESSION['email'];
//    if(isset($_GET['page'])) {
//        
//        $page = $_GET['page'];
//        }
//    else {
//        $page=1;
//    }
    $user = $_SESSION['email'];

    $get_posts="select users_id from users where email='$user'";
    $run_posts = mysqli_query($connection,$get_posts);
    while($row_posts = mysqli_fetch_array($run_posts,MYSQLI_ASSOC) ){
    
       $users_id = $row_posts['users_id'];
       
     //getting the user who has posted the thread
    $user= "select * from posts where users_id='$users_id' order by post_date DESC";
    
        $run_user= mysqli_query($connection,$user);
        while($row_user= mysqli_fetch_array($run_user,MYSQLI_ASSOC)){
         $post_id = $row_user['post_id'];
            $users_id=$row_user['users_id'];
        $topic_id = $row_user['topic_id'];
        $users_id = $row_user['users_id'];
        $post_title = $row_user['post_title'];
        $content= $row_user['post_content'];
        $post_date = $row_user['post_date'];
    
          $topic_title_query = "select topic_title from topics where topic_id='$topic_id'";
    $run_post_title = mysqli_query($connection,$topic_title_query);
            
    while($row_post_title=mysqli_fetch_array($run_post_title,MYSQLI_ASSOC)){ 
        
        $topic_title = $row_post_title['topic_title'];
        
        $user_details = "select last_name from users where users_id='$users_id'";
    $run_user_details = mysqli_query($connection,$user_details);
            
    while($row_user_details=mysqli_fetch_array($run_user_details,MYSQLI_ASSOC)){ 
        
        $last_name = $row_user_details['last_name'];
//         $user_image =$row_user_details['user_image']; 
        
        
        
    //now displaying all at once
        
        echo "<div id='posts'>
        <h3>Group Name : <a href='group_profile.php?topic_id=$topic_id'> $topic_title</a></h3>
        <p>Username: <a href='user_profile.php?topic_id=$users_id'> $last_name</a></p>
        <p>Topic: $post_title</p>
        <p>Content : $content</p>
        <p>Posted Date: $post_date</p>

           
        
        </div></br>
        ";
    }
        }
        }
    }
    
}
function get_group_name($topic_id){
     global $connection;
    $get_name= "select topic_title from topics where topic_id='$topic_id'"; 
     $run_posts = mysqli_query($connection,$get_name);
     while($row_posts = mysqli_fetch_array($run_posts,MYSQLI_ASSOC) ){
         
         $topic_title = $row_posts['topic_title'];
        return ($topic_title);
     }
    
    
}
function get_group_posts($topic_id,$users_id){
    global $connection;
   
    $per_page=5;
     $user = $_SESSION['email'];
    if(isset($_GET['page'])) {
        
        $page = $_GET['page'];
        }
    else {
        $page=1;
    }
    $start_from= ($page-1) * $per_page;
    $user = $_SESSION['email'];
   
    $get_posts="select users_id from users where email='$user'";
    $run_posts = mysqli_query($connection,$get_posts);
    while($row_posts = mysqli_fetch_array($run_posts,MYSQLI_ASSOC) ){
    
       $users_id = $row_posts['users_id'];
    
     //getting the user who has posted the thread
    $user= "select * from posts JOIN archive_info where posts.topic_id='$topic_id' and global is NULL and archive_info.topic_id = posts.topic_id order by posts.post_date DESC LIMIT $start_from,$per_page ";
    
        $run_user= mysqli_query($connection,$user);
        while($row_user= mysqli_fetch_array($run_user,MYSQLI_ASSOC)){
         $post_id = $row_user['post_id'];
        $topic_id = $row_user['topic_id'];
        $post_title = $row_user['post_title'];
        $content= $row_user['post_content'];
        $post_date = $row_user['post_date'];
        $archive_action = $row_user['archive_action'];
    
          $topic_title_query = "select topic_title from topics where topic_id='$topic_id'";
            
    $run_post_title = mysqli_query($connection,$topic_title_query);
            
    while($row_post_title=mysqli_fetch_array($run_post_title,MYSQLI_ASSOC)){ 
        
        $topic_title = $row_post_title['topic_title'];
        $user_details = "select * from users where users_id='$users_id'";
    $run_user_details = mysqli_query($connection,$user_details);
            
    while($row_user_details=mysqli_fetch_array($run_user_details,MYSQLI_ASSOC)){ 
        
        $last_name = $row_user_details['last_name'];
       
          $user_image =$row_user_details['user_image']; 
           
    }
    //now displaying all at once
        
         ?>
        
       <div id='posts'>
        <p> <img src='user/user_images/<?php echo $user_image; ?>' width='50', height='50' ></p>
 <h3>Group Name : <a href='group_profile.php?topic_id=$topic_id'><?php echo $topic_title; ?></a></h3>
        <p>Username: <a href='user_profile.php?topic_id=$users_id'><?php echo $last_name; ?></a></p>
        <p>Topic:<?php echo $post_title; ?></p>
        <p>Content :<?php echo $content; ?></p>
        <p>Posted Date:<?php echo $post_date; ?></p>
        <!-- if user likes post, style button differently -->
           
       <i <?php 
            if($archive_action == "unarchive"):
        
        if (userLiked($post_id,$users_id)): ?>
       class='fa fa-thumbs-up like-btn'
      	  <?php else: ?>
      		  class='fa fa-thumbs-o-up like-btn'
      	  <?php endif ?>
            <?php else: 
                if (userLiked($post_id, $users_id)): ?>
      		  class='fa fa-thumbs-up'
      	  <?php else: ?>
      		  class='fa fa-thumbs-o-up'
      	  <?php endif ?>
           
            
            <?php endif ?>
          
      	  data-id='<?php echo $post_id; ?>'
          data-id1 = '<?php echo $users_id; ?>'></i>
            
          <span class='likes'><?php echo getLikes($post_id); ?></span>
      	
      	&nbsp;&nbsp;&nbsp;&nbsp;

	    <!-- if user dislikes post, style button differently -->
      	<i 
      	  <?php
            if($archive_action == "unarchive"):
        
           if (userDisliked($post_id, $users_id)): ?>
      		  class='fa fa-thumbs-down dislike-btn'
      	  <?php else: ?>
      		  class='fa fa-thumbs-o-down dislike-btn'
      	  <?php endif ?>
           
             <?php else: 
                if (userDisliked($post_id, $users_id)): ?>
      		  class='fa fa-thumbs-down'
      	  <?php else: ?>
      		  class='fa fa-thumbs-o-down'
      	  <?php endif ?>
           
            
            <?php endif ?>
           
      	  data-id='<?php echo $post_id; ?>'
           data-id1 = '<?php echo $users_id; ?>'></i>
      	<span class='dislikes'><?php echo getDislikes($post_id); ?></span>
            <a href='single.php?post_id=<?php echo $post_id; ?>' style='float:right;'><button> See Replies or Reply to this</button></a>  
        
<?php
          if ($users_id== 21){
                
                
            
                  echo "<i class='fa fa-trash delete' data-id='$post_id' style='font-size:24px; color:black; float:right;'> </i>";
                
        }
        ?>
           </div><br>
                        

       <?php
    
    
        }
            
        }
    }
     
}

function single_post(){
    
    if(isset($_GET['post_id'])){
    global $connection; 
//        $per_page=5;
//    if (isset($_GET['page'])) {
//        $page = $_GET['page'];
//    }
//    else{
//        $page =1;
//    }
//    $start_from= ($page-1) * $per_page;
    $get_id=$_GET['post_id'];
    
     $get_posts="select * from posts where post_id='$get_id'";
    $run_posts = mysqli_query($connection,$get_posts);
    $row_posts = mysqli_fetch_array($run_posts);
    
      
             $post_id = $row_posts['post_id'];
            $users_id = $row_posts['users_id'];
            $post_title = $row_posts['post_title'];
            $content= $row_posts['post_content'];
            $post_date = $row_posts['post_date']; 
           
             
            
        $user = "select * from users where users_id='$users_id'";
    $run_user = mysqli_query($connection,$user);
        $row_user = mysqli_fetch_array($run_user);
   $last_name = $row_user['last_name'];
   $user_image =$row_user['user_image']; 
        
        $user_com = $_SESSION['email'];
		$get_com = "select * from users where email='$user_com'"; 
		$run_com = mysqli_query($connection,$get_com);
		$row_com=mysqli_fetch_array($run_com);
		$user_com_id = $row_com['users_id']; 
		$user_com_name = $row_com['last_name'];
        
       
        
    //now displaying all at once
        
        echo "<div id='posts'>
        <p> <img src='user/user_images/$user_image' width='50', height='50' ></p>
        <p>Username: <a href='user_profile.php?users_id=$users_id'> $last_name</a></p>
        <p>Topic: $post_title</p>
        <p>Content : $content</p>
        <p>Date: $post_date</p>
        </div></br>
        ";
       
        include("comment.php");
        echo "
        <form action='single.php?post_id=$post_id' method='post' id='reply'>
        <textarea cols='76' rows='5' name='comment' placeholder='Please type your comment here..'></textarea>
        </br></br></br></br></br></br>
        <input id = 'help' type='submit' name='reply' value='Reply to This'/></br>
        </form>
        ";
   
    if(isset($_POST['reply'])) {
        
        $comment =$_POST['comment'];
        $insert = "insert into comments (post_id,users_id,comment,comment_authur,date) values ('$post_id','$users_id','$comment','$user_com_name',NOW())";
        
        $run= mysqli_query($connection,$insert);
        
        echo "<h2>Your reply was added!</h2>"; 
        
        
    }
      
    }
    
}

function create_group($users_id){
     global $connection;
    if(isset($_POST['create'])){
        $topic_title = $_POST['u_groupname'];
        $choose = $_POST['choose'];
        $email = $_POST['u_invite'];
        
        #To insert data into topics table irrespective of user 
        $insert_group= "INSERT INTO topics (topic_title, choose) VALUES ('$topic_title','$choose') ";
        $run_insert_group=mysqli_query($connection,$insert_group);
        
        #get topic id from topics table using topic name because topic id is generated after above query is executed.
        $get_topic_id ="SELECT topic_id FROM topics WHERE topic_title ='$topic_title'";
        $run_get_topic_id = mysqli_query($connection,$get_topic_id);
        $row_topic_id = mysqli_fetch_array($run_get_topic_id);
        $topic_id = $row_topic_id['topic_id'];
        
        #get users_id from users table using the email given from the create.php page
        
        $get_users_id = "SELECT users_id FROM users WHERE email = '$email'";
        $run_get_users_id = mysqli_query($connection,$get_users_id);
        $row_users_id = mysqli_fetch_array($run_get_users_id);
        $new_users_id = $row_users_id['users_id'];
        
        
        #insert into user_group table to indicate who all users are associated with this new group.
        $insert_user_group="INSERT INTO user_group (users_id, topic_id) VALUES ('$users_id','$topic_id'),('$new_users_id','$topic_id')";
        $run_insert_user_group=mysqli_query($connection,$insert_user_group);
        
        
    
    
    if($run_insert_user_group){
                  echo "Group creation Successful";
            }
    
    }
        
    }



function get_search_results($users_id){
    #echo $users_id;
    global $connection;
     $user = $_SESSION['email'];
    if(isset($_POST['search'])){

    $topic_title = $_POST['user_query'];
    $get_groups="select topic_id from topics where choose='public' and topic_title ='$topic_title' and topic_id not in (select topic_id from user_group where users_id = '$users_id')";
    $run_groups = mysqli_query($connection,$get_groups);
    
    while($row_groups = mysqli_fetch_array($run_groups,MYSQLI_ASSOC) ){
    
        $topic_id = $row_groups['topic_id'];
        $get_topic_name="select topic_title from topics where topic_id = '$topic_id'";
        $run_get_topic_name =mysqli_query($connection,$get_topic_name);
        while($row_topic_name=mysqli_fetch_array($run_get_topic_name,MYSQLI_ASSOC) ){
    
        
        $topic_title = $row_topic_name['topic_title']; 
        ?>
        <div id='groups'>
        <form action='my_groups.php' method ='get'>
      <input type='checkbox' name='vehicle1' id='myCheck' value='<?php echo $topic_title ?> '>
        <h3><a href='group_profile.php?topic_id=<?php echo $topic_id; ?>'><?php echo $topic_title  ?></a></h3>
            
<br>
            </form>
        </div>
<?php

     echo "<button onclick='insert_join()'>Join</button>";
 

      }    
    
        }

      
}
        
}

function archive($topic_id)
{
    global $connection;
    $sql = "SELECT * FROM archive_info WHERE topic_id=$topic_id AND archive_action='archive'";
  $result = mysqli_query($connection,$sql);
   if (mysqli_num_rows($result) > 0) {
    return true;
  }
  else{
    return false;
  }
}

function delete($post_id)
{
     global $connection;
    $sql = "delete  FROM posts WHERE post_id=$post_id";
  $result = mysqli_query($connection,$sql);
   if (mysqli_num_rows($result) > 0) {
    return true;
  }
  else{
    return false;
  }
}
    








?>