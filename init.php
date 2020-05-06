     <?php
session_start();

// For Database connection  - to insert github user data into users table of petfinder database

require("connection.php");


// sample trigger to execute this code 
if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $post = http_build_query(array(
        'client_id' => '07e621826ef24f69d10c',
        'redirect_url' => 'http://localhost/webproject/init.php',
        'client_secret' => '8cb2bfd7d205c70ebf13139de855baf4f6bad878',
        'code' => $code,
    ));
    // TO verify the authentication
    $context = stream_context_create(
        array(
            "http" => array(
                "method" => "POST",
                'header' => "Content-type: application/x-www-form-urlencoded\r\n" .
                    "Content-Length: " . strlen($post) . "\r\n" .
                    "Accept: application/json",
                "content" => $post,
            )
        )
    );
    //git hub after authenticating the user is giving the user data as json output 


    $json_data = file_get_contents("https://github.com/login/oauth/access_token", false, $context);
    $r = json_decode($json_data, true);
    $access_token = $r['access_token'];
    $scope = $r['scope'];
    /*- Get User Details -*/
    $url = "https://api.github.com/user?access_token=" . $access_token . "";
    $options  = array('http' => array('user_agent' => $_SERVER['HTTP_USER_AGENT']));
    $context  = stream_context_create($options);
    $data = file_get_contents($url, false, $context);
    $user_data  = json_decode($data, true);
    $username = $user_data['login'];
    //echo $username;
    $query = "SELECT * from users where first_name='$username'";
    $result = mysqli_query($connection, $query) or die("Failed to query database" . mysqli_error($connection));
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    /*- Get User e-mail Details -*/
    $url = "https://api.github.com/user/emails?access_token=" . $access_token . "";
    $options  = array('http' => array('user_agent' => $_SERVER['HTTP_USER_AGENT']));
    $context  = stream_context_create($options);
    $emails =  file_get_contents($url, false, $context);
    $email_data = json_decode($emails, true);
    $email = $email_data[0]['email'];
    $email_primary = $email_data[0]['primary'];
    $email_verified = $email_data[0]['verified'];
    if ($result->num_rows > 0) {
        $_SESSION['users_id'] = $row['users_id'];
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];
        $_SESSION['user_image'] = $row['user_image'];
        $_SESSION['dp_value'] = $row['dp_value'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['checkgit'] = $row['checkgit'];
        header('Location:home.php');
    } else {
        $git_image = "https://github.com/" . $username . ".png";
        $query = "INSERT INTO users(first_name,last_name,email,password,user_image,dp_value,checkgit) VALUES 
('$username','$username','$email','defaultpass','$git_image',0,1)";
        $result = mysqli_query($connection, $query) or die("Failed to query database" . mysqli_error($connection));
        $query2 = "SELECT * from users where first_name='$username'";
        $result2 = mysqli_query($connection, $query2) or die("Failed to query database" . mysqli_error($connection));
        $row = mysqli_fetch_array($result2, MYSQLI_ASSOC);

        if ($result2->num_rows > 0) {
            $_SESSION['users_id'] = $row['users_id'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['user_image'] = $row['user_image'];
            $_SESSION['dp_value'] = $row['dp_value'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['checkgit'] = $row['checkgit'];
            header('Location:home.php');
        } else {
            echo "fail";
        }
    }
}
?>