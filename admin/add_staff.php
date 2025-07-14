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
?>
<body style="background:none;">
<link rel="stylesheet" type="text/css" href="css/style.css">

<div class="col-md-12 col-sm-12 col-xs-12" id="mainadd">

<div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3" id="adddata">

<h3 style="text-align:center; ">Add New Staff Member for <?= htmlspecialchars($dept_name) ?></h3>

<form action="process_staff.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="department_id" value="<?= htmlspecialchars($dept_id) ?>" />

<div class="form-group">
     <label for="staffName">Staff Member Name</label>
    <input type="text" class="form-control" name="name" id="staffName" placeholder="e.g., Dr. John Doe" required/>
</div>

<div class="form-group">
     <label for="staffDesignation">Designation</label>
    <input type="text" class="form-control" name="designation" id="staffDesignation" placeholder="e.g., Professor, Lecturer" required/>
</div>

<div class="form-group">
     <label for="staffDetails">Details</label>
    <textarea class="form-control" name="details" id="staffDetails" rows="5" placeholder="e.g., Qualifications, areas of expertise, contact info."></textarea>
</div>

<div class="form-group">
     <label for="staffImage">Staff Picture (optional)</label>
    <input type="file" class="form-control" name="image_url" id="staffImage" accept="image/*" />
    <small class="form-text text-muted">Upload a picture for the staff member.</small>
</div>
    
<div class="form-group">
    <input type="submit" class="btn btn-primary" value="Add Staff Member" style="margin-bottom:20px;">  
    <a href="manage_staff.php?dept_id=<?= htmlspecialchars($dept_id) ?>" class="btn btn-secondary">Back to Staff List</a>
</div>
</form>
</div>
</body>
</html>