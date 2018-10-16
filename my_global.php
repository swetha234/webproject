<?php
session_start();
include "session.php";

//if(!isset($_SESSION['email'])){
//    
//    header("location: login.php");
//    
//}

    
    
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
                  
                    $get_user = "select * from users where email = '$user'";
                    $run_user = mysqli_query($connection,$get_user);
                    $row=mysqli_fetch_array($run_user);
                     
                    $users_id = $row['users_id'];
                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];
                    $user_image=$row['user_image'];
                    echo "
                    <center><img src='images/$user_image' width='200' height='200'/></center>
                    <div id='user_mention'>
                    <p><strong>Name : </strong> $last_name</p> 
                    <p><a href='my_global.php'> Global Group </a> </p>
                     <p><a href='my_posts.php'> My Posts </a> </p>
                     <p><a href='my_findgroup.php'> Find a group</a> </p>
                     <p><a href='my_groups.php'> My Groups</a> </p>
                     <p><a href='my_editprofile.php'> Edit My Profile </a> </p>
                    </div>";
                    ?>
                </div>
            </div>
        
            <div id= "content_timeline">
                <form action="my_global.php" method="post" id="f" >
                <h2> What's on your mind..?</h2>
                    <input type="text" name="title" placeholder="Write a Title" size="73"/><br/>
                    <textarea cols="71" rows="4" name="content" placeholder="Write a descripntion"></textarea><br/>
                    <select name="topic">
                        <option>Select Topic</option>
                        <?php getTopics(); 
                        $global = '1';?>     
                    </select>
                    <input type="submit" name="sub" value="Post to Timeline" />
                    
                    
                </form>
                     <br>
                     <br>
                <?php insertPost($global); ?>
                
                    
                    <h3>Most Recent Discussions..!</h3>
                    <?php get_globalposts(); ?>
                
            </div>
        </div>
    </div> 
   
    
</body>
</html>
