<?php
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['pharmid'];
$username=$_SESSION['username'];
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
$sql1=mysqli_query($con, "SELECT * FROM medicine WHERE mdname='$inv'")or die(mysqli_error());
 $result=mysqli_fetch_array($sql1);
if($result>0){
$message="<font color=blue>Sorry  medicine already exists</font>";
 }else{
$sql=mysqli_query($con, "INSERT INTO medicine(mdname,category,description,quantity,price,mdnumber,expiry_date,supply_date,company,sid)
VALUES('$inv','$cat','$des','$qua','$pri','$mdn','$exp','$sup','$com','$sid')");
if($sql>0) {header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/admin_medicine.php");
}else{
$message1="<font color=red>Registration Failed, Try again</font>";
}
	}}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $username;?> -  Pharmacy Sys</title>
<link rel="stylesheet" type="text/css" href="style/mystyle.css">
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" /> 
<link rel="stylesheet" href="style/table.css" type="text/css" media="screen" /> 
<script src="js/function.js" type="text/javascript"></script>
<script>
function validateForm()
{

//for alphabet characters only
var str=document.form1.first_name.value;
	var valid="abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	//comparing user input with the characters one by one
	for(i=0;i<str.length;i++)
	{
	//charAt(i) returns the position of character at specific index(i)
	//indexOf returns the position of the first occurence of a specified value in a string. this method returns -1 if the value to search for never ocurs
	if(valid.indexOf(str.charAt(i))==-1)
	{
	alert("First Name Cannot Contain Numerical Values");
	document.form1.first_name.value="";
	document.form1.first_name.focus();
	return false;
	}}
	
if(document.form1.first_name.value=="")
{
alert("Name Field is Empty");
return false;
}

//for alphabet characters only
var str=document.form1.last_name.value;
	var valid="abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	//comparing user input with the characters one by one
	for(i=0;i<str.length;i++)
	{
	//charAt(i) returns the position of character at specific index(i)
	//indexOf returns the position of the first occurence of a specified value in a string. this method returns -1 if the value to search for never ocurs
	if(valid.indexOf(str.charAt(i))==-1)
	{
	alert("Last Name Cannot Contain Numerical Values");
	document.form1.last_name.value="";
	document.form1.last_name.focus();
	return false;
	}}
	

if(document.form1.last_name.value=="")
{
alert("Name Field is Empty");
return false;
}

}

</script>



   <style>#left-column {height: 477px;}
 #main {height: 477px;}
</style>
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
    <h4>Manage Medicine</h4> 
<hr/>	
    <div class="tabbed_area">  
      
        <ul class="tabs">  
            <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">View Medicine</a></li>  
            <li><a href="javascript:tabSwitch('tab_2', 'content_2');" id="tab_2">Add Medicine</a></li>  
              
        </ul>  
          
        <div id="content_1" class="content">  
		<?php echo $message;
			  echo $message1;
		/* 
		View
        Displays all data from 'Pharmacist' table
		*/
        // connect to the database
        include_once('connect_db.php');
       // get results from database
       $result = mysqli_query($con, "SELECT * FROM medicine")or die(mysql_error());
		// display data in table
        echo "<table border='1' cellpadding='5'align='center'>";
        echo "<tr> <th>ID</th><th>Name </th> <th>Category </th> <th>Description </th> <th>Price per unit </th> <th>quantity </th></tr>";
        // loop through results of database query, displaying them in the table
        while($row = mysqli_fetch_array( $result )) {
                // echo out the contents of each row into a table
                echo "<tr>";
                echo '<td>' . $row['mdid'] . '</td>';
                echo '<td>' . $row['mdname'] . '</td>';
				echo '<td>' . $row['category'] . '</td>';
				echo '<td>' . $row['description'] . '</td>';
				echo '<td>' . $row['price'] . '</td>';
				echo '<td>' . $row['quantity'] . '</td>';
				?>
				<td><a href="update_medicine.php?mdname=<?php echo $row['mdname']?>"><img src="images/update-icon.png" width="35" height="35" border="0" /></a></td>
				<td><a href="delete_medicine.php?mdid=<?php echo $row['mdid']?>"><img src="images/delete-icon.jpg" width="35" height="35" border="0" /></a></td>
				<?php
		 } 
        // close table>
        echo "</table>";
?> 
        </div>  
        <div id="content_2" class="content">  
		           <!--Pharmacist-->
				   <?php echo $message;
			  echo $message1;
			  ?>
		<form name="form1" onsubmit="return validateForm(this);" action="admin_medicine.php" method="post" >
			<table width="300" height="106" border="0" >	
				<tr><td align="left"><input name="mdname" type="text" style="width:170px" placeholder="Medicine Name" required="required" id="mdname" /></td></tr>
				<tr><td align="left"><input name="category" type="text" style="width:170px" placeholder="Category" required="required" id="category" /></td></tr>
				<tr><td align="left"><input name="description" type="text" style="width:170px" placeholder="Description" required="required" id="description" /></td></tr>   
				<tr><td align="left"><input name="quantity" type="text" style="width:170px" placeholder="Quantity" required="required" id="quantity" /></td></tr>
				<tr><td align="left"><input name="price" type="text" style="width:170px" placeholder="Price" required="required" id="price" /></td></tr>   
				<tr><td align="left"><input name="mdnumber" type="text" style="width:170px" placeholder="mdnumber" required="required" id="mdnumber" /></td></tr>   
				<tr><td align="left"><input name="expiry_date" type="date" style="width:170px" placeholder="expiry_date" required="required" id="expiry_date" <p>expiry date</p></td></tr>   
				<tr><td align="left"><input name="supply_date" type="date" style="width:170px" placeholder="supply_date" required="required" id="supply_date" <p>supply date</p></td></tr>   
				<tr><td align="left"><input name="company" type="text" style="width:170px" placeholder="company" required="required" id="company" /></td></tr>   
				<tr><td align="left"><input name="sid" type="text" style="width:170px" placeholder="sid" required="required" id="sid" /></td></tr>   
				<tr><td align="right"><input name="submit" type="submit" value="Submit"/></td></tr>
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
