<?php

error_reporting (E_ALL ^ E_NOTICE ^ E_WARNING);
$con=mysqli_connect('localhost','root','35176573')or die("cannot connect to server");
mysqli_select_db($con, 'project')or die("cannot connect to database");

?>