<?php
include_once "../config.php";
if(isset($_POST['id']))
{
$id = mysqli_real_escape_string($con,strval($_POST['id']));
//upload first img 
$allowedExts = array("gif", "jpeg", "jpg", "png", "JPG" );
$temp = explode(".", $_FILES["img"]["name"]);
$extension = end($temp);
if ((($_FILES["img"]["type"] == "image/gif")
|| ($_FILES["img"]["type"] == "image/jpeg")
|| ($_FILES["img"]["type"] == "image/jpg")
|| ($_FILES["img"]["type"] == "image/pjpeg")
|| ($_FILES["img"]["type"] == "image/x-png")
|| ($_FILES["img"]["type"] == "image/png"))
&& ($_FILES["img"]["size"] < 15000000)
&& in_array($extension, $allowedExts))
  {
	  	  
  if ($_FILES["img"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["img"]["error"] . "<br>";
    }
  else
    {

$folder="../images/";

$temp = explode(".", $_FILES['img']["name"]);
$rand=rand(111,999);
$today=date('siHYmd');
$ntoday=$today.$rand;
$newfilename = $ntoday.'.'.end($temp);
move_uploaded_file($_FILES['img']["tmp_name"], $folder.$newfilename);
$img=$newfilename;
//end uploading	
$q="UPDATE slider SET image='$img' where id='$id'";
$r=mysqli_query($con,$q);

if($r)
{
	header('location:view_slider.php');
	}}}
else
{
	
	echo "Error";
	}
	
}
?>