<?php include_once "config.php"; ?>
<!DOCTYPE html>
<html lang="Eng">
<head>
    <title>Fresh Mind Talent Overseas Promoters</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Fresh Mind Talent, Overseas Promoters" />
    <script>
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/zoomslider.css" rel='stylesheet' type='text/css' />
    <link href="css/style6.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/fontawesome-all.css" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
</head>
<body>
<?php
if(isset($_POST['submits']))
{
$date=date('d-m-Y');

//make the allowed extensions

  $goodExtensions = array(

  '.doc',

  '.docx',

  ); 

  $error='';

  //set the current directory where you wanna upload the doc/docx files

  $uploaddir = 'cv/';

  $name = $_FILES['myfile']['name'];//get the name of the file that will be uploaded

  $min_filesize=2;//set up a minimum file size(a doc/docx can't be lower then 2 bytes)

  $stem=substr($name,0,strpos($name,'.'));

  //take the file extension

  $extension = substr($name, strpos($name,'.'), strlen($name)-1);

  //verify if the file extension is doc or docx

   if(!in_array($extension,$goodExtensions))

     $error.='Extension not allowed<br>';

echo "<span> </span>"; //verify if the file size of the file being uploaded is greater then 1

   if(filesize($_FILES['myfile']['tmp_name']) < $min_filesize)

     $error.='File size too small<br>'."\n";

  $uploadfile = $uploaddir . $stem.$extension;

$myfile=$stem.$extension;

if ($error=='')
{

//upload the file to

$temp = explode(".", $_FILES['myfile']["name"]);
$rand=rand(111,999);
$today=date('siHYmd');
$ntoday=$today.$rand;
$newfilename = $ntoday.'.'.end($temp);
if (move_uploaded_file($_FILES['myfile']["tmp_name"], $uploaddir.$newfilename)){
$cv=$newfilename;

$q=mysqli_query($con,"insert into cvz values('','$date','$cv')");
if($q)
{
?>
<script>
alert("Thanks, Your CV Uploaded Successfully.");
</script>
<?php 
}
}
}
else
{
?>
<script>
alert("Invalid File. Only .doc and .docx file is valid.");
</script>
<?php 
}
}
?>