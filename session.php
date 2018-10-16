<!--Code to connect to database-->
<?php 
	//session_start();
	$connection =mysqli_connect("localhost","admin","monarchs","pet_finder") or die("Connection Failed");
        
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
//function for inserting posts
function insertPost(){
    
    if (isset($_POST['sub'])){
        global $connection; 
        global $users_id;
        $title = addslashes($_POST['title']);
        $content = addslashes($_POST['content']);
        $topic = $_POST['topic'];
        $insert = "insert into posts(users_id,topic_id,post_title,post_content,post_date) values ('$users_id','$topic','$title','$content',NOW())";
        
        #$run = mysqli_query($connection,$insert);
        #$row2=mysqli_fetch_array($run);

        if(mysqli_query($connection,$insert)){
            
            echo "<h3>posted to timeline</h3>";
        }
    }
}






function get_globalposts(){
    global $connection;
    $per_page=10;
     $user = $_SESSION['email'];
    if(isset($_GET['page'])) {
        
        $page = $_GET['page'];
        }
    else {
        $page=1;
    }
    $user = $_SESSION['email'];
    $start_from =($page-1) * $per_page;
    $get_posts="select users_id from users where email='$user'";
    $run_posts = mysqli_query($connection,$get_posts);
    while($row_posts = mysqli_fetch_array($run_posts,MYSQLI_ASSOC) ){
    
       $users_id = $row_posts['users_id'];
       
     //getting the user who has posted the thread
    $user= "select * from posts order by post_date DESC";
    
        $run_user= mysqli_query($connection,$user);
        while($row_user= mysqli_fetch_array($run_user,MYSQLI_ASSOC)){
         $post_id = $row_user['post_id'];
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
        
        
    //now displaying all at once
        
        echo "<div id='posts'>
        <h3>Group Name : <a href='group_profile.php?topic_id=$topic_id'> $topic_title</a></h3>
        <p>Username: <a href='user_profile.php?topic_id=$users_id'> $last_name</a></p>
        <p>Topic: $post_title</p>
        <p>Content : $content</p>
        <p>Posted Date: $post_date</p>
            <a href='single.php? post_id=$post_id' style='float:right;'><button> See Replies or Reply to this</button></a>
        
        </div></br>
        ";
    }
        }
        }
    }
    include("pagenation.php");
}



function get_groups($users_id){
    #echo $users_id;
    global $connection;
    $per_page=5;
     $user = $_SESSION['email'];
    if(isset($_GET['page'])) {
        
        $page = $_GET['page'];
        }
    else {
        $page=1;
    }
    $start_from =($page-1) * $per_page;
    $get_groups="select topic_id from topics where topic_id not in (select topic_id from user_group where users_id = '$users_id')";
    $run_groups = mysqli_query($connection,$get_groups);
    
    while($row_groups = mysqli_fetch_array($run_groups,MYSQLI_ASSOC) ){
    
        $topic_id = $row_groups['topic_id'];
        $get_topic_name="select topic_title from topics where topic_id = '$topic_id'";
        $run_get_topic_name =mysqli_query($connection,$get_topic_name);
        while($row_topic_name=mysqli_fetch_array($run_get_topic_name,MYSQLI_ASSOC) ){
    
        
        $topic_title = $row_topic_name['topic_title']; 
        ?>
        <div id='groups'>
        <form action="my_groups.php" method ="get">
      <input type="checkbox" name="vehicle1" id="myCheck" value="<?php echo $topic_title ?> ">
        <h3><a href='group_profile.php?topic_id=$topic_id'><?php echo $topic_title  ?></a></h3>
            
<br>
            </form>
        </div> 
            
<?php 
      }    
   
    
        }
            echo "<button onclick='insert_join()'>Join</button>";
        
          
}
function insert_join(){   
    if (isset($_POST['join_submit'])){
        global $connection; 
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
    $per_page=5;
     $user = $_SESSION['email'];
    if(isset($_GET['page'])) {
        
        $page = $_GET['page'];
        }
    else {
        $page=1;
    }
    $start_from =($page-1) * $per_page;
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
        
     
        <h3><a href='group_profile.php?topic_id=$topic_id'> $topic_title</a></h3>
        
        </div></br>
        ";
        }
        }

    
}






function get_user_posts(){
    global $connection;
    $per_page=5;
     $user = $_SESSION['email'];
    if(isset($_GET['page'])) {
        
        $page = $_GET['page'];
        }
    else {
        $page=1;
    }
    $user = $_SESSION['email'];
    $start_from =($page-1) * $per_page;
    $get_posts="select users_id from users where email='$user'";
    $run_posts = mysqli_query($connection,$get_posts);
    while($row_posts = mysqli_fetch_array($run_posts,MYSQLI_ASSOC) ){
    
       $users_id = $row_posts['users_id'];
       
     //getting the user who has posted the thread
    $user= "select * from posts where users_id='$users_id' order by post_date DESC";
    
        $run_user= mysqli_query($connection,$user);
        while($row_user= mysqli_fetch_array($run_user,MYSQLI_ASSOC)){
         $post_id = $row_user['post_id'];
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
        
        
    //now displaying all at once
        
        echo "<div id='posts'>
        <h3>Group Name : <a href='group_profile.php?topic_id=$topic_id'> $topic_title</a></h3>
        <p>Username: <a href='user_profile.php?topic_id=$users_id'> $last_name</a></p>
        <p>Topic: $post_title</p>
        <p>Content : $content</p>
        <p>Posted Date: $post_date</p>
            <a href='single.php? post_id=$post_id' style='float:right;'><button> See Replies or Reply to this</button></a>
        
        </div></br>
        ";
    }
        }
        }
    }
    include("pagenation.php");
}




function get_group_posts($topic_id){
    global $connection;
    $per_page=5;
     $user = $_SESSION['email'];
    if(isset($_GET['page'])) {
        
        $page = $_GET['page'];
        }
    else {
        $page=1;
    }
    $user = $_SESSION['email'];
    $start_from =($page-1) * $per_page;
    $get_posts="select users_id from users where email='$user'";
    $run_posts = mysqli_query($connection,$get_posts);
    while($row_posts = mysqli_fetch_array($run_posts,MYSQLI_ASSOC) ){
    
       $users_id = $row_posts['users_id'];
       
     //getting the user who has posted the thread
    $user= "select * from posts where topic_id='$topic_id' order by post_date DESC";
    
        $run_user= mysqli_query($connection,$user);
        while($row_user= mysqli_fetch_array($run_user,MYSQLI_ASSOC)){
         $post_id = $row_user['post_id'];
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
        
        
    //now displaying all at once
        
        echo "<div id='posts'>
        <h3>Group Name : <a href='group_profile.php?topic_id=$topic_id'> $topic_title</a></h3>
        <p>Username: <a href='user_profile.php?topic_id=$users_id'> $last_name</a></p>
        <p>Topic: $post_title</p>
        <p>Content : $content</p>
        <p>Posted Date: $post_date</p>
            <a href='single.php? post_id=$post_id' style='float:right;'><button> See Replies or Reply to this</button></a>
        
        </div></br>
        ";
    }
        }
        }
    }
    include("pagenation.php");
}

?>	