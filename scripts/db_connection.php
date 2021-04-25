<?php
require_once('../scripts/config.php');

$connection = mysqli_connect(HOST, USER, PASSWORD);
if (!$connection) {
    handle_error("There was a problem while connecting to server.", mysqli_error($connection));
}

$db_connect = mysqli_select_db($connection, DB);
if (!$db_connect) {
    handle_error("There was a problem while connecting to Database.", mysqli_error($connection));
}

?>