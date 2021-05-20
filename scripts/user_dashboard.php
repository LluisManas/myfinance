<?php

require_once('../scripts/config.php');
require_once('../scripts/db_connection.php');
require_once('../scripts/message.php');
require_once('../scripts/navbar.php');
//require_once('../scripts/transaction_logs.php');
require_once('../scripts/total_income.php');
//require_once('../scripts/monthly_expenses.php');

if (!isset($_COOKIE['user_id'])) {
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
} else {
    $user_id = $_COOKIE['user_id'];
    $username = $_COOKIE['username'];
    $success_msg = $_REQUEST['success_msg'] ?? null;
}

//get income transaction logs
//sort and filter income table
if (!isset($_REQUEST['column'])) {
    $incomes = "SELECT inc_id, inc_name, inc_amount, inc_date " .
        "FROM income " .
        "WHERE user_id=$user_id";
    $income_logs = mysqli_query($connection, $incomes);

    if (!$income_logs) {
        handle_error("unable to get income data", mysqli_error($connection));
    } else {
        $add_class = ' class="highlight"';
        $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
    }
} else {
    $columns = array('inc_name', 'inc_amount', 'inc_date');
    $column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[2];
    $sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

    $incomes = "SELECT inc_id, inc_name, inc_amount, inc_date " .
        "FROM income WHERE user_id=$user_id" .
        " ORDER BY $column $sort_order";

    $income_logs = mysqli_query($connection, $incomes);

    if (!$income_logs) {
    handle_error("unable to get income data", mysqli_error($connection));

    } else {
        $up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
        $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
        $add_class = ' class="highlight"';
    }
}

//get expenses transaction logs

if (!isset($_REQUEST['column'])) {
    $expenses = "SELECT exp_id, exp_name, exp_amount, exp_date " .
    "FROM expenses" .
    " WHERE user_id=$user_id";

    $expenses_logs = mysqli_query($connection, $expenses);
    if (!$expenses_logs) {
        handle_error("unable to get expenses data", mysqli_error($connection));
    } else {
        $add_class = ' class="highlight"';
        $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
    }

} else {
    $columns_exp = array('exp_name', 'exp_amount', 'exp_date');
    $column = isset($_GET['column']) && in_array($_GET['column'], $columns_exp) ? $_GET['column'] : $columns_exp[2];
    $sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

    $expenses = "SELECT exp_id, exp_name, exp_amount, exp_date " .
        "FROM expenses WHERE user_id=$user_id " .
        "ORDER BY $column $sort_order";
    
    $expenses_logs = mysqli_query($connection, $expenses);

    if (!$expenses_logs) {
        handle_error("unable to get expenses data", mysqli_error($connection));
    } else {
        $up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
        $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
        $add_class = ' class="highlight"';
    }   
}

$total_income = get_total_income($connection, $user_id);
$total_expenses = get_total_expenses($connection, $user_id);
//$date = make_monthly_expenses();
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
                    <th scope="col"><a href="user_dashboard.php?column=inc_name&order=<?php echo $asc_or_desc; ?>">Name<i class="fas fa-sort<?php echo $column == 'name' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                    <th scope="col"><a href="user_dashboard.php?column=inc_amount&order=<?php echo $asc_or_desc; ?>">Amount<i class="fas fa-sort<?php echo $column == 'name' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                    <th scope="col"><a href="user_dashboard.php?column=inc_date&order=<?php echo $asc_or_desc; ?>">Date<i class="fas fa-sort<?php echo $column == 'name' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                </tr>
            </thead>
            <?php while ($row = mysqli_fetch_assoc($income_logs)): ?>
            <tbody>
                <tr>
                    <td<?php echo $column = 'inc_name' ? $add_class : '' ;?>><a href="../scripts/transaction_card.php?trans_type=income&trans_id=<?php echo $row['inc_id']; ?>"><?php echo $row['inc_name']; ?></a</td>
                    <td<?php echo $column = 'inc_amount' ? $add_class : '' ;?>><?php echo $row['inc_amount']; ?></td>
                    <td<?php echo $column = 'inc_date' ? $add_class : '' ;?>><?php echo $row['inc_date']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div id="expenses_transaction_logs">
        <table class="table table-danger table-sm col-md-4">
            <thead class="thead-light">
                <tr>
                    <th scope="col"><a href="user_dashboard.php?column=exp_name&order=<?php echo $asc_or_desc; ?>">Name<i class="fas fa-sort<?php echo $column == 'name' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                    <th scope="col"><a href="user_dashboard.php?column=exp_amount&order=<?php echo $asc_or_desc; ?>">Amount<i class="fas fa-sort<?php echo $column == 'name' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                    <th scope="col"><a href="user_dashboard.php?column=exp_date&order=<?php echo $asc_or_desc; ?>">Date<i class="fas fa-sort<?php echo $column == 'name' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = mysqli_fetch_assoc($expenses_logs)): ?>
            <tbody>
                <tr>
                    <td<?php echo $column = 'exp_name' ? $add_class : '' ;?>><a href="../scripts/transaction_card.php?trans_type=expenses&trans_id=<?php echo $row['exp_id']; ?>"><?php echo $row['exp_name']; ?></a</td>
                    <td<?php echo $column = 'exp_amount' ? $add_class : '' ;?>><?php echo $row['exp_amount']; ?></td>
                    <td<?php echo $column = 'exp_date' ? $add_class : ''; ?>><?php echo $row['exp_date']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>