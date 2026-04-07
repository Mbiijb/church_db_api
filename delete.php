//delete.php
<?php
require 'connect.php';
$admissionum =$_GET["admissionum"];
$flag['success']=0;
if($res = mysqli_query($con,"delete from studentlist where
admissionum='$admissionum'"))
{
$flag['success']=1;
}
print(json_encode($flag));
mysqli_close($con);
?>

