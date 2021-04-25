<?php

require_once('../scripts/config.php');
require_once('../scripts/db_connection.php');
require_once('../scripts/message.php');

function get_total_income ($connection, $user_id) {
    $income = "SELECT inc_amount FROM income WHERE user_id=$user_id";

    $income_sql = mysqli_query($connection, $income);

    $total_income = 0;

    if (!$income_sql) {
        handle_error('unable to load incomes', mysqli_error($connection));
    } else {
        while ($row = mysqli_fetch_array($income_sql)) {
            $total_income += $row['inc_amount'];
        }
    }
    return $total_income;
}

function get_total_expenses ($connection, $user_id) {
    $expenses = "SELECT exp_amount FROM expenses WHERE user_id=$user_id";

    $expenses_sql = mysqli_query($connection, $expenses);

    $total_expenses = 0;

    if (!$expenses_sql) {
        handle_error("Unable to load your expenses", mysqli_error($connection));
    } else {
        while ($row = mysqli_fetch_array($expenses_sql)) {
            $total_expenses += $row['exp_amount'];
        }
    }
    return $total_expenses;
}
?>