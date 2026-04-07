<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

require_once 'connect.php';

// Verify that the required parameters were sent
if (isset($_GET['current_phone'])) {
    // Sanitize data
    $current_phone = mysqli_real_escape_string($con, $_GET['current_phone']);
    $fname = mysqli_real_escape_string($con, $_GET['fname']);
    $lname = mysqli_real_escape_string($con, $_GET['lname']);
    $email = mysqli_real_escape_string($con, $_GET['email']);
    $new_phone = mysqli_real_escape_string($con, $_GET['phone']);

    // Base SQL update query
    $sql = "UPDATE users SET fname='$fname', lname='$lname', email='$email', phone='$new_phone'";

    // Only update the password if the user actually typed a new one
    if (!empty($_GET['password'])) {
        $password = md5($_GET['password']); 
        $sql .= ", password='$password'";
    }

    $sql .= " WHERE phone='$current_phone'";

    // Execute query
    if (mysqli_query($con, $sql)) {
        echo json_encode(['success' => 1, 'code' => 1, 'message' => 'Profile updated successfully']);
    } else {
        echo json_encode(['success' => 0, 'code' => 0, 'message' => 'Database Error: ' . mysqli_error($con)]);
    }
} else {
    echo json_encode(['success' => 0, 'code' => 0, 'message' => 'Missing identifying parameters.']);
}
mysqli_close($con);
?>