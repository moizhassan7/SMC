<?php
include_once "../config.php";
$id = mysqli_real_escape_string($con,strval($_POST['id']));
$txt = mysqli_real_escape_string($con,strval($_POST['txt']));
$image = mysqli_real_escape_string($con,strval($_POST['image']));
$q="UPDATE slider SET txt='$txt',image='$image' where id='$id'";
$r=mysqli_query($con,$q);
if($r)
{
	header('location:view_slider.php');
	}
else
{
	
	echo "Error";
	}
?>