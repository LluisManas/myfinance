<?php

require_once("../scripts/config.php");
require_once("../scripts/db_connection.php");
require_once("../scripts/errors.php");


$error_message = '';

if (!isset($_COOKIE['user_id'])) {

    if (isset($_POST['email'])) {
        $username = mysqli_real_escape_string($connection, trim($_REQUEST['email']));
        $password = mysqli_real_escape_string($connection, trim($_REQUEST['password']));

        //lookup the user
        $query = sprintf("SELECT user_id, email FROM user WHERE " .
                "email='%s' AND password='%s';",
                mysqli_real_escape_string($connection, trim($_SERVER['PHP_AUTH_USER'])),
                mysqli_real_escape_string($connection, crypt(trim($_SERVER['PHP_AUTH_PW']), $_SERVER['PHP_AUTH_USER']))
            );
        
        $results = mysqli_query($connection, $query);
        
        if (mysqli_num_rows($results) == 1) {
            $result = mysqli_fetch_array($results);
            $user_id = $result['user_id'];
            setcookie('user_id', $user_id, 0);
            setcookie('username', $result['username']);
            setcookie('email', $result['email']);
            header("Location: user_dashboard.php?user_id=" . $user_id);
            exit();
        } else {
            $error_message = "Username / password are invalid";
        }
    }

}

?>