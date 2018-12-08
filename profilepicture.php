<?php
session_start();
include "session.php";
if(!isset($_SESSION['email'])){
    
    header("location: index.php");
    
}



if(isset($_POST['default'])){ 

 $mail_id = $_SESSION['email'];
 $user_id = $_SESSION['users_id'];


    $sql = "update `users` set user_image = 'default.jpeg' where users_id='$user_id'";
    $r_update=mysqli_query($connection,$sql);

     $sql1 = "update `users` set dp_value = 0 where users_id='$user_id'";
    $r_update1=mysqli_query($connection,$sql1);
 
}

if(isset($_POST['gravatar'])){ 

$mail_id = $_SESSION['email'];
 $user_id = $_SESSION['users_id'];
 $url = 'https://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $mail_id ) ) );

    $sql = "update `users` set user_image = '$url' where users_id='$user_id'";
    $r_update=mysqli_query($connection,$sql);

     $sql1 = "update `users` set dp_value = '1' where users_id='$user_id'";
    $r_update1=mysqli_query($connection,$sql1);
 
}

?>