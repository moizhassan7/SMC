<?php session_start();
include_once "links.html";
include_once "../config.php";
?>
<body style="background:none;">
<div id="view" class="col-md-12 col-sm-12 col-xs-12">
<h4 style="text-align:center; color:#fff; padding-top:3%; padding-bottom:3; text-transform:uppercase;">View All Departments</h4>

<a href="add_department.php">
<button type="button" class="btn btn-info" style="margin-left:20px; margin-bottom:20px;">Add New Department <span class="glyphicon glyphicon-plus" style="padding-left:20px;"></span></button></a>

<div class="table-responsive col-md-12 col-sm-12 col-xs-12" style="height:400px; overflow-y: auto;">
<table class="table table-bordered table-striped">
<thead>
<tr>
<th>Sr#</th>
<th>Faculty</th>
<th>Name</th>
<th>Overview</th>
<th>Image</th>
<th>Edit</th>
<th>Delete</th>
<th>Manage Chairman & Staff</th>
</tr>
</thead>
<tbody>
<?php
$count = 1;
// Join departments with faculties to show faculty name
$q = mysqli_query($con, "SELECT d.*, f.name as faculty_name FROM departments d JOIN faculties f ON d.faculty_id = f.id ORDER BY d.name ASC");
if (mysqli_num_rows($q) > 0) {
    while($row = mysqli_fetch_assoc($q)) {
?>
<tr>
<td><?php echo $count; ?></td>
<td><?php echo htmlspecialchars($row['faculty_name']); ?></td>
<td><?php echo htmlspecialchars($row['name']); ?></td>
<td><?php echo htmlspecialchars(substr($row['overview'], 0, 100)) . (strlen($row['overview']) > 100 ? '...' : ''); ?></td>
<td>
    <?php if (!empty($row['image_url'])) { ?>
        <img src="../images/<?php echo htmlspecialchars($row['image_url']); ?>" alt="Dept Image" style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px;">
    <?php } else { ?>
        No Image
    <?php } ?>
</td>
<td>
<a href="edit_department.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-sm btn-warning">
<i class="fas fa-edit"></i> Edit
</a>
</td>
<td>
<a href="del_department.php?id=<?php echo htmlspecialchars($row['id']);?>" class="btn btn-sm btn-danger" onClick="return confirm('Are you sure you want to permanently delete this department and all its associated chairman/staff?');">
<i class="fas fa-trash-alt"></i> Delete
</a>
</td>
<td>
    <a href="manage_chairman.php?dept_id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-sm btn-info mb-1">
        <i class="fas fa-user-tie"></i> Chairman
    </a><br>
    <a href="manage_staff.php?dept_id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-sm btn-secondary">
        <i class="fas fa-users"></i> Staff
    </a>
</td>
</tr>
<?php
        $count++;
    }
} else {
    echo '<tr><td colspan="8" class="text-center">No departments found.</td></tr>';
}
?>
</tbody>
</table>
</div>
</div>
</body>
</html>