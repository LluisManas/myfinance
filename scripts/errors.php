<?php

require_once('../scripts/config.php');
require_once('../scripts/db_connection.php');

if (isset($_REQUEST['user_error_msg'])) {
    $user_error_msg = $_REQUEST['user_error_msg'];
} else {
    $user_error_msg = "There was a problem with your request";
}

if (isset($_REQUEST['system_error_msg'])) {
    $system_error_msg = $_REQUEST['system_error_msg'];
} else {
    $system_error_msg = "No system error was reported";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
</head>
<body>
    <div id="error_header">
        <h1>404 Page Not Found</h1>
    </div>

    <div id="error_content">
        <h5><?php echo $user_error_msg; ?></h5>
        <p>We are sorry for the inconvinience. We have been reported about the error and we will take action asap.</p>
        <?php
            print_dev_error("<br />");
            print_dev_error("There was an error while developing. Error found: $system_error_msg");
        ?>
    </div>
</body>
</html>