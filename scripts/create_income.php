<?php

require_once('../scripts/config.php');
require_once('../scripts/db_connection.php');


$name = trim($_REQUEST['name']);
$amount = trim($_REQUEST['amount']);
$description = trim($_REQUEST['description']);
$monthly = trim($_REQUEST['monthly']);
$user_id = $_COOKIE['user_id'];
$date = date('Y-m-d H:i');

$insert_date_sql = sprintf("INSERT INTO income (inc_name, inc_amount, " .
    "inc_description, user_id, inc_monthly, inc_date) " .
    "VALUES ('%s', %d, '%s', %d, '%s', '%s');",
    mysqli_real_escape_string($connection, $name),
    mysqli_real_escape_string($connection, $amount),
    mysqli_real_escape_string($connection, $description),
    mysqli_real_escape_string($connection, $user_id),
    mysqli_real_escape_string($connection, $monthly),
    mysqli_real_escape_string($connection, $date));

mysqli_query($connection, $insert_date_sql)
    or handle_error("error passing dates", mysqli_error($connection));


header("Location: user_dashboard.php?success_msg=Income created successfully");
?>