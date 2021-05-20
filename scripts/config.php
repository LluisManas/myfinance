<?php

define('DEBUG_MODE', true);
define('SITE_ROOT', '/finance01/');
define('HOST_WWW_ROOT', 'C:/xampp/htdocs/finance01/');
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DB', 'finance01');

function print_dev_error($message) {
    if ('DEBUG_MODE') {
        echo $message;
    }
}

function handle_error($user_error_msg, $system_error_msg) {
    header("Location: errors.php?" .
        "user_error_msg={$user_error_msg}$" .
        "system_error_msg={$system_error_msg}");
    exit();
}

?>