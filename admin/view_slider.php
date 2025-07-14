<body style="background:none;">
<?php session_start();
include_once "links.html";
include_once "../config.php";
?>
<div id="view" class="col-md-12 col-sm-12 col-xs-12">
<h4 style="text-align:center; color:#fff; padding-top:3%; padding-bottom:3%; text-transform:uppercase;"> Slider</h4>

<div class="table-responsive col-md-12 col-sm-12 col-xs-12">
<table class="table table-bordered">

<tr>
<th>Sr#</th>
<th>Heading</th>
<th>2nd Heading</th>
<th>Edit</th>
</tr>

<?php
$count=1;
$q=mysqli_query($con,"select * from slider where id=1");
while($row=mysqli_fetch_array($q))
{
?>
<tr>
<form action="update_slider.php" method="post">
<input type="hidden" value="<?php echo $row['id']; ?>" name="id" readonly>
<td><?php echo $count; ?></td>

<td><textarea name="txt" id="txt1<?php echo $row['id']; ?>" style="border:none;background:none; text-align:justify; width:100%;" readonly rows="2">
<?php echo $row['txt']; ?></textarea></td>

<td><textarea name="image" id="txt2<?php echo $row['id']; ?>" style="border:none;background:none; text-align:justify; width:100%;" readonly rows="2">
<?php echo $row['image']; ?></textarea></td>

<td>
<img src="img/edit.png" id="edit<?php echo $row['id']; ?>" onClick="editas('<?php echo $row['id']; ?>')" style="cursor:pointer;">
<input type="submit" value="Update" id="upa<?php echo $row['id']; ?>" class="btn btn-primary" style="display:none; width:80px;" class="center-block">
</td>
</form>
</tr>
<?php $count++; } ?>
</table>
</div>


<div class="table-responsive col-md-12 col-sm-12 col-xs-12">
<table class="table table-bordered">

<tr>
<th>Sr#</th>
<th>Image</th>
<th width="10%">Edit Imge</th>
</tr>
<?php
$count=1;
$q=mysqli_query($con,"select * from slider where id!=1");
while($row=mysqli_fetch_array($q))
{
?>
<tr>
<td><?php echo $count; ?></td>
<td>
<img src="../images/<?php echo $row['image']; ?>" style="height:100px; width:120px;" class="center-block">
</td>

<form action="update_slider_img.php" method="post" enctype="multipart/form-data">
<input type="hidden" value="<?php echo $row['id']; ?>" name="id" style="border:none;background:none; text-align:center;" readonly>  

<td><img src="img/edit.png" id="e<?php echo $row['id']; ?>" onClick="editasimg('<?php echo $row['id']; ?>')" style="cursor:pointer;">
<input type="file" name="img" id="f<?php echo $row['id']; ?>" style="display:none;">
<input type="submit" value="Update Image" id="up<?php echo $row['id']; ?>" class="btn btn-primary" style="display:none;"></td>
</form>
</tr>

<?php $count++; } ?>

</table>


</div>
</div>



<script>
function editas(a)
{
  document.getElementById('upa'+a).style.display="inline";
  
  document.getElementById('edit'+a).style.display="none";
  
  for(b=1; b<=10; b++)
  {
	  document.getElementById('txt'+b+a).readOnly=false;
	  document.getElementById('txt'+b+a).style.background="yellow";
	  document.getElementById('txt'+b+a).style.color="black";
	  }
	}
</script>


<script>
function editasimg(b)
{
  document.getElementById('up'+b).style.display="inline";
  document.getElementById('f'+b).style.display="inline";
  document.getElementById('e'+b).style.display="none";
	}
</script>