<?php

include_once('../scripts/config.php');
include_once('../scripts/db_connection.php');
include_once('../scripts/message.php');

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
}

/* function display_logs($results) {
    echo var_dump($results);
 }; */

?>