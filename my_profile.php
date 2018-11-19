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
    <meta charset="utf-8">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    </head>
<body>


    <!-- container starts-->
    <div class='container' >
       

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
  <?php
                    $user = $_GET['id'];
                  
                    $get_user = "select * from users where users_id = '$user'";
                    $run_user = mysqli_query($connection,$get_user);
                    $row=mysqli_fetch_array($run_user);
                     
                    $users_id = $row['users_id'];
                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];
                    $user_image=$row['user_image'];
                   
                    ?>
                </div>

             <div id= "content_timeline">
                <?php
                    echo "
                    <h1> Profile page: </h1>
                    <center><img src='user/user_images/$user_image' width='200' height='200'/></center>
                    <div id='user_mention'>
                     <p><strong><a href='my_profile.php'>Name : </strong> $last_name </a> </p>
                 </div>"
              
        ?>
                  
    
         
    
    </div>
   
    
</body>
</html>

