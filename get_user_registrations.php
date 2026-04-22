<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
require_once 'connect.php';

// Get the email from the Flutter GET request
$email = $_GET['email'];

// Query to get event details ONLY for the events this user registered for
$sql = "SELECT e.* FROM events e 
        INNER JOIN event_registration r ON e.id = r.event_id 
        WHERE r.user_email = '$email'";

$result = mysqli_query($con, $sql);
$records = array();

while($row = mysqli_fetch_assoc($result)) {
    $records[] = $row;
}

echo json_encode(['success' => 1, 'data' => $records]);
?>