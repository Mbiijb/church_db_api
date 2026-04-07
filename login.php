<?php
// Allow any origin to access this script (Fixes the "Failed to fetch" error)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header('Content-Type: application/json');

// Handle preflight "OPTIONS" request from Chrome
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit;
}

require_once 'connect.php';

// Check if data is provided in the URL (GET) 
if (isset($_GET['phone']) && isset($_GET['password'])) {

    $phone = $_GET['phone'];
    $password = md5($_GET['password']);

    $sql = "SELECT * FROM users WHERE phone = '$phone' AND password = '$password'";
    $query = mysqli_query($con, $sql);

    if (mysqli_num_rows($query) > 0) {
        $rows = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $rows[] = $row;
        }
        echo json_encode(['success' => 1, 'code' => 1, 'userdetails' => $rows]);
    } else {
        echo json_encode(['success' => 0, 'code' => 0, 'message' => 'Invalid credentials']);
    }
}
mysqli_close($con);
?>