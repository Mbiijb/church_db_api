<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

require_once 'connect.php';

if (isset($_GET['email']) && isset($_GET['amount'])) {
    $email = mysqli_real_escape_string($con, $_GET['email']);
    $amount = mysqli_real_escape_string($con, $_GET['amount']);
    $category = mysqli_real_escape_string($con, $_GET['category']);

    $sql = "INSERT INTO giving_records (user_email, category, amount) 
            VALUES ('$email', '$category', '$amount')";

    if (mysqli_query($con, $sql)) {
        echo json_encode(['success' => 1, 'message' => 'Giving recorded successfully']);
    } else {
        echo json_encode(['success' => 0, 'message' => mysqli_error($con)]);
    }
} else {
    echo json_encode(['success' => 0, 'message' => 'Missing parameters']);
}
mysqli_close($con);
?>