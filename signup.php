<?php
// 1. Enable error reporting so you can see what's wrong in the browser/Postman
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

require_once 'connect.php';

// Check if variables are set
if (isset($_GET['fname'])) {
    // Sanitize inputs to prevent SQL errors from special characters
    $fname = mysqli_real_escape_string($con, $_GET['fname']);
    $lname = mysqli_real_escape_string($con, $_GET['lname']);
    $email = mysqli_real_escape_string($con, $_GET['email']);
    $phone = mysqli_real_escape_string($con, $_GET['phone']);
    $country = mysqli_real_escape_string($con, $_GET['country']);
    $password = md5($_GET['password']); 

    // IMPORTANT: Make sure these column names (fname, lname) match your DB exactly
    $sql = "INSERT INTO users (fname, lname, email, password, phone, country) 
            VALUES ('$fname', '$lname', '$email', '$password', '$phone', '$country')";

    if (mysqli_query($con, $sql)) {
        echo json_encode(['success' => 1, 'code' => 1]);
    } else {
        // This will tell you if the table name is wrong or columns are missing
        echo json_encode([
            'success' => 0, 
            'code' => 0, 
            'message' => 'Database Error: ' . mysqli_error($con)
        ]);
    }
} else {
    echo json_encode([
        'success' => 0, 
        'code' => 0, 
        'message' => 'No data received by the server.'
    ]);
}

mysqli_close($con);
?>