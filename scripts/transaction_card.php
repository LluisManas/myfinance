<?php
include_once('../scripts/config.php');
include_once('../scripts/db_connection.php');
include_once('../scripts/message.php');
include_once('../scripts/navbar.php');

$trans_type = $_REQUEST['trans_type'];
$trans_id = $_REQUEST['trans_id'];

if ($trans_type == 'income') {
    $trans_info = "SELECT * FROM $trans_type WHERE inc_id=$trans_id";

    $trans_logs = mysqli_query($connection, $trans_info);

    if (!$trans_logs) {
        handle_error("No data found for this transaction", mysqli_error($connection));
    } else {    
        $row = mysqli_fetch_array($trans_logs);
        $name = $row['inc_name'];
        $amount = $row['inc_amount'] . "€";
        $description = $row['inc_description'];
        $date = $row['inc_date'];
        $category = NULL;
        $monthly = NULL;
        $image = NULL;
    }

} elseif ($trans_type == 'expenses') {
    $trans_info = "SELECT * FROM $trans_type WHERE exp_id=$trans_id";

    $trans_logs = mysqli_query($connection, $trans_info);

    if (!$trans_logs) {
        handle_error("No data found for this transaction", mysqli_error($connection));
    } else {
        $row = mysqli_fetch_array($trans_logs);
        $name = $row['exp_name'];
        $amount = "-" . $row['exp_amount'] . "€";
        $category = $row['exp_category'];
        $monthly = $row['exp_monthly'] ?? 0;
        $description = $row['exp_description'] ?? "No Data";
        $image = $row['exp_image_id'] ?? "No reciept";
        $date = $row['exp_date'];
    
        if ($monthly == 1) {
            $monthly = "Yes";
        } else {
            $monthly = "No";
        }
    }
}



display_navbar();
display_header("Transaction Information", NULL, NULL);

?>

<div id="transaction_header" class="container">
    <div class="widget">
        <fieldset>
            <div class="row">
                <label for="name">Transaction:</label>
                <p name="name" class="col-md-3"><?php echo $name; ?></p>
            </div>
            <div class="row">
                <label for="amount">Amount:</label>
                <p name="amount" class="col-md-3"><?php echo $amount; ?></p>
            </div>
            <?php
                if ($trans_type == 'expenses') {
                    echo <<<EOD
                        <div class="row">
                            <label for="category">Category:</label>
                            <p name="category" class="col-md-3">$category</p>
                        </div>
                    EOD;
                }
            ?>
            <?php
                if ($trans_type == 'expenses') {
                    echo <<<EOD
                        <div class="row">
                            <label for="monthly">Is monthly?</label>
                            <p name="monthly" class="col-md-3">$monthly</p>
                        </div>
                     EOD;
                }
            ?>
            <div class="row">
                <label for="description">Description:</label>
                <p name="description" class="col-md-3"><?php echo $description ?></p>
            </div>
            <div class="row">
                <label for="date">Date:</label>
                <p name="date" class="col-md-3"><?php echo $date ?></p>
            </div>
            <?php
                if (!is_null($image)) {
                    echo <<<EOD
                        <div class="row">
                            <label for="reciept">Reciept:</label>
                            <p name="reciept" class="col-md-3"><?php echo $image ?></p>
                        </div>
                    EOD;
                }
            ?>
        </fieldset>
</div>
</div>
