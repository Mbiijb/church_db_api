<?php
$con = mysqli_connect("localhost", "root", "", "church_db");

if (!$con) {
    die(json_encode(["success" => 0, "message" => "Connection failed: " . mysqli_connect_error()]));
}
?>