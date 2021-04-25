<?php

require_once('../scripts/config.php');
require_once('../scripts/db_connection.php');
require_once('../scripts/message.php');
require_once('../scripts/navbar.php');
require_once('../scripts/transaction_logs.php');
require_once('../scripts/total_income.php');

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
    $username = $_COOKIE['username'];
    $success_msg = $_REQUEST['success_msg'] ?? null;
} else {
    $user_id = $_REQUEST['user_id'];
    $success_msg = $_REQUEST['success_msg'] ?? null;

    $select_query = sprintf("SELECT * FROM user WHERE user_id = '%s'", $user_id);

    $results = mysqli_query($connection, $select_query);

    if (mysqli_num_rows($results) == 1) {
        $result = mysqli_fetch_array($results);
        $user_id = $result['user_id'];
        $username = $result['username'];
        setcookie('user_id', $user_id, 0);
        setcookie('username', $username, 0);
    } else {
        $error_msg = "There was a problem with your account";
    }
}

//get income transaction logs
$incomes = "SELECT inc_id, inc_name, inc_amount, inc_date " .
    "FROM income " .
    "WHERE user_id=$user_id";

$income_logs = mysqli_query($connection, $incomes);
/* $total = 0;

while ($row = mysqli_fetch_array($income_logs)) {
    $total += $row['inc_amount'];
} */

//get expenses transaction logs
$expenses = "SELECT exp_id, exp_name, exp_amount, exp_date " .
    "FROM expenses " .
    "WHERE user_id=$user_id";

$expenses_logs = mysqli_query($connection, $expenses);

$total_income = get_total_income($connection, $user_id);
$total_expenses = get_total_expenses($connection, $user_id);
?>

<!DOCTYPE html>
<?php echo display_header("User's Dashboard", $success_msg, $error_msg = NULL); ?>
<?php echo display_navbar(); ?>
    <div class="text-center">
        <h1><?php echo 'Welcome' . ' ' . $username; ?></h1>
        <P><?php echo date("Y-m-d H:i"); ?></p>

    </div>
    <div id="account_balance">
        <table class="table table-sm col-md-4">
            <thead class="thead">
                <tr>
                    <th scope="col">Total Income</th>
                    <th scope="col">Total Expenses</th>
                    <th scope="col">Balance</th>
                </tr> 
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $total_income . "€"; ?></td>
                    <td><?php echo "-" . $total_expenses . "€"; ?></td>
                    <td><?php echo $total_income - $total_expenses . "€"; ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div id="income_transaction_logs">
        <table class="table table-success table-sm col-md-4">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($row = mysqli_fetch_array($income_logs)) {
                    echo "<tr><th class='scope'>" . "<a href='../scripts/transaction_card.php?trans_type=income&trans_id={$row['inc_id']}'>" . 
                    $row['inc_name'] . "</a></th>" . 
                    "<td>" . $row['inc_amount'] . "€" . "</td>" . 
                    "<td>" . $row['inc_date'] . "</td>" . "</tr>";
                    }
                ?>    
            </tbody>
        </table>
    </div>

    <div id="expenses_transaction_logs">
        <table class="table table-danger table-sm col-md-4">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($row = mysqli_fetch_array($expenses_logs)) {
                    echo "<tr><th class='scope'>" . "<a href='../scripts/transaction_card.php?trans_type=expenses&trans_id={$row['exp_id']}'>" .
                    $row['exp_name'] . "</a></th>" . 
                    "<td>" . "-" . $row['exp_amount'] . "€" . "</td>" . 
                    "<td>" . $row['exp_date'] . "</td>" . "</tr>";
                    }
                ?>    
            </tbody>
        </table>
    </div>
</body>
</html>