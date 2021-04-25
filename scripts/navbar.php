<?php

require_once('../scripts/config.php');
require_once('../scripts/db_connection.php');

function display_navbar() {
    echo <<<EOD
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="../scripts/user_dashboard.php">Home <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="../scripts/expenses_form.php">Expenses</a>
                <a class="nav-item nav-link" href="../scripts/income_form.php">Income</a>
                <a class="nav-item nav-link" href="../scripts/sign_out.php">Log out</a>
            </div>
        </div>
    </nav>
EOD;
}
?>