<?php
include_once "links.html";
include_once "../config.php";
?>

<div class="col-md-12 col-sm-12 col-xs-12" id="mainadd">

<div id="view" class="col-md-12 col-sm-12 col-xs-12">
<h4 style="text-align:center; text-transform:uppercase; margin-top:30px;">View Admin Profile</h4>

<div class="table-responsive col-md-12 col-sm-12 col-xs-12">
<table class="table table-bordered">

<tr>
<th>Name</th>
<th>Email</th>
<th>User Name</th>
<th>Password</th>
<th>Edit</th>

</tr>

<?php
$q="select * from admin";
$r=mysqli_query($con,$q);
while($row=mysqli_fetch_array($r))
{
?>
<form action="updateprofile.php" method="post">
<tr>

<input type="hidden" value="<?php echo $row['id']; ?>" name="id" style="border:none;background:none; text-align:center;" readonly>

<td><input type="text" value="<?php echo $row['name']; ?>" name="name" id="txt1<?php echo $row['id']; ?>" style=" height:35px;border:none;background:none; text-align:center;width:200px;" readonly></td>

<td><input type="text" value="<?php echo $row['email']; ?>" name="email" id="txt2<?php echo $row['id']; ?>" style=" height:35px;border:none;background:none; text-align:center;width:300px;" readonly></td>

<td><input type="text" value="<?php echo $row['uname']; ?>" name="uname" id="txt3<?php echo $row['id']; ?>" style=" height:35px;width:150px;border:none;background:none; text-align:center;" readonly></td>

<td><input type="text" value="<?php echo $row['pass']; ?>" name="pass" id="txt4<?php echo $row['id']; ?>" style=" height:35px;border:none;background:none;width:150px; text-align:center;" readonly></td>

<td>
<img src="img/edit.png" id="edit<?php echo $row['id']; ?>" onClick="editas('<?php echo $row['id']; ?>')" style="cursor:pointer;">
<input type="submit" value="Update" id="upa<?php echo $row['id']; ?>" class="btn btn-primary" style="display:none;"></td>

</form>
</tr>

<?php } ?>

</table>


</div>
</div>


<script>
function editas(a)
{
  document.getElementById('upa'+a).style.display="inline";
  document.getElementById('edit'+a).style.display="none";
   
  for(b=1; b<=5; b++)
  {
	  document.getElementById('txt'+b+a).readOnly=false;
	  document.getElementById('txt'+b+a).style.background="yellow";
      document.getElementById('txt'+b+a).style.color="black";
	  }
	}
</script>

