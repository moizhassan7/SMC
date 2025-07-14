<?php
include_once "../config.php";
$id=$_REQUEST['id'];
$querya="delete from news_events where id='$id'";
$resulta=mysqli_query($con, $querya);
if($resulta)
{    	
header('location:view_news.php');
}	
else
{
echo "error in Updation";
}
?>