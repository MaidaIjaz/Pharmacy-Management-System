<?php
session_start();
include_once('connect_db.php');
$recNo= $_SESSION['rid'];
$cid=$_SESSION['cashierid'];
if(isset($_POST['tuma1']))
{
$mdname=$_POST['mdname'];
$quantity=$_POST['quantity'];
$sql=mysqli_query($con, "INSERT INTO medicine_sold(mdname,rid,quantity)
				VALUES('$mdname','$recNo','$quantity')");
if($sql>0) {header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/sold.php");
}else{
$message1="<font color=red>Registration Failed, Try again</font>";
echo $message1;
}
}

if(isset($_POST['tuma2']))
{
$mdname=$_POST['invname'];
$quantity=$_POST['quantity'];
$sql=mysqli_query($con, "INSERT INTO inventory_sold(invname,rid,quantity)
				VALUES('$mdname','$recNo','$quantity')");
if($sql>0) {header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/sold.php");
}else{
$message1="<font color=red>Registration Failed, Try again</font>";
echo $message1;
}
}

?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $user;?> -  Pharmacy Sys</title>
<link rel="stylesheet" type="text/css" href="style/mystyle.css">
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" /> 
<link rel="stylesheet" href="style/table.css" type="text/css" media="screen" /> 
<script src="js/function.js" type="text/javascript"></script>
<script type="text/javascript" SRC="js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" SRC="js/superfish/hoverIntent.js"></script>
	<script type="text/javascript" SRC="js/superfish/superfish.js"></script>
	<script type="text/javascript" SRC="js/superfish/supersubs.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){ 
			$("ul.sf-menu").supersubs({ 
				minWidth:    12, 
				maxWidth:    27, 
				extraWidth:  1    
								  
			}).superfish();
							
		}); 
	</script>
	<script SRC="js/cufon-yui.js" type="text/javascript"></script>
	<script SRC="js/Liberation_Sans_font.js" type="text/javascript"></script>
	<script SRC="js/jquery.pngFix.pack.js"></script>
	<script type="text/javascript">
		Cufon.replace('h1,h2,h3,h4,h5,h6');
		Cufon.replace('.logo', { color: '-linear-gradient(0.5=#FFF, 0.7=#DDD)' }); 
	</script>
   <style>#left-column {height: 477px;}
 #main {height: 500px;}
</style>
</head>
<body>
<div id="content">
<div id="header">
<h1><a href="#"><img src="images/hd_logo.jpg"></a> Pharmacy Sys</h1></div>
<div id="left_column">
<div id="button">
		<ul>
			<li><a href="cashier.php">Dashboard</a></li>
			<li><a href="payment.php"target="_top">Process payment</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>	
</div>
</div>
<div id="main">
-- <div id="tabbed_box" class="tabbed_box">  
    <h4> Manage Payments</h4> 
<hr/>	
    <div class="tabbed_area">  
      
        <ul class="tabs">  
			<li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1">Add Medicine</a></li> 	
<li><a href="javascript:tabSwitch('tab_2', 'content_2');" id="tab_2">Add Inventory</a></li> 
<li><a href="javascript:tabSwitch('tab_3', 'content_3');" id="tab_3">Generate Receipt</a></li> 			
              
        </ul>  
          
       
 <script>
			$(document).ready(function()
	{
	$("#invoice_no").change(function() 
		{	
			var invoice_no=$("#invoice_no").val();
			
			
			
			if(invoice_no.length >0)		
			
				{
					$.ajax(
				{
type: "POST", url: "check.php", data: 'invoice_no='+invoice_no , success: function(msg)
									
					{  
						$("#viewer2").ajaxComplete(function(event, request, settings)
							{ 
								
										
									if(msg)
									{ 

										$(this).html(msg);
									
														
										
									} 
									else
									{
										$(this).html('<font color="red"><strong>Invoice does not exist</strong></font>');
									}
								
									 
								   
							});
					}    
				}); 
				}
	});		
	});		
		
		</script>
		
		<?php
		$_SESSION['invoice_no']=$invoice_no;
		$_SESSION['amount']=$amount;
		$_SESSION['payType']=$payType;
		$_SESSION['serial_no']=$serial_no;
		
		?>
		
        <div id="content_1" class="content"> 
		<div id="viewer1"><span id="viewer2"></span></div>
		  <form name="myform" onsubmit="return validateForm(this);" action="sold.php" method="post" >
			<table width="220" height="106" border="0" >
<tr><td><?php
				echo"<select  class=\"input-small\" name=\"mdname\" style=\"width:170px\" id=\"mdname\">";
						 $getpayType=mysqli_query($con, "SELECT mdname FROM medicine");
						 echo"<option>Select Medicine</option>";
		 while($pType=mysqli_fetch_array($getpayType))
			{
				echo"<option>".$pType['mdname']."</option>";
			}
		
		echo"</select>";?>  </td></tr>
				<tr><td ><input name="quantity" type="text" style="width:170px" placeholder="Quantity" required="required" id="quantity" /></td></tr>  
				<tr><td><input name="tuma1" id="tuma1" type="submit" value="Submit"/></td></tr>
            </table>
		</form>         
        </div>

<div id="content_2" class="content"> 
		<div id="viewer2"><span id="viewer3"></span></div>
		  <form name="myform" onsubmit="return validateForm(this);" action="sold.php" method="post" >
			<table width="220" height="106" border="0" >
<tr><td><?php
				echo"<select  class=\"input-small\" name=\"invname\" style=\"width:170px\" id=\"invname\">";
						 $getpayType=mysqli_query($con, "SELECT invname FROM inventory");
						 echo"<option>Select Inventory</option>";
		 while($pType=mysqli_fetch_array($getpayType))
			{
				echo"<option>".$pType['invname']."</option>";
			}
		
		echo"</select>";?>  </td></tr>
				<tr><td ><input name="quantity" type="text" style="width:170px" placeholder="Quantity" required="required" id="quantity" /></td></tr>  
				<tr><td><input name="tuma2" id="tuma2" type="submit" value="Submit"/></td></tr>
            </table>
		</form>         
        </div>

		<div id="content_3" class="content"> 
		<div id="viewer3"><span id="viewer4"></span></div>
		  <form name="myform" onsubmit="return validateForm(this);" action="prescription.php" method="post" >
				<p> Generate Receipt? </p>
				<tr><td><input name="tuma3" id="tuma3" type="submit" value="Yes"/></td></tr>
		</form>         
        </div>
    </div>  
</div>
</div>
<div id="footer" align="Center"> Pharmacy Sys 2013. Copyright All Rights Reserved</div>
</div>
</body>
</html>
