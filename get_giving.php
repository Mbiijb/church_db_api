<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
require_once 'connect.php';

// Check if email is provided
if (!isset($_GET['email'])) {
    echo json_encode(['success' => 0, 'message' => 'Email is required']);
    exit;
}

$email = mysqli_real_escape_string($con, $_GET['email']);
$sql = "SELECT * FROM giving_records WHERE user_email = '$email' ORDER BY date_created DESC";
$result = mysqli_query($con, $sql);

$records = [];
if ($result) {
    while($row = mysqli_fetch_assoc($result)) {
        $records[] = $row;
    }
    echo json_encode(['success' => 1, 'data' => $records]);
} else {
    echo json_encode(['success' => 0, 'message' => mysqli_error($con)]);
}
?>