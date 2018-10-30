<?php
session_start();
include "session.php";


    

    
    
?>
<!DOCTYPE html>
<html>
<head>
<title>Welcome</title>
    <link rel= "stylesheet" href="style/home_style.css" media ="all"/>
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
                    
                </ul>
            </div>
        </div>
                <form method="post" action="my_findgroup.php" id="form1">
                
                <input type = "text" name = "user_query" placeholder = "search a topic"/>
                    <input type = "submit" name = "search" value="Search">
                    <a href='create.php'> Create a group</a> 
                    
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
                    <p><strong>Name : </strong><a href='#'> $last_name</a></p> 
                    <p><a href='my_global.php'> Global Group </a> </p>
                    <p><a href='my_groups.php'> My Groups </a> </p>
                     <p><a href='my_findgroup.php'> Find a group</a> </p>
                     
                     
                     <p><a href='my_editprofile.php'> Edit My Profile </a> </p>
                    </div>";
                    ?>
                    
                </div>
            </div>
        
                    <div id= "content_timeline">
                
                     <br>
                     <br>
                        
                        
                    <?php 
                        
                     if(isset($_POST['search'])){
                        get_search_results($users_id);
                         
                     }
                        else{
                        get_groups($users_id); 
                        }
                
                
                ?>
            </div>
        </div>
    </div> 
   
   
</body>
</html>
