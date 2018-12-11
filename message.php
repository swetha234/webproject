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
    <script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
                    
        <div class = "centralised">
           

<h2>Chat</h2>
            
           
<!--
        <form action='single.php?post_id=$post_id' method='post' id='reply'>
        <textarea cols='76' rows='5' name='comment' placeholder='Chatting.....'></textarea>
       <br><br><br><br><br><br><br>
        <input id = 'help' type='submit' name='reply' value='Reply'/>
        </form>
-->
           
                 <?php 
            
            if(isset($_GET['id'])){
                
               $chat_userid = $_GET['id'];
               $susers_id = $_SESSION['users_id'];
                echo " <div class='chathistory'>";
                
                $chat_user = "SELECT first_name from users where users_id ='$chat_userid ' ";
     $chat_run = mysqli_query($connection,$chat_user);
     while($run_chat = mysqli_fetch_array($chat_run)){

        $chat_firstname =  $run_chat['first_name'];
     }
              $u_chats = "SELECT * FROM `chat` WHERE msg_user_id='$chat_userid$susers_id' or msg_user_id='$susers_id$chat_userid'";
 
   
     $r_chats =  mysqli_query($connection,$u_chats);
    while($row_chats=mysqli_fetch_array($r_chats))
    {
         $chat_id = $row_chats['chat_id'];
         $user_id = $row_chats['users_id'];
         $chat_user_id = $row_chats['msg_user_id'];
         $content = $row_chats['msg_content'];
         $msg_timestamp = $row_chats['msg_timestamp'];
         
         $userfrom = "select * from users where users_id='$user_id'";
        $row_userfrom = mysqli_query($connection,$userfrom);
        while($result_user=mysqli_fetch_array($row_userfrom)){
            
             $user_name = $result_user['first_name'];
        } 
        
         if( $chat_user_id == $chat_userid.$susers_id){
                    
            echo "<br><br><p style='float:right'> $user_name : $content </p> ";
                }
                
                else{
                    
                    echo "<br><br><p style='float:left'> $user_name : $content </p>";
                    
                }
        
    }
               
                
              echo  "</div>
            
            <div class ='chatbox'>
            
            
            
            </div>
           
            
            <form action='' method='POST'>";
             echo "<textarea class='txtarea msg' id =".$chat_userid." name='msg'></textarea></form>";
            }
            ?> 
        </div>
    </div> 
<script src="scripts.js"></script>  
</body>
</html>

