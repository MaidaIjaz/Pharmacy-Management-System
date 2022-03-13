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
$inv=$_POST['mdname'];
$cat=$_POST['category'];
$des=$_POST['description'];
$qua=$_POST['quantity'];
$pri=$_POST['price'];
$mdn=$_POST['mdnumber'];
$exp=$_POST['expiry_date'];
$sup=$_POST['supply_date'];
$com=$_POST['company'];
$sid=$_POST['sid'];
// get value of id that sent from address bar
$user=$_POST['username'];

// Retrieve data from database 
$sql1 = mysqli_query($con, "UPDATE medicine SET mdname='$inv', category='$cat',
description='$des', quantity='$qua', price='$pri', mdnumber='$mdn', expiry_date='$exp', supply_date='$sup', company='$com', sid='$sid' WHERE mdname='$inv'");
if($sql1>0) {header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/admin_medicine.php");
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
    <h4>Manage Inventory</h4> 
<hr/>	
    <div class="tabbed_area">  
      
        <ul class="tabs">  
            <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">Update Inventory</a></li>  
              
        </ul>  
          
        <div id="content_1" class="content">  
		<?php echo $message1;?>
       <form name="myform" onsubmit="return validateForm(this);" action="update_medicine.php" method="post" >
			<table width="300" height="106" border="0" >	
				<tr><td align="left"><input name="mdname" type="text" style="width:170px" placeholder="Medicine Name" required="required" value="<?php include_once('connect_db.php'); echo $_GET['mdname'];?>"id="mdname" /></td></tr>
				<tr><td align="left"><input name="category" type="text" style="width:170px" placeholder="Category" required="required" id="category" /></td></tr>
				<tr><td align="left"><input name="description" type="text" style="width:170px" placeholder="Description" required="required" id="description" /></td></tr>   
				<tr><td align="left"><input name="quantity" type="text" style="width:170px" placeholder="Quantity" required="required" id="quantity" /></td></tr>
				<tr><td align="left"><input name="price" type="text" style="width:170px" placeholder="Price" required="required" id="price" /></td></tr>   
				<tr><td align="left"><input name="mdnumber" type="text" style="width:170px" placeholder="mdnumber" required="required" id="mdnumber" /></td></tr>   
				<tr><td align="left"><input name="expiry_date" type="date" style="width:170px" placeholder="expiry_date" required="required" id="expiry_date" <p>expiry date</p></td></tr>   
				<tr><td align="left"><input name="supply_date" type="date" style="width:170px" placeholder="supply_date" required="required" id="supply_date" <p>supply date</p></td></tr>   
				<tr><td align="left"><input name="company" type="text" style="width:170px" placeholder="company" required="required" id="company" /></td></tr>   
				<tr><td align="left"><input name="sid" type="text" style="width:170px" placeholder="sid" required="required" id="sid" /></td></tr>   
				<tr><td align="right"><input name="submit" type="submit" value="Update"/></td></tr>
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
