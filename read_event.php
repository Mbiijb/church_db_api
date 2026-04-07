<?php
require 'connect.php'; 
$flag['success'] = 0; 
$flag['data'] = array(); 
if ($res = mysqli_query($con, "SELECT * FROM events")) { 
    $flag['success'] = 1; 
    while ($row = mysqli_fetch_assoc($res)) { 
        $flag['data'][] = $row; 
    }
}
print(json_encode($flag)); 
mysqli_close($con); 
?>