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
$inv=$_POST['sname'];
$des=$_POST['sdescription'];
 
// get value of id that sent from address bar
$user=$_POST['username'];

// Retrieve data from database 
$sql1 = mysqli_query($con, "UPDATE supplier SET sname='$inv',
sdescription='$des' WHERE sname='$inv'");
if($sql1>0) {header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/admin_supplier.php");
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
    <h4>Manage Supplier</h4> 
<hr/>	
    <div class="tabbed_area">  
      
        <ul class="tabs">  
            <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">Update Supplier</a></li>  
              
        </ul>  
          
        <div id="content_1" class="content">  
		<?php echo $message1;?>
		
       <form name="myform" onsubmit="return validateForm(this);" action="update_supplier.php" method="post" >
			<table width="420" height="106" border="0" >	
				<tr><td align="center"><input name="sname" type="text" style="width:170px" placeholder="Supplier Name" value="<?php include_once('connect_db.php'); echo $_GET['sname'];?>" id="sname" /></td></tr>
				<tr><td align="center"><input name="sdescription" type="text" style="width:170px" placeholder="Description" id="sdescription" value="<?php include_once('connect_db.php'); echo $_GET['sdescription']?>" /></td></tr>  
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
