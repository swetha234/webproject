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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                    
                     $profile = '';
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
                 </div><br>";
                 
                 echo " Groups: <br><br>";
                 
                 //to get total groups
        $total_groups = "SELECT count(*) as total from user_group WHERE users_id ='$users_id'";

        $run_total_groups = mysqli_query($connection,$total_groups);
        $row_run_total_groups = mysqli_fetch_array($run_total_groups,MYSQLI_ASSOC);   
        $group_count = $row_run_total_groups['total'];             
    
                 //to get total posts
       $total_posts = "SELECT count(*) as total from posts WHERE users_id ='$users_id'";

        $run_total_posts = mysqli_query($connection,$total_posts);
        $row_run_total_posts = mysqli_fetch_array($run_total_posts,MYSQLI_ASSOC);   
        $posts_count = $row_run_total_posts['total'];            
                 
                 //to get total likes
                 
         $total_rating = "SELECT count(*) as total from rating WHERE users_id ='$users_id'";

        $run_total_rating = mysqli_query($connection,$total_rating);
        $row_run_total_rating = mysqli_fetch_array($run_total_rating,MYSQLI_ASSOC);   
        $rating_count = $row_run_total_rating['total']; 
                 
        $get_groups = "SELECT topics.topic_title from topics INNER JOIN user_group where topics.choose='public' and topics.topic_id = user_group.topic_id and user_group.users_id = $users_id ";
        $run_get_groups = mysqli_query($connection,$get_groups);
        while ($row_get_groups = mysqli_fetch_array($run_get_groups)){
            
             $topicstile = $row_get_groups['topic_title'];
            
            echo $topicstile ;
            echo "<br>";
            
        }
                 
                 
                 
        ?>
                 <br>
                 <br>
                 <p>Reputation Metrix:  </p>
                 <p>Total Posts: <?php echo $posts_count;?> </p>
                 <p>Total Ratings: <?php echo $rating_count;?> </p>
                 <p>Total Groups Involved: <?php echo $group_count;?> </p>
                <?php
                 
                 $total_count = $group_count+$posts_count+$rating_count;
                 
//                  if($posts_count >5 && $rating_count >=3 && $group_count >=3)
                 if ($total_count >10)
            {
                  for($i =1; $i<=5; $i++ )
                  {
                    $profile=$profile."<i class='fa fa-star checked' style='font-size:24px ;color:orange ;' ></i>  ";
                  }
                    $profile=$profile."100%</li> <br>";

            }

//            else if($posts_count >=5 && $rating_count <=3 && $group_count <=2){
                 else if ($total_count >= 6){
                 for($i =1; $i<=1; $i++ )
                  {

                     for($j =1; $j<=4; $j++ )
                     {
                       $profile=$profile."<i class='fa fa-star checked' style='font-size:24px ; color:orange; '></i> ";
                      }
                    
                     $profile=$profile."<i class='fa fa-star' style='font-size:24px; color:black;'></i> ";
                    
                  }
                  $profile=$profile."80%</li> <br>";

            }
//             else if($posts_count <=3 && $rating_count <2 && $group_count <=1){
                else if ($total_count >= 3){

             for($i =1; $i<=1; $i++ )
              {

                 for($j =1; $j<=3; $j++ )
                 {
                   $profile=$profile."<i class='fa fa-star checked' style='font-size:24px ; color:orange; '></i> ";
                  }

                 $profile=$profile."<i class='fa fa-star' style='font-size:24px; color:black;'></i> ";
                 $profile=$profile."<i class='fa fa-star' style='font-size:24px; color:black;'></i> ";

              }
              $profile=$profile."60%</li> <br>";

        }
            else{
                    for($i =1; $i<=5; $i++ )
                  {
                    $profile=$profile."<i class='fa fa-star' style='font-size:24px; color:black;'></i> ";
                  }
                  $profile=$profile."0%</li> <br>";

            } 

             echo $profile;    
                 
//                 
//                 echo " <i class='fa fa-star-o' style='font-size:24px'></i> ";
                 
                 
                 ?>
    
    </div>
   
    
</body>
</html>

