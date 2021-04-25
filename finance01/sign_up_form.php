<?php

require_once('../scripts/db_connection.php');
require_once('../scripts/config.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" 
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" 
        crossorigin="anonymous">
    <link rel="stylesheet" href="Styles/style.css">
</head>
<body>
    <div id="header" class="container">
        <h2 class="text-center">Sign In</h2>
        <p>Add your details below in order to start planning your finances</p>
    </div>

    <div id="sign_up_contents" class="container">
        <form action="../scripts/create_user.php" method="POST" role="horizontal-form">
            <fieldset>
                <div class="form-group">
                    <label for="email">Email:</label><br />
                    <input type="text" class="form-control" name="email" /><br />
                    <label for="username">Username:</label><br />
                    <input type="text" class="form-control" name="username" /><br />
                    <label for="password">Password:</label><br />
                    <input type="password" class="form-control" name="password" />
                </div>
            </fieldset>
            <fieldset>
                <input class="btn btn-primary" type="submit" value="Create Profile" />
                <button class="btn btn-outline-secondary" href="index.httml">Cancel</button>
            </fieldset>
        </form>
    </div>

</body>
</html>