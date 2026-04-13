<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
require_once 'connect.php';

if (isset($_GET['email']) && isset($_GET['event_id'])) {
    $email = mysqli_real_escape_string($con, $_GET['email']);
    $event_id = mysqli_real_escape_string($con, $_GET['event_id']);

    // Check if already registered
    $check = mysqli_query($con, "SELECT * FROM event_registration WHERE user_email='$email' AND event_id='$event_id'");
    
    if (mysqli_num_rows($check) > 0) {
        echo json_encode(['success' => 0, 'message' => 'Already registered for this event']);
    } else {
        $sql = "INSERT INTO event_registration (user_email, event_id) VALUES ('$email', '$event_id')";
        if (mysqli_query($con, $sql)) {
            echo json_encode(['success' => 1, 'message' => 'Registration successful']);
        } else {
            echo json_encode(['success' => 0, 'message' => mysqli_error($con)]);
        }
    }
} else {
    echo json_encode(['success' => 0, 'message' => 'Missing parameters']);
}
mysqli_close($con);
?>