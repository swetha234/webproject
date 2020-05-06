<?php
session_start();
include "session.php";

if (!isset($_SESSION['email'])) {

    header("location: index.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Welcome</title>
    <link rel="stylesheet" href="style/home_style.css" media="all" />
</head>

<body>
    <!-- container starts-->
    <div class='container'>
        <div id="head_wrap">
            <div id="header">
                <ul id="menu">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="members.php">Message</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <li><a href="help.php">Help</a></li>

                </ul>
            </div>
        </div>

        <div class="content">
            <div id="user_timeline">
                <div id="user_details">
                    <?php
                    $user = $_SESSION['email'];

                    $get_user = "select * from users where email = '$user'";
                    $run_user = mysqli_query($connection, $get_user);
                    $row = mysqli_fetch_array($run_user);

                    $users_id = $row['users_id'];
                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];
                    $user_image = $row['user_image'];
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

            <div id="content_timeline">

                <div id="form2">
                    <form action="" class="fff" method="post" style=" top-margin:30px; text-align :center; ">


                        <table>
                            <tr>

                                <td colspan="6">
                                    <h2 style="align-content: left">Create a Group</h2>
                                </td> <br />
                            </tr>
                            <tr>
                                <td>Group name:</td>

                                <td>
                                    <input style="align-content: left" type="text" value="" name="u_groupname" />
                                </td>
                            </tr>

                            <tr>
                                <td>Select:</td>

                                <td>
                                    <input type="radio" name="choose" value="private"> Private
                                </td>
                                <td>
                                    <input type="radio" name="choose" value="public"> Public
                                </td>
                            </tr>
                            <tr>
                                <td>Invite:</td>

                                <td>
                                    <input style="align-content: left" type="text" name='u_invite' />
                                </td>
                            </tr>
                            <tr style="align-content: left">
                                <td colspan="6">
                                    <input type="submit" name="create" value="Create">
                                </td>


                            </tr>

                        </table>

                    </form>
                    <?php create_group($users_id); ?>
                </div>

            </div>
        </div>
    </div>


</body>

</html>