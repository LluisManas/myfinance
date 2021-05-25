<?php

require_once('../scripts/config.php');
require_once('../scripts/db_connection.php');
require_once('../scripts/message.php');

$date = '04';
$initial_date = '2021-' . $date . '-01';
$end_date = '2021-' . $date . '-31';
$user_id = 15;
var_dump($initial_date, $end_date);

function filter_by_date($initial_date, $end_date) {

    
    $get_filtered_dates = "SELECT inc_name FROM income WHERE user_id = $user_id";

    $filtered_dates_sql = mysqli_query($connection, $get_filtered_dates);

    if (!$filtered_dates_sql) {
        handle_error('Unable to get that range of data', mysqli_error($connection));
    } else {
        while ($row = mysqli_fetch_array($filtered_dates_sql)) {
            var_dump($row);
        }
    }

}
filter_by_date($initial_date, $end_date);

?>