<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
require_once 'connect.php';

if (isset($_GET['email']) && isset($_GET['event_id'])) {
    $email = $_GET['email'];
    $event_id = $_GET['event_id'];

    // Check if already registered
    $stmt = $con->prepare("SELECT id FROM event_registration WHERE user_email=? AND event_id=?");
    $stmt->bind_param("si", $email, $event_id);
    $stmt->execute();
    $check = $stmt->get_result();
    
    if (mysqli_num_rows($check) > 0) {
        echo json_encode(['success' => 0, 'message' => 'Already registered for this event']);
    } else {
        $insert_stmt = $con->prepare("INSERT INTO event_registration (user_email, event_id) VALUES (?, ?)");
        $insert_stmt->bind_param("si", $email, $event_id);
        if ($insert_stmt->execute()) {
            echo json_encode(['success' => 1, 'message' => 'Registration successful']);
        } else {
            echo json_encode(['success' => 0, 'message' => $con->error]);
        }
        $insert_stmt->close();
    }
    $stmt->close();
} else {
    echo json_encode(['success' => 0, 'message' => 'Missing parameters']);
}
mysqli_close($con);
?>