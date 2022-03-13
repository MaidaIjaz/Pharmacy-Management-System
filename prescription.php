<?php
session_start();
include_once('connect_db.php');
$recNo= $_SESSION['rid'];
$cid=$_SESSION['cashierid'];
if(isset($_POST['tuma3']))
{
$mdname=$_POST['mdname'];
$quantity=$_POST['quantity'];
$bill1 = mysqli_query($con,  "Select ms.mdname, ms.quantity, m.price*ms.quantity as total
From medicine_sold as ms, medicine as m
Where ms.rid = '{$recNo}' and ms.mdname = m.mdname");

$bill2 = mysqli_query($con,  "Select ms.invname as inv, ms.quantity as quan, m.price*ms.quantity as total
From inventory_sold as ms, inventory as m
Where ms.rid = '{$recNo}' and ms.invname = m.invname");

      echo "<table border='1' cellpadding='5'align='center'>";
        echo "<tr><th>Name </th>  <th>Quantity</th> <th>Total price</th> </tr>";
        // loop through results of database query, displaying them in the table
        while($row = mysqli_fetch_array( $bill1 )) {
                // echo out the contents of each row into a table
                echo "<tr>";
                echo '<td>' . $row['mdname'] . '</td>';
                echo '<td>' . $row['quantity'] . '</td>';
				echo '<td>' . $row['total'] . '</td>';
				$total_bill += $row['total'];
				$quan = $row['quantity'];
				$mdna = $row['mdname'];
				$bill4 = mysqli_query($con,  "update medicine set quantity = quantity - '$quan' where mdname = '$mdna'");
}
 echo "</table>";
 echo "<table border='1' cellpadding='5'align='center'>";
        echo "<tr><th>Name </th>  <th>Quantity</th> <th>Total price</th> </tr>";
        // loop through results of database query, displaying them in the table
        while($row = mysqli_fetch_array( $bill2 )) {
                // echo out the contents of each row into a table
                echo "<tr>";
                echo '<td>' . $row['inv'] . '</td>';
                echo '<td>' . $row['quan'] . '</td>';
				echo '<td>' . $row['total'] . '</td>';
				$total_bill += $row['total'];
				$quan1 = $row['quantity'];
				$mdna1 = $row['mdname'];
				$bill5 = mysqli_query($con,  "update inventory set quantity = quantity -  '$quan1' where invname = '$mdna1'");
}
 echo "</table>";
 echo "Total Bill: ".$total_bill;
 $bill3 = mysqli_query($con,  "update receipt set bill = '$total_bill' where rid = '{$recNo}'");

}
?>