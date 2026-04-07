<?php
$con = mysqli_connect("localhost", "root", "", "church_db");

if (!$con) {
    // If this fails, it explains why you see nothing
    die(json_encode(["success" => 0, "message" => "Connection failed: " . mysqli_connect_error()]));
}
?>