<?php
//session_start();
include "session.php";

require "init.php";

?>

<?php

$Invalid = " ";
if (isset($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $email    = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);
    $query    = "SELECT * from users where email='$email' and password='$password' ";
    $result   = mysqli_query($connection, $query) or die("Failed to query database" . mysqli_error());
    $row      = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($result->num_rows > 0) {
        $_SESSION['email']      = $row['email'];
        $_SESSION['users_id']   = $row['users_id'];
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['last_name']  = $row['last_name'];
        $_SESSION['user_image'] = $row['user_image'];
        $_SESSION['dp_value']   = $row['dp_value'];
        header('Location:home.php');
    } else {
        $Invalid = "Invalid email or password!";
        #echo $Invalid;
    }
    mysqli_close($connection);
}

?>



<html>

<head>

    <title> PET Finder</title>
    <link rel="stylesheet" href="style/style.css" media="all" />
    <script src='https://www.google.com/recaptcha/api.js'></script>


    <style>
        h1 {

            font-size: 500%;
            font-family: cursive;
            top: 20px;
            left: 20px;
            position: absolute;

        }

        div.a {

            position: absolute;
            bottom: 300px;
            left: 20px;

        }

        /* .form2 {

            margin-top: -500px;

        } */
    </style>


<body style="margin: 0;
    padding: 0;">


    <!--container starts-->

    <div class="container">
        <!--Head wrap starts-->
        <div id="head_wrap">
            <!-- Header starts-->
            <h1> Pet Finder </h1>


            <form method="post" id="form1">

                <strong>Email:</strong>
                <input type="email" id="email" name="email" placeholder="Email" required="required" />
                <strong>Password:</strong>
                <input type="password" id="password" name="password" placeholder="********" required="required" />
                <button id="login" name="login">Login</button>



                <?php
                echo $Invalid;
                ?>
            </form>



            <!-- Header ends-->
        </div>
        <!--Head wrap starts-->

        <!-- sign up area starts -->

        <div id="content">
            <!-- <img src="images/blacklab.jpg "> -->
            <div id="form2">
                <?php
                include "function.php";
                ?>
                <form method="post">

                    <img src="images/blacklab.jpg" />

                    <table>

                        <h2 style="color: black"> Sign Up Here</h2>
                        <br>

                        <a href="https://github.com/login/oauth/authorize?scope=user:email&client_id=07e621826ef24f69d10c" style="color:black"> Got Github? <b>Sign In</b> Here! </a>
                        <tr>
                            <td style=" color:black"><label><b>First Name :</b></label></td>
                            <td><input type="text" name="u_firstname" placeholder="Enter name"></td><br>
                        </tr>

                        <tr>
                            <td style="color:black"><label><b>Last Name : </b></label></td>
                            <td><input type="text" name="u_lastname" placeholder="Enter Email"></td><br>
                        </tr>

                        <tr>
                            <td style="color:black"><label><b>Email : </b></label></td>
                            <td><input type="email" name="u_email" placeholder="Enter password"></td><br>
                        </tr>
                        <tr>
                            <td style="color:black"><label><b>Password :</b></label></td>
                            <td><input type="password" name="u_password" placeholder="Re enter password">
                        </tr>

                        <tr>
                            <td colspan="10">
                                <button name="signup"> Sign Up</button>
                            </td>


                        </tr>

                        <tr>
                            <td>
                                <div class="g-recaptcha" data-sitekey="6LeTdH0UAAAAAFHoqlRYELZem7vYHJHUQGUOBWbe"></div>
                            </td>
                        </tr>
                    </table>

                </form>
            </div>
            <?php InsertUser(); ?>



        </div>
        <!-- content area ends -->

    </div>
    <!-- container ends-->

</body>
</head>

</html>