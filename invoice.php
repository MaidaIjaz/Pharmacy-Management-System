<?php

session_start();
include_once('connect_db.php');
$mdname=$_POST['mdname'];
	$quantity=$_POST['quantity'];
if(isset($_POST['tuma']))
{
$mdname=$_POST['mdname'];
	$quantity=$_POST['quantity'];
$t=time("r");
$user=$_SESSION['username'];
$time=date("l\, F d Y\, h:i:s A", $t);
$cid=$_SESSION['cashierid'];
$recNo=$_SESSION['rid'];
}
else
{header('Location: payment.php');
exit;}
$pay = "Cash";
$bill = 1;
$sqlP=mysqli_query($con, "INSERT INTO receipt(Date_created, payment_type,cashierid)
				VALUES(now(),'$pay','$cid')");
$_SESSION['rid'] = mysqli_insert_id($con);
if($sqlP>0) {header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/sold.php");
}else{
$message1="<font color=red>Registration Failed, Try again</font>";
echo $message1;
}

?>