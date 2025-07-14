<?php
include_once "../config.php";

$id=$_POST['id'];

$name=$_POST['name'];
$email=$_POST['email'];
$uname=$_POST['uname'];
$pass=$_POST['pass'];

$q="UPDATE admin SET name='$name', email='$email', pass='$pass', uname='$uname' where id='$id'";
$r=mysqli_query($con,$q);

if($r)
{
	header('location:myprofile.php');
	}
else
{
	
	echo "Error";
	}
?>