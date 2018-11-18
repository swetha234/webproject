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
<!--    <script type="text/javascript" src="js/jquery-1.11.3.js"></script>-->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  
   
    <script type="scripts.js"></script>
    
    
    
   
    </head>
<body>
         


    <!-- container starts-->
    <div class='container'>
       
            
               
                
        <div id= "head_wrap">
            <div id="header">
                <ul id="menu">
                <li><a href="home.php">Home</a></li>
                <li><a href="members.php">Members</a></li>
                    <li><a href="help.php">Help</a></li>
                <li><a href="logout.php">Logout</a></li>
             
                    
                </ul>
            </div>
        </div>
        
   <form method="get" action="search.php" id="form1">
                <span class="input-group-addon">Search</span>
                <input type = "text" name = "search_text" id = "search_text"  placeholder = "search for names..."/>
<!--                <input type = "submit" name = "search" value="Go">-->
                    <br>
                    
                    <div id="result"></div>
            
              </form>     
        <div class = "content">

            
          
            <div id= "user_timeline">
                <div id="user_details">
                    <?php
                    $user = $_SESSION['email'];
                 
                    
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
                     <p><strong><a href='my_profile.php'>Name : </strong> $last_name </a> </p>
                    <p><a href='my_global.php'> Global Group </a> </p>
                    <p><a href='my_groups.php'> My Groups</a> </p>
                     <p><a href='my_findgroup.php'> Find a group</a> </p>
                     
                     <p><a href='my_editprofile.php'> Edit My Profile </a> </p>
                    </div>";
                    ?>
                </div>
            </div>
        
            <div id= "content_timeline">
              
                <form id="f" >
                <h2> What's on your mind..?</h2>
                    <input type="text" id="title" name="title" placeholder="Write a Title" size="73"/><br/>
                    <textarea cols="71" id="content" rows="4" name="content" placeholder="Write a description"></textarea><br/>
                    <select name="topic">
                        <option>Select Topic</option>
                        <?php getTopics(); 
                        $global = '1';?>     
                    </select>
                    <input type="submit" id="sub" class="sub-post" value="Post to Timeline" />
                    
                    
                </form>
                     <br>

                
                    
                    <h3>Most Recent Discussions..!</h3>
                    <div id="global_posts">
                    </div>
                        <?php 
                          get_globalposts(); 
                          include "pagenation.php";
                        ?>
                
            </div>
        </div>
    </div> 
   
  <script src="scripts.js"></script>    
</body>
   
</html>
