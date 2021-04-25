<?php

include_once('../scripts/config.php');
include_once('../scripts/db_connection.php');
include_once('../scripts/errors.php');
include_once('../scripts/message.php');


$image_fieldname = "expenses_image";

$php_errors = array(1 => "Maximum file size in php.ini exceed",
                    2 => "Maximum file size in HTML form exceed",
                    3 => "Only part of the file was uploaded",
                    4 => "No file was selected to upload.");

//get data from expenses form
$exp_name = trim($_REQUEST['name']);
$exp_amount = trim($_REQUEST['amount']);
$exp_category = trim($_REQUEST['category']);
$exp_monthly = trim($_REQUEST['monthly']);
$exp_description = trim($_REQUEST['description']);

if ($_FILES[$image_fieldname]['size'] !== 0) {
    //Get exp_image data
    ($_FILES[$image_fieldname]['error'] == 0)
        or handle_error("Server reported an error while trying to upload your image.",
            $php_errors[$_FILES[$image_fieldname]['error']]);

    //prevent possible "hacks" with specify name files
    @is_uploaded_file($_FILES[$image_fieldname]['tmp_name'])
        or handle_error("You are trying to do something naughty.. Not going to work!",
            "Uploaded request: file named " .
            "{$_FILES[$image_fieldname]['tmp_name']}");

    //Verify that the file is and image
    @getimagesize($_FILES[$image_fieldname]['tmp_name'])
        or handle_error("You are trying to upload a file." .
            "{$_FILES[$image_fieldname]['tmp_name']} is not an image.");

    //name the image file with a unique name (time)
    $now = time();
    while (file_exists($upload_filename = $upload_dir . $now . '-' .
            $_FILES[$image_fieldname]['name'])) {
                $now++;
            }

    //let's prepare the image info to store in DB.
    $image = $_FILES[$image_fieldname];
    $image_filename = $image['name'];
    //getimagesize dont return the size itself but an array with the heigh and with
    $image_info = getimagesize($image['tmp_name']);
    $image_mime_type = $image_info['mime'];
    //now get the actual image size from the original image-related array
    $image_size = $image['size'];
    //this function retrieves the objects data in binary form
    $image_data = file_get_contents($image['tmp_name']);

    $insert_image_sql = sprintf("INSERT INTO images (image_name, mime_type, image_size, image_data)" .
        "VALUES ('%s', '%s', %d, '%s');",
        mysqli_real_escape_string($connection, $image_filename),
        mysqli_real_escape_string($connection, $image_mime_type),
        mysqli_real_escape_string($connection, $image_size),
        mysqli_real_escape_string($connection, $image_data)
    );

    mysqli_query($connection, $insert_image_sql)
        or handle_error("There was a problem uploading the reciept", mysqli_error($connection));
    
    $image_id = mysqli_insert_id($connection);
}

$user_id = $_COOKIE['user_id'];
$exp_date = date('Y-m-d H:i');

$insert_expenses_sql = sprintf("INSERT INTO expenses (exp_name, exp_amount, exp_category, exp_monthly, " .
    "exp_description, exp_image_id, user_id, exp_date)" .
    "VALUES ('%s', %d, '%s', '%s', '%s', %d, %d, '%s');",
    mysqli_real_escape_string($connection, $exp_name),
    mysqli_real_escape_string($connection, $exp_amount),
    mysqli_real_escape_string($connection, $exp_category),
    mysqli_real_escape_string($connection, $exp_monthly),
    mysqli_real_escape_string($connection, $exp_description),
    mysqli_real_escape_string($connection, $image_id),
    mysqli_real_escape_string($connection, $user_id),
    mysqli_real_escape_string($connection, $exp_date)
);

mysqli_query($connection, $insert_expenses_sql)
    or handle_error("There was a problem creating the expense", mysqli_error($connection));

header("Location: user_dashboard.php?success_msg=Expense successfully created");
    die(mysqli_error($connection));
?>