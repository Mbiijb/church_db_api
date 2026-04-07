//create.php
<?php
require 'connect.php';
$admissionum =$_GET["admissionum"];
$sname =$_GET["sname"];
$flag['success']=0;
if($res = mysqli_query($con,"insert into studentlist
values('','$admissionum','$sname',now())"))
{
$flag['success']=1;
}
print(json_encode($flag));
mysqli_close($con);
?>