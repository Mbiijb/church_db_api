//update.php
<?php
require 'connect.php';
$admissionum =$_GET["admissionum"];
$sname =$_GET["sname"];
$flag['success']=0;
if($res = mysqli_query($con,"update studentlist set sname='$sname' where
admissionum='$admissionum'"))
{
$flag['success']=1;
}
print(json_encode($flag));
mysqli_close($con);
?>

