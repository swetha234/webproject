<?php

$connection=mysqli_connect("localhost","admin","monarchs","pet_finder") or die("Connection Failed");

function InsertUser(){
    global $connection;
    if(isset($_POST['signup'])){
        $first_name = $_POST['u_firstname'];
        $last_name = $_POST['u_lastname'];
        $email = $_POST['u_email'];
        $password = $_POST['u_password'];
        $status="unverified";
     
        
        $get_email= "select * from users where email='$email' ";
        $run_email= mysqli_query($connection,$get_email);
        $check=mysqli_num_rows($run_email);
        
        if($check==1){
            echo "<script> alert('This email is already registered') </script>";
            exit();
        }
        else  {
            
            $insert = "insert into users (first_name, last_name,email,password,user_image,status) values('$first_name','$last_name','$email','$password', 'default.jpeg', '$status')";
            $run_insert = mysqli_query($connection,$insert);
            
            if($run_insert){
                
                  echo "<script> alert('Successful') </script>";
          
            
            }
        }
        
    }
}

?>        