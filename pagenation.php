<?php
$connection=mysqli_connect("localhost","admin","monarchs","pet_finder") or die("Connection Failed");

    global $connection;
 $per_page=5;
    
    if(isset($_GET['page'])) {
        
        $page = $_GET['page'];
        }
    else {
        $page=1;
    }
    $start_from=($page-1) * $per_page;
    
//       $connection=mysqli_connect("localhost","admin","monarchs","pet_finder") or die("Connection Failed");

        

        $query = "select * from posts where global is not NULL ";
        $result = mysqli_query($connection,$query);
        $total_posts= mysqli_num_rows($result);
        $total_pages = ceil($total_posts / $per_page);
        

    
 echo"
    <center>
    <div id='pagenation'>
    <a href='?page=1'>First Page</a>
    ";
    
    for ($i=1; $i<=$total_pages; $i++){
        echo"<a href='?page=$i'>$i</a>";
    }
    echo "<a href='?page=$total_pages'>Last Page</a></center></div>";
    
    
 
?>    

