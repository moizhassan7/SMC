<?php session_start();

include_once "../config.php";

$uname=$_POST['uname'];
$pass=$_POST['pass'];

$query="select * from admin where uname='$uname' AND pass='$pass'";
$result=mysqli_query($con, $query);
$row=mysqli_fetch_array($result);
if($row)
{
	$_SESSION['admin']=$uname;
	
	header('location:main.php');
	
	
	}
else
{
	header('location:errorlogin.php');
	
	}


?>