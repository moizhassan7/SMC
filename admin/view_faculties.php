<?php session_start();
include_once "links.html"; // Assuming this includes Bootstrap CSS and other necessary links
include_once "../config.php"; // Assuming this connects to your database
?>
<body style="background:none;">
<div id="view" class="col-md-12 col-sm-12 col-xs-12">
<h4 style="text-align:center; color:#fff; padding-top:3%; padding-bottom:3; text-transform:uppercase;">View All Faculties</h4>

<a href="add_faculty.php">
<button type="button" class="btn btn-info" style="margin-left:20px; margin-bottom:20px;">Add New Faculty <span class="glyphicon glyphicon-plus" style="padding-left:20px;"></span></button></a>

<div class="table-responsive col-md-12 col-sm-12 col-xs-12" style="height:400px; overflow-y: auto;">
<table class="table table-bordered table-striped">
<thead>
<tr>
<th>Sr#</th>
<th>Name</th>
<th>Overview</th>
<th>Image</th>
<th>Edit</th>
<th>Delete</th>
</tr>
</thead>
<tbody>
<?php
$count = 1;
$q = mysqli_query($con, "SELECT * FROM faculties ORDER BY name ASC");
if (mysqli_num_rows($q) > 0) {
    while($row = mysqli_fetch_assoc($q)) {
?>
<tr>
<td><?php echo $count; ?></td>
<td><?php echo htmlspecialchars($row['name']); ?></td>
<td><?php echo htmlspecialchars(substr($row['overview'], 0, 100)) . (strlen($row['overview']) > 100 ? '...' : ''); ?></td>
<td>
    <?php if (!empty($row['image_url'])) { ?>
        <img src="../images/<?php echo htmlspecialchars($row['image_url']); ?>" alt="Faculty Image" style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px;">
    <?php } else { ?>
        No Image
    <?php } ?>
</td>
<td>
<a href="edit_faculty.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-sm btn-warning">
<i class="fas fa-edit"></i> Edit
</a>
</td>
<td>
<a href="del_faculty.php?id=<?php echo htmlspecialchars($row['id']);?>" class="btn btn-sm btn-danger" onClick="return confirm('Are you sure you want to permanently delete this faculty and its associated departments?');">
<i class="fas fa-trash-alt"></i> Delete
</a>
</td>
</tr>
<?php
        $count++;
    }
} else {
    echo '<tr><td colspan="6" class="text-center">No faculties found.</td></tr>';
}
?>
</tbody>
</table>
</div>
</div>
</body>
</html>