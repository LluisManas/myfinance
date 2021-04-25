<?php

require_once('../scripts/config.php');
require_once('../scripts/db_connection.php');

function display_msg($msg) {
    if (isset($msg) && (!is_null($msg))) {
        echo $msg;
    }
}

function display_messages($success_msg = NULL, $error_msg = NULL) {
    if (isset($success_msg) && (!is_null($success_msg))) {
        display_msg($success_msg);
    }
    if (isset($error_msg) && (!is_null($error_msg))) {
        display_msg($error_msg);
    }
}

function display_header($title = NULL, $success_msg = NULL, $error_msg = NULL) {
    echo <<<EOD
    <html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>{$title}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" 
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" 
        crossorigin="anonymous">
    <link rel="stylesheet" href="../finance01/Styles/style.css">
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous">
    </script>
    <script type="text/javascript">
        $(function() {
            setTimeout(function() { $("#success_msg").fadeOut(1500); }, 5000)
        
        })
    </script>
</head>
<body>
EOD;
if (!is_null($success_msg) || !is_null($error_msg)) {
    echo "<div id='success_msg' class='alert alert-primary' role='alert'>";
        display_messages($success_msg, $error_msg);  
    echo "</div>";
}


}

/* function display_title($title = "", $success_msg = NULL, $error_msg = NULL) : string
{
    <<<EOD
} */
?>
