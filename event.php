<?php
require 'connect.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
$flag['success'] = 0;
$flag['data'] = array();

if ($res = mysqli_query($con, "select * from events")) {
$flag['success'] = 1;

while ($row = mysqli_fetch_assoc($res)) {
$flag['data'][] = $row;
}
}
print(json_encode($flag));
mysqli_close($con);
?>