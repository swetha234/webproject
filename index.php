<?php 
session_start();
include "session.php";

      
?>	

<?php


$Invalid=" ";
if (isset($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password'])){
		$email = $_POST['email'];
		$password = $_POST['password'];
		$email = mysqli_real_escape_string($connection,$email);
		$password = mysqli_real_escape_string($connection,$password);	
		$query = "SELECT * from users where email='$email' and password='$password' ";
		$result = mysqli_query($connection,$query) or die("Failed to query database".mysqli_error());
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			if ($result->num_rows > 0){
                $_SESSION['email']= $row['email'];
                $_SESSION['users_id']=$row['users_id'];
                $_SESSION['first_name']= $row['first_name'];
                $_SESSION['last_name']= $row['last_name'];
                $_SESSION['user_image']= $row['user_image'];
				header('Location:home.php');
                
				}
			else{
	 			$Invalid= "Invalid email or password!";
                               #echo $Invalid;
	 		}
			mysqli_close($connection);
		}

?>



<html>
     <head>
         
          <title> PET Finder</title>
    <link rel = "stylesheet" href = "style/style.css" media ="all"/>
         <script src='https://www.google.com/recaptcha/api.js'></script>

        
    <style>
         
         h1{
    
    font-size: 500%;
    font-family: cursive;
    top: 20px;
    left:20px;
             position: absolute;
             
}
        div.a{
            
            position:absolute;
            bottom: 300px;
            left: 20px;
            
        }     
        #form2{
            
            margin-top: -500px;
            
        }
        
      
        
         </style>
    
    
<body>
                 
    <h1> Pet Finder </h1>
      <!--container starts-->   
         
         <div class = "container">
             <!--Head wrap starts-->
             <div id = "head_wrap">
                 <!-- Header starts-->
                 <div id ="header">
                    
                     <form method="post" id="form1">
                         
                         <strong>Email:</strong>
                    <input type="email" id = "email" name="email" placeholder = "Email" required= "required"/>
                         <strong>Password:</strong>
                         <input type="password" id ="password" name= "password" placeholder="********" required= "required"/>
                    <button id="login" name="login">Login</button> 
                         
                         
                         <?php
              			echo $Invalid;
                         ?>
                     </form>
            </div>
                 <!-- Header ends-->
             </div>
             <!--Head wrap starts-->
             
             <!-- content area starts -->

             <div id="content">
             
             <div>
                 
                 <img src= "images/blacklab.jpg"  style="float:left;  width:550px; height:600px">
                 
               
                 
                 </div>
                 <?php 
                    include "function.php";
                 ?>

                <div id="form2">
                      <form action = "" method="post">
                        <h2 style='margin-left:400px;'>Sign Up Here</h2>
                          <br>
                          
                 <table>
                     <tr>
                         <td align= "right">First Name:</td>
                         
                         <td>
                         <input type="text" name= "u_firstname" placeholder= "Enter your first name"/>
                         </td>
                     </tr>
                      <tr>
                         <td align= "right">Last Name:</td>
                         
                         <td>
                         <input type="text" name= "u_lastname" placeholder= "Enter your last name"/>
                         </td>
                     </tr>
                      <tr>
                         <td align= "right">Email:</td>
                         
                         <td>
                         <input type="email" name= "u_email" placeholder= "Enter your email"/>
                         </td>
                     </tr>
                     <tr>
                         <td align= "right">Password:</td>
                         
                         <td>
                         <input type="password" name= "u_password" placeholder= "********"/>
                         </td>
                     </tr>
                     
                     
                      <tr>
                   
                         
                         <td>
                             
    <div class="g-recaptcha" data-sitekey="6LeTdH0UAAAAAFHoqlRYELZem7vYHJHUQGUOBWbe"></div>

                         </td>
                     </tr>
                     

                    
                    
                     
                     
                     <tr>
                
                     
                     <td colspan="6">
                         
                         <button name= "signup"> Sign Up</button>
                         </td>
                     
                     
                     </tr>
                          
                          </table>
                          
                          
                          
                     </form>
                    <?php InsertUser(); ?>

                </div>
            </div>
              <!-- content area ends --> 
             
        </div> 
    <!-- container ends-->
         
         </body>
    </head>

</html>