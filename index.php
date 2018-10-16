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
        
         </style>
    
    
<body >
                 
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
             
             
             <div id="content">
             
             <div>
                 
                 <img src= "images/blacklab.jpg"  style="float:left; margin-right:40px; width:1450px">
                 
                 
                 
                 </div>

<!--
                <div class ="a">
                      <form action = "" method="post">
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
                         <td align= "right">Passowrd:</td>
                         
                         <td>
                         <input type="password" name= "u_pass" placeholder= "********"/>
                         </td>
                     </tr>
                      <tr>
                         <td align= "right">Confirm Passowrd:</td>
                         
                         <td>
                         <input type="text" name= "u_confirmpass" placeholder= "********"/>
                         </td>
                     </tr>
                    
                     
                     
                     <tr>
                     
                     <td>
                         
                         <button name= "signup"> Sign Up</button>
                         </td>
                     
                     
                     </tr>
                          
                          </table>
                          
                     </form>

                    
                    
                     

                     
                 
                 </div>


             
-->
                 
                 
              
             </div>
             
             
    </div> 
    
    
    <!-- container ends-->
         
         
         
         
         </body>
    
    
    
    
    
    
    
    
    </head>

</html>