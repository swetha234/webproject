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

    </head>
     
<body>


    <!-- container starts-->
    <div class='container' >
       

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
                    <center><img src='user/user_images/$user_image' width='200' height='200'/></center>
                    <div id='user_mention'>
                    <p><strong><a href='my_profile.php?id=$users_id'>Name : </strong> $last_name </a> </p> 
                    <p><a href='my_global.php'> Global Group </a> </p>
                    
                     <p><a href='my_groups.php'> My Groups </a> </p>
                     
                     <p><a href='my_findgroup.php'> Find a group</a> 
                     </p>
                     <p><a href='my_editprofile.php?u_id=$users_id'> Edit My Profile </a> </p>
                    </div>";
                    ?>
                </div>
            </div>
        
               <div id= "content_timeline">
                 
          <div id="form2">
                <form action = "" class="fff" method="post" style=" top-margin:30px; text-align :center; ">
                    
               
                    <table>
                     <tr >
                     
                         <td colspan="6"><h2 align= "left">Invite users to group</h2></td> <br/>
                     </tr>
                     <tr>
                         <td>Group name:</td>
                         
                         <td>
                         <input align= "left" type="text" value="" name= "u_groupname"/>
                         </td>
                     </tr> <br>
<!--
                        
                     <tr>
                         <td>Select:</td>
                         
                         <td>
<input type="radio" name="choose" value="private"> Private
                         </td>
                         <td>
                           <input type="radio" name="choose" value="public"> Public
                         </td>
                     </tr>
-->
                        <tr>
                         <td>Invite:</td>
                         
                         <td>
                         <input align= "left" type="text" name='u_invite'/>
                         </td>
                     </tr><br>
                         <tr align="center">
                         <td colspan="6">
                         <input type="submit" name="invite" value="invite">
                         </td>
                     
                     
                     </tr>
                        
                     
<!--
                     <tr>
                         <td align= "right">First Name:</td>
                         
                         <td>
                         <input type="text" name= "u_firstname" required="required" value=""/>
                         </td>
                     </tr>
-->
                    </table>
                
                </form>
              <?php   create_group($users_id); ?>
              </div>
        

                     

                    <?php 
                    
                    
     global $connection;
    if(isset($_POST['invite'])){
        $topic_title = $_POST['u_groupname'];
       
        $email = $_POST['u_invite'];
        
       
        
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
        
        
            
             $insert_user_group="INSERT INTO user_group (users_id, topic_id) VALUES ('$new_users_id','$topic_id')";
      
        $run_insert_user_group=mysqli_query($connection,$insert_user_group);
        
    
           
        if($run_insert_user_group){
                  echo "Invitation Successful";
            }
    
    }
        
    
                    
                    
                    
                    
                    
                    ?>
                
            </div>
            
        </div>
    </div> 
   
    
</body>
</html>

