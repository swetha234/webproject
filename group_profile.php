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
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
<body>

    <!-- container starts-->
    <div class='container'>
       

        <div id= "head_wrap">
            <div id="header">
                <ul id="menu">
                <li><a href="home.php">Home</a></li>
                <li><a href="members.php">Members</a></li>
                   
                <li><a href="logout.php">Logout</a></li>
                    <li><a href="help.php">Help</a></li>
                    
                </ul>
            </div>
        </div>
<!--
                <form method="get" action="results.php" id="form1">
                
                <input type = "text" name = "user_query" placeholder = "search a topic"/>
                <input type = "submit" name = "search" value="Search">
                </form>
-->
                    
        <div class = "content">
            <div id= "user_timeline">
                <div id="user_details">
                    <?php
                    $user = $_SESSION['email'];
                    $topic_id=$_GET['topic_id'];
                   
                    
                    $get_user = "select * from users where email = '$user'";
                    $run_user = mysqli_query($connection,$get_user);
                    $row=mysqli_fetch_array($run_user);
                     
                    $users_id = $row['users_id'];
                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];
                    $user_image=$row['user_image'];
                    echo "
                    <center><img src='user/user_images/$user_image' width='200' height='200'/></center>
                    <div id='user_mention'>
                    <p><strong><a href='my_profile.php'>Name :  $last_name </a></strong> </p>
                    <p><a href='my_global.php'> Global Group </a> </p>
                     <p><a href='my_groups.php'> My Groups </a> </p>
                     <p><a href='my_findgroup.php'> Find a group</a> </p>
                     <p><a href='my_editprofile.php'> Edit My Profile </a> </p>
                    </div>";
                    ?>
                </div>
            </div>
            <div id= "content_timeline">
                
              
                <form action="group_profile.php?topic_id=<?php echo $topic_id;?>" method="post" id="f" >
                    
                 
                <h2> What's on your mind..?</h2>
                    <input type="text" name="title" placeholder="Write a Title" size="73"/><br/>
                    <textarea cols="71" rows="4" name="content" placeholder="Write a description"></textarea><br/>
                    <input type="text" name="topic" style="display:none;"  value ="<?php echo $topic_id;
                    $global = "NULL"; 
                    ?>"/>

                       
                    <input type="submit" name="sub" class="sub-group" value="Post to Timeline" />
                     
                     
                  <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    
                    <br>
                    <br>
                     <div id="group_posts">
                    </div>
                </form>
                <?php insertPost($global); ?>
                
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
    <a href='?page=1'>First Page</a>
    ";
    
    for ($i=1; $i<=$total_pages; $i++){
        echo"<a href='?page=$i&topic_id=$topic_id'>$i</a>";
    }
    echo "<a href='?page=$total_pages&topic_id=$topic_id'>Last Page</a></center></div>";
    
    
 


  
                ?>
                
            </div>
           
            <div id="members_div" >
            
            <h3 >Members: </h3>
                <?php members_list($topic_id,$users_id); ?>
              
            </div>
         </div>
    </div> 
  <script src="scripts.js"></script>  
    
</body>
</html>
