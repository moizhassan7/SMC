<?php session_start();
include_once "links.html";
include_once "../config.php";

$staff_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$dept_id = isset($_GET['dept_id']) ? intval($_GET['dept_id']) : 0; // Pass department ID back

if ($staff_id == 0 || $dept_id == 0) {
    header("Location: view_departments.php"); // Or appropriate fallback
    exit();
}

$q = mysqli_query($con, "SELECT * FROM staff_members WHERE id = $staff_id");
$staff = mysqli_fetch_assoc($q);

if (!$staff) {
    header("Location: manage_staff.php?dept_id=" . $dept_id);
    exit();
}

// Fetch department name for display
$dept_q = mysqli_query($con, "SELECT name FROM departments WHERE id = $dept_id");
$dept_name = mysqli_fetch_assoc($dept_q)['name'] ?? 'Unknown Department';
?>
<body style="background:none;">
<link rel="stylesheet" type="text/css" href="css/style.css">

<div class="col-md-12 col-sm-12 col-xs-12" id="mainadd">

<div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3" id="adddata">

<h3 style="text-align:center; ">Edit Staff Member for <?= htmlspecialchars($dept_name) ?></h3>

<form action="update_staff.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?= htmlspecialchars($staff['id']) ?>" />
<input type="hidden" name="department_id" value="<?= htmlspecialchars($dept_id) ?>" />

<div class="form-group">
     <label for="staffName">Staff Member Name</label>
    <input type="text" class="form-control" name="name" id="staffName" value="<?= htmlspecialchars($staff['name']) ?>" placeholder="e.g., Dr. John Doe" required/>
</div>

<div class="form-group">
     <label for="staffDesignation">Designation</label>
    <input type="text" class="form-control" name="designation" id="staffDesignation" value="<?= htmlspecialchars($staff['designation']) ?>" placeholder="e.g., Professor, Lecturer" required/>
</div>

<div class="form-group">
     <label for="staffDetails">Details</label>
    <textarea class="form-control" name="details" id="staffDetails" rows="5" placeholder="e.g., Qualifications, areas of expertise, contact info."><?= htmlspecialchars($staff['details']) ?></textarea>
</div>

<div class="form-group">
     <label for="staffImage">Staff Picture</label>
    <?php if (!empty($staff['image_url'])): ?>
        <img src="../images/<?= htmlspecialchars($staff['image_url']) ?>" alt="Current Staff Picture" style="width: 150px; height: auto; margin-bottom: 10px;" /><br>
        <label><input type="checkbox" name="delete_image" value="1"> Delete current picture</label><br>
    <?php else: ?>
        <p class="text-muted">No picture uploaded.</p>
    <?php endif; ?>
    <input type="file" class="form-control" name="image_url" id="staffImage" accept="image/*" />
    <small class="form-text text-muted">Upload a new picture to replace the current one.</small>
</div>
    
<div class="form-group">
    <input type="submit" class="btn btn-primary" value="Update Staff Member" style="margin-bottom:20px;">  
    <a href="manage_staff.php?dept_id=<?= htmlspecialchars($dept_id) ?>" class="btn btn-secondary">Back to Staff List</a>
</div>
</form>
</div>
</body>
</html>