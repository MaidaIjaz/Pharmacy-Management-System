<?php
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['pharmid'];
$user=$_SESSION['username'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
exit();
}
$id=$_GET['mdid'];
$sql="delete from medicine where mdid='$id'";
mysqli_query($con, "$sql") or die(mysqli_error());
//$rows=mysql_fetch_assoc($result);
header("location:admin_medicine.php");
?>


