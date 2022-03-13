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
if(isset($_POST['submit'])){
$fname=$_POST['Fname'];
$lname=$_POST['Lname'];
$postal=$_POST['address'];
$email=$_POST['email'];
$phone=$_POST['phone_number'];
$username=$_POST['username'];
$pas=$_POST['password'];
 
// get value of id that sent from address bar
$user=$_POST['username'];

// Retrieve data from database 
$sql1 = mysqli_query($con, "UPDATE pharmacist SET Fname='$fname', Lname='$lname',
address='$postal',email='$email',phone_number='$phone',username='$username', password='$pas' WHERE username='$username'");
if($sql1>0) {header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/admin_pharmacist.php");
}else{
$message1="<font color=red>Update Failed, Try again</font>";
}}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php $username?> Pharmacy Sys</title>
<link rel="stylesheet" type="text/css" href="style/mystyle.css">
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" /> 
<script src="js/function.js" type="text/javascript"></script>
 <style>#left-column {height: 477px;}
 #main {height: 477px;}</style>
</head>
<body>
<div id="content">
<div id="header">
<h1><a href="#"><img src="images/hd_logo.jpg"></a> Pharmacy Sys</h1></div>
<div id="left_column">
<div id="button">
<ul>
		<li><a href="pharmacist.php">Dashboard</a></li>
			<li><a href="admin_pharmacist.php">Pharmacist</a></li>
			<li><a href="admin_cashier.php">Cashier</a></li>
			<li><a href="admin_inventory.php">Inventory</a></li>
			<li><a href="admin_medicine.php">Medicine</a></li>
			<li><a href="admin_supplier.php">Supplier</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>	
</div>
		</div>
<div id="main">
<div id="tabbed_box" class="tabbed_box">  
    <h4>Manage Users</h4> 
<hr/>	
    <div class="tabbed_area">  
      
        <ul class="tabs">  
            <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">Update User</a></li>  
              
        </ul>  
          
        <div id="content_1" class="content">  
		<?php echo $message1;?>
          <form name="myform" onsubmit="return validateForm(this);" action="update_pharmacist.php" method="post" >
			<table width="420" height="106" border="0" >	
				<tr><td align="center"><input name="Fname" type="text" style="width:170px" placeholder="First Name" value="<?php include_once('connect_db.php'); echo $_GET['Fname']?>" id="Fname" /></td></tr>
				<tr><td align="center"><input name="Lname" type="text" style="width:170px" placeholder="Last Name" id="Lname" value="<?php include_once('connect_db.php'); echo $_GET['Lname']?>" /></td></tr>
				<tr><td align="center"><input name="address" type="text" style="width:170px" placeholder="Address" id="address" value="<?php include_once('connect_db.php'); echo $_GET['address']?>" /></td></tr>  
				<tr><td align="center"><input name="email" type="email" style="width:170px" placeholder="Email" id="email"value="<?php include_once('connect_db.php'); echo $_GET['email']?>" /></td></tr>   
				<tr><td align="center"><input name="phone_number" type="text" style="width:170px" placeholder="Phone" id="phone_number" value="<?php include_once('connect_db.php'); echo $_GET['phone_number']?>" /></td></tr>  
				<tr><td align="center"><input name="username" type="text" style="width:170px" placeholder="Username" id="username"value="<?php include_once('connect_db.php'); echo $_GET['username']?>" /></td></tr>
				<tr><td align="center"><input name="password" placeholder="Password" id="password"value="<?php include_once('connect_db.php'); echo $_GET['password']?>"type="password" style="width:170px"/></td></tr>
				<tr><td align="center"><input name="submit" type="submit" value="Update"/></td></tr>
            </table>
		</form>
		</div>  
    </div>  
</div>
</div>
<div id="footer" align="Center"> Pharmacy Sys 2013. Copyright All Rights Reserved</div>
</div>
</body>
</html>
