<?php 

   global $connection;
    $get_id =$_GET['post_id'];
    $get_com="select * from comments where post_id='$get_id' ORDER by 1 DESC";
    $run_com = mysqli_query($connection,$get_com);
    
while($row=mysqli_fetch_array($run_com)){

    $com= htmlspecialchars(addslashes(mysqli_real_escape_String($connection,$row['comment'])));
    $com_user_name= htmlspecialchars(addslashes($row['comment_authur']));
    $date= $row['date'];
    
    echo "
    <div id='comments'>
    <h3>$com_user_name</h3><span><i>Said</i> on $date </span>
    <p>$com</p>
    </div>
    ";
    }

?>