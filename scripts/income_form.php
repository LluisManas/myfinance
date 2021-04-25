<?php

include_once('../scripts/config.php');
include_once('../scripts/db_connection.php');
include_once('../scripts/message.php');
include_once('../scripts/navbar.php');

display_header("Income Form", NULL, NULL);
display_navbar();
?>

<div id="income_header" class="container">
    <form action="create_income.php" method="POST">
        <fieldset>  
            <div class="form-group">
                <label for="name">Name:</label>
                <input name="name" value="" class="form-control col-md-5" />
                <label for="amount">Amount:</label>
                <input name="amount" value="" class="form-control col-md-5" />
                <label for="description">Description:</label>
                <textarea name="description" value="" class="form-control col-md-5"></textarea>
                <label for="monthly">Monthly:</label>
                <input type="checkbox" value="1" class="form-check" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="submit" />
                <button class="btn btn-outline-secondary"><a href="user_dashboard.php">Cancel</a></button>            
            </div> 
        </fieldset>
    </form>
</div>