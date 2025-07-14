<?php
// Assuming $con is your mysqli connection
$qslider = mysqli_query($con, "select * from slider where id!=1");
$qsliderb = mysqli_query($con, "select * from slider where id=1");
$rowsliderb = mysqli_fetch_array($qsliderb);
?>
<div id="demo-1" data-zs-src='[<?php $row_count = 0; while($rowslider = mysqli_fetch_array($qslider)){ if($row_count > 0) { echo ", "; } $row_count++; ?>"images/<?php echo $rowslider['image'];?>"<?php } ?>]' data-zs-overlay="dots">
</div>