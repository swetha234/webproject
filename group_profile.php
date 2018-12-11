<?php
session_start();
include "session.php";
if(!isset($_SESSION['email'])){
    
    header("location: index.php");
    
}




    

?>
<!DOCTYPE html>
<html>
<head>
<title>Welcome</title>
    <link rel= "stylesheet" href="style/home_style.css" media ="all"/>
<!--    font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!--  <link rel="stylesheet" href="/resources/demos/style.css">-->
<!--  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!--  bootstrap css-->
<!--    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">-->
<!--jquery-->
    
<!--bootstrap js-->
<!--    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> -->
<!--summernote css-->
<!--<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">-->
<!--summernote js-->
<!--    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>-->
    
<!--  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-lite.js"></script>  
    
    

    
<script type="scripts.js"></script>    
   <script>
	$(document).ready(function() {
        
		$('#summernote').summernote({
            linkTargetBlank: false,
  			height: 200,
  			width: 400,                 // set editor height
  			minHeight: 100,             // set minimum height of editor
  			maxHeight: 600,             // set maximum height of editor
  			focus: true                    // set focus to editable area after initializing summernote
        
		});
    });
</script>
    </head>
<body>

    <!-- container starts-->
    <div class='container'  style="width:100%;">
       

        <div id= "head_wrap">
            <div id="header">
                <ul id="menu">
                <li><a href="home.php">Home</a></li>
                <li><a href="members.php">Message</a></li>
                   
                <li><a href="logout.php">Logout</a></li>
                    <li><a href="help.php">Help</a></li>
                    
                </ul>
            </div>
        </div>
  <form method="get" action="search.php" id="form1" style="float:right;width: 200px;">
<!--                <span class="input-group-addon">Search</span>-->
                <input type = "text" name = "search_text" id = "search_text"  autocomplete="false" placeholder = "search for names..."/>
<!--                <input type = "submit" name = "search" value="Go">-->
                    <br>
                    
                    <div id="result"></div>
            
              </form>  
                    
        <div class = "content">
            <div id= "user_timeline">
                <div id="user_details">
                    <?php
                    $user = $_SESSION['email'];
                    $topic_id=$_GET['topic_id'];
                    $topic_title = $_GET['topic_name'];
                   
                    
                    $get_user = "select * from users where email = '$user'";
                    $run_user = mysqli_query($connection,$get_user);
                    $row=mysqli_fetch_array($run_user);
                     
                    $users_id = $row['users_id'];
                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];
                    $user_image=$row['user_image'];
                    $dp_value = $row['dp_value'];              
                    if($dp_value != '0')
                    {
                            echo "
                    <center><img src='user/user_images/$user_image' width='200' height='200'/></center>";
                    }
                    
                    else{
                        
                        echo "
                    <center><img src='$user_image' width='200' height='200'/></center>";
                        
                    }
                    
                    
                    
                    echo "
                    <div id='user_mention'>
                   <p><strong>Name : </strong> <a href='my_profile.php?id=$users_id'> $last_name </a> </p>
                    <p><a href='my_global.php'> Global Group </a> </p>
                     <p><a href='my_groups.php'> My Groups </a> </p>
                     <p><a href='my_findgroup.php'> Find a group</a> </p>
                     <p><a href='my_editprofile.php'> Edit My Profile </a> </p>
                    </div>";
                    ?>
                </div>
            </div>
            <div id= "content_timeline">
                
              <div>
                <form id="postform" >
                    
                 
                <h2> What's on your mind..?</h2>
                    <input type="text" id="title" name="title" placeholder="Write a Title" size="73"/><br/>
                     <textarea id="summernote" name="summernote">
                         </textarea>
                  
                    <input type="text" id = "topic_name_group"  style="display:none;"  value ="<?php echo $topic_id;
//                    $global = "NULL"; 
                    ?>"/>
    
                    <?php 
                    
                    $getarchive="SELECT * from archive_info where topic_id ='$topic_id'";
                    $result = mysqli_query($connection, $getarchive);
                    $row=mysqli_fetch_array($result);
                    
                    $archive_action = $row['archive_action'];
                    
                    if($archive_action == 'unarchive')
                    {
                    
                        echo " <input type='submit' name='$topic_title' class='sub-group' value='Post to Timeline' />";
                    }
                    
                    else{
                        
                        echo " You can't post";
                    }
                    
                    ?>
                    
                  </form>
                </div>
                       
<!--                    <input type="submit" name="sub" class="sub-group" value="Post to Timeline" />-->
                    
                     <div id="group_posts">
                    </div>
<!--                </form>-->
               <?php //insertPost($global); ?>
                
                     <br><br>
                
                    <?php get_group_posts($topic_id,$users_id);
               
                    
    $per_page=5;
    
    if(isset($_GET['page'])) {
        
        $page = $_GET['page'];
        }
    else {
        $page=1;
    }
    $start_from=($page-1) * $per_page;
    

        

        $query = "select * from posts where global is  NULL ";
        $result = mysqli_query($connection,$query);
        $total_posts= mysqli_num_rows($result);
        $total_pages = ceil($total_posts / $per_page);
               
        

    
 echo"
    <center>
    <div id='pagenation'>
    <a href='?page=1&topic_id=$topic_id&topic_name=$topic_title'>First Page</a>
    ";
    
    for ($i=1; $i<=$total_pages-1; $i++){
        echo"<a href='?page=$i&topic_id=$topic_id&topic_name=$topic_title'>$i</a>";
    }
    echo "<a href='?page=$total_pages&topic_id=$topic_id&topic_name=$topic_title'>Last Page</a></center></div>";

if ($users_id == 21){
  
                ?>
                    
            </div>
               
            <div id="members_div" >
            
            <h3 >Members: </h3>
                <?php members_list($topic_id,$users_id); ?>
              
            </div>
            <?php } ?>
         </div>
    </div> 
  <script src="scripts.js"></script>  
    
</body>
</html>
