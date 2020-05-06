<?php
global $connection;
$per_page = 5;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$start_from = ($page - 1) * $per_page;
$user = $_SESSION['email'];

$get_posts = "select users_id from users where email='$user' ";
$run_posts = mysqli_query($connection, $get_posts);
while ($row_posts = mysqli_fetch_array($run_posts, MYSQLI_ASSOC)) {

    $users_id_global = $row_posts['users_id'];

    //getting the user who has posted the thread
    $user_posts = "select * from posts where global is not NULL order by post_date DESC LIMIT $start_from,$per_page ";

    $run_user = mysqli_query($connection, $user_posts);
    while ($row_user = mysqli_fetch_array($run_user, MYSQLI_ASSOC)) {
        $post_id = $row_user['post_id'];
        $users_id = $row_user['users_id'];
        $topic_id = $row_user['topic_id'];
        $post_title = $row_user['post_title'];
        $content = $row_user['post_content'];
        $post_date = $row_user['post_date'];
        //to get topic title
        $topic_title_query = "select topic_title from topics where topic_id='$topic_id'";
        $run_post_title = mysqli_query($connection, $topic_title_query);

        while ($row_post_title = mysqli_fetch_array($run_post_title, MYSQLI_ASSOC)) {

            $topic_title = $row_post_title['topic_title'];
            //        $user_image =$row_user['user_image'];
            $user_details = "select * from users where users_id='$users_id'";
            $run_user_details = mysqli_query($connection, $user_details);
            while ($row_user_details = mysqli_fetch_array($run_user_details, MYSQLI_ASSOC)) {

                $last_name = $row_user_details['last_name'];

                $user_image = $row_user_details['user_image'];


?>

<div id='posts'>
    <p> <img src='user/user_images/<?php echo $user_image; ?>' width='50' , height='50'></p>
    <h3>Group Name : <a href='group_profile.php?topic_id=$topic_id'><?php echo $topic_title; ?></a></h3>
    <p>Username: <a href='user_profile.php?topic_id=$users_id'><?php echo $last_name; ?></a></p>
    <p>Topic:<?php echo $post_title; ?></p>
    <p>Content :<?php echo $content; ?></p>
    <p>Posted Date:<?php echo $post_date; ?></p>

    <!-- if user likes post, style button differently -->
    <i <?php if (userLiked($post_id, $users_id_global)) : ?> class='fa fa-thumbs-up like-btn' <?php else : ?>
        class='fa fa-thumbs-o-up like-btn' <?php endif ?> data-id='<?php echo $post_id; ?>'
        data-id1='<?php echo $users_id_global; ?>'></i>


    <span class='likes'><?php echo getLikes($post_id); ?></span>

    &nbsp;&nbsp;&nbsp;&nbsp;

    <!-- if user dislikes post, style button differently -->
    <i <?php if (userDisliked($post_id, $users_id_global)) : ?> class='fa fa-thumbs-down dislike-btn' <?php else : ?>
        class='fa fa-thumbs-o-down dislike-btn' <?php endif ?> data-id='<?php echo $post_id; ?>'
        data-id1='<?php echo $users_id_global; ?>'></i>
    <span class='dislikes'><?php echo getDislikes($post_id); ?></span>
    <a href='single.php?post_id=<?php echo $post_id; ?>' style='float:right;'><button> See Replies or Reply to
            this</button></a>
</div><br>

<?php



            }
        }
    }
}