<?php

$sername="localhost";
$usrname="root";
$pass="";
$dbname="waltonapp";

$conn=mysqli_connect($sername,$usrname,$pass,$dbname);

if (!$conn) {
	die("error".mysqli_connect_error());
}

?>