<?php session_start();
include_once "links.html";
include_once "../config.php";

$dept_id = isset($_GET['dept_id']) ? intval($_GET['dept_id']) : 0;

if ($dept_id == 0) {
    header("Location: view_departments.php");
    exit();
}

// Fetch department name for display
$dept_q = mysqli_query($con, "SELECT name FROM departments WHERE id = $dept_id");
$dept_name = mysqli_fetch_assoc($dept_q)['name'] ?? 'Unknown Department';

// Fetch staff members for this department
$staff_q = mysqli_query($con, "SELECT * FROM staff_members WHERE department_id = $dept_id ORDER BY name ASC");
?>
<body style="background:none;">
<div id="view" class="col-md-12 col-sm-12 col-xs-12">
<h4 style="text-align:center; color:#fff; padding-top:3%; padding-bottom:3; text-transform:uppercase;">Manage Staff Members for <?= htmlspecialchars($dept_name) ?></h4>

<a href="add_staff.php?dept_id=<?= htmlspecialchars($dept_id) ?>">
<button type="button" class="btn btn-info" style="margin-left:20px; margin-bottom:20px;">Add New Staff Member <span class="glyphicon glyphicon-plus" style="padding-left:20px;"></span></button></a>
<a href="view_departments.php" class="btn btn-secondary" style="margin-left:10px; margin-bottom:20px;">Back to Departments</a>


<div class="table-responsive col-md-12 col-sm-12 col-xs-12" style="height:400px; overflow-y: auto;">
<table class="table table-bordered table-striped">
<thead>
<tr>
<th>Sr#</th>
<th>Picture</th>
<th>Name</th>
<th>Designation</th>
<th>Details</th>
<th>Edit</th>
<th>Delete</th>
</tr>
</thead>
<tbody>
<?php
$count = 1;
if (mysqli_num_rows($staff_q) > 0) {
    while($row = mysqli_fetch_assoc($staff_q)) {
?>
<tr>
<td><?php echo $count; ?></td>
<td>
    <?php if (!empty($row['image_url'])) { ?>
        <img src="../images/<?php echo htmlspecialchars($row['image_url']); ?>" alt="Staff Image" style="width: 70px; height: 70px; object-fit: cover; border-radius: 50%;">
    <?php } else { ?>
        No Image
    <?php } ?>
</td>
<td><?php echo htmlspecialchars($row['name']); ?></td>
<td><?php echo htmlspecialchars($row['designation']); ?></td>
<td><?php echo htmlspecialchars(substr($row['details'], 0, 100)) . (strlen($row['details']) > 100 ? '...' : ''); ?></td>
<td>
<a href="edit_staff.php?id=<?php echo htmlspecialchars($row['id']); ?>&dept_id=<?= htmlspecialchars($dept_id) ?>" class="btn btn-sm btn-warning">
<i class="fas fa-edit"></i> Edit
</a>
</td>
<td>
<a href="del_staff.php?id=<?php echo htmlspecialchars($row['id']);?>&dept_id=<?= htmlspecialchars($dept_id) ?>" class="btn btn-sm btn-danger" onClick="return confirm('Are you sure you want to permanently delete this staff member?');">
<i class="fas fa-trash-alt"></i> Delete
</a>
</td>
</tr>
<?php
        $count++;
    }
} else {
    echo '<tr><td colspan="7" class="text-center">No staff members found for this department.</td></tr>';
}
?>
</tbody>
</table>
</div>
</div>
</body>
</html>