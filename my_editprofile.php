<?php
session_start();
include "session.php";



    
    
?>
<!DOCTYPE html>
<html>
<head>
<title>Welcome</title>
    <link rel= "stylesheet" href="style/home_style.css" media ="all"/>
    <style>
    
        input[type='file']{ width:180px; }
    
    </style>
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
                    $email= $row['email'];
                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];
                    $user_image=$row['user_image'];
                    $password=$row['password'];
                    echo "
                    <center><img src='user/user_images/$user_image' width='200' height='200'/></center>
                    <div id='user_mention'>
                    <p><strong>Name : </strong> $last_name</p> 
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
                  
                      <form action = "" method="post" id="f" class="ff" enctype="multipart/form-data" style="float-text:left">
                  
                 <table>
                     <tr >
                     
                     <td colspan="6"><h2>Edit your Profile</h2></td>
                     </tr>
                     <tr>
                         <td align= "right">Photo:</td>
                         <td>
                         <input type="file" name= "u_image" required="required"/>
                         </td>
                     </tr>
                     
                     <tr>
                         <td align= "right">First Name:</td>
                         
                         <td>
                         <input type="text" name= "u_firstname" required="required" value="<?php echo $first_name;?>"/>
                         </td>
                     </tr>
                      <tr>
                         <td align= "right">Last Name:</td>
                         
                         <td>
                         <input type="text" name= "u_lastname" required="required" value="<?php echo $last_name;?>"/>
                         </td>
                     </tr>
                      <tr>
                         <td align= "right">Email:</td>
                         
                         <td>
                         <input type="email" name= "u_email" required="required" value="<?php echo $email;?>"/>
                         </td>
                     </tr>
                     <tr>
                         <td align= "right">Password:</td>
                         
                         <td>
                         <input type="password" name= "u_password" required="required" value="<?php echo $password;?>" />
                         </td>
                     </tr>
                      <tr align="center">
                         <td colspan="6">
                         <input type="submit" name="update" value="Update">
                         </td>
                     
                     
                     </tr>
                          
                          </table>
                          
                          
                          
                     </form>
                    <?php
                    if(isset ($_POST['update'])){
                        $u_firstname = $_POST['u_firstname'];
                        $u_lastname = $_POST['u_lastname'];
                        $u_password= $_POST['u_password'];
                        $u_email= $_POST['u_email'];
                        $u_image= $_FILES['u_image']["name"];
                        $image_tmp= $_FILES['u_image']["tmp_name"];
                        echo $image_tmp;
                        echo $u_image;
 
move_uploaded_file($image_tmp,"user/user_images/$u_image");
                        
                        $update="update users set last_name='$u_lastname', password='$u_password', email='$u_email',
                        user_image='$u_image' where users_id='$users_id'";
                        
                        echo $update;
                        $run = mysqli_query($connection, $update);
                        
                        if($run){
                            
                            echo "<script>alert('Your Profile Updated!')</script>";
                            echo "<script>window.open('home.php','_self')</script>";
                        }
                        
                    }
                    ?>
                
            </div>
        </div>
    </div> 
    </div>
    
</body>
</html>
