<?php

require_once('../scripts/config.php');
require_once('../scripts/db_connection.php');
require_once('../scripts/errors.php');

$email = trim($_REQUEST['email']);
$username = trim($_REQUEST['username']);
$password = trim($_REQUEST['password']);

$insert_user_sql = sprintf("INSERT INTO user (email, username, password)" .
    "VALUES ('%s', '%s', '%s');",
    mysqli_real_escape_string($connection, $email),
    mysqli_real_escape_string($connection, $username),
    mysqli_real_escape_string($connection, crypt($password, $username))
);

mysqli_query($connection, $insert_user_sql)
    or handle_error("There was a problem while creating the user account", mysqli_error($connection));

$user_id = mysqli_insert_id($connection);

header("Location: user_dashboard.php?user_id=" . $user_id .
    "&success_msg=Your profile was successfully created");
?>