<?php 
	session_start();
	require("connection.php");
   global $connection; 
$output='';
$sql= "select first_name,last_name, users_id from users where first_name like '%".$_POST["search"]."%' or last_name like '%".$_POST["search"]."%'";
$result = mysqli_query($connection, $sql);
if(mysqli_num_rows($result)>0)
{
   
        while($row = mysqli_fetch_array($result))
        {
            $output .='<a href=my_profile.php?id='.$row['users_id'].'>'.$row['first_name'].' '.$row['last_name'].' </a><br> ';
      
        
    
        }
    echo $output;
}
else
{
    echo 'data not found';
}