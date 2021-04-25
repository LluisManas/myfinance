<?php

require_once('../scripts/config.php');
require_once('../scripts/db_connection.php');
require_once('../scripts/navbar.php');
require_once('../scripts/message.php');

display_header("Expenses Form", NULL, NULL);
display_navbar();
?>

<div id="expenses_header" class="container">
    <section>
        <form id="expenses_form" action="create_expenses.php" method="POST" enctype="multipart/form-data">
            <fieldset>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="expenses_text" name="name" value="" class="form-control col-md-5" required/>
                    <label for="amount">Amount:</label>
                    <input type="number" name="amount" id="expenses_amount" value="" class="form-control col-md-5" required/>
                    <label for="category">Category:</label><br />
                    <select class="custom-select col-md-5" name="category" required>
                        <option selected>Choose a Category</option>
                        <option value="groceries">groceries</option>
                        <option value="delivery">delivery</option>
                        <option value="rent">rent</option>
                        <option value="health insurance">health insurance</option>
                        <option value="transportation">transportation</option>
                        <option value="others">others</option>
                    </select><br /><br />
                    <label for="monthly">Monthly Payment:</label>
                    <input type="checkbox" name="monthly" id="expenses_monthly" value="1" class="form-check" /><br />
                    <label for="description">Description:</label>
                    <textarea name="description" id="expenses_description" value="" class="form-control col-md-5"></textarea><br />
                    <div class="custom-file col-md-5">
                        <input type="file" name="expenses_image" class="custom-file-input" id="expenses_image">
                        <label class="custom-file-label" for="expenses_image">Upload Reciept</label>
                    </div>
                    <br/>
                    <input type="submit" id="submit_header" class="btn btn-primary submit_header" value="Submit" />
                    <button class="btn btn-outline-secondary submit_header">
                        <a href="../scripts/user_dashboard.php">Cancel</a>
                    </button>
                </div>
            </fieldset>
        </form>
    </section>
</div>

