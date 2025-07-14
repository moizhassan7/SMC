<?php session_start();
include_once "links.html";
include_once "../config.php";

$department_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($department_id == 0) {
    header("Location: view_departments.php");
    exit();
}

$q = mysqli_query($con, "SELECT * FROM departments WHERE id = $department_id");
$department = mysqli_fetch_assoc($q);

if (!$department) {
    header("Location: view_departments.php");
    exit();
}

// Fetch faculties to link departments
$faculties_q = mysqli_query($con, "SELECT id, name FROM faculties ORDER BY name ASC");
?>
<body style="background:none;">
<link rel="stylesheet" type="text/css" href="css/style.css">

<div class="col-md-12 col-sm-12 col-xs-12" id="mainadd">

<div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3" id="adddata">

<h3 style="text-align:center; ">Edit Department Details</h3>

<form action="update_department.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?= htmlspecialchars($department['id']) ?>" />

<div class="form-group">
     <label for="facultyId">Belongs to Faculty</label>
    <select class="form-control" name="faculty_id" id="facultyId" required>
        <option value="">Select Faculty</option>
        <?php while($faculty_row = mysqli_fetch_assoc($faculties_q)): ?>
            <option value="<?= htmlspecialchars($faculty_row['id']) ?>" <?= ($faculty_row['id'] == $department['faculty_id']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($faculty_row['name']) ?>
            </option>
        <?php endwhile; ?>
    </select>
</div>

<div class="form-group">
     <label for="deptName">Department Name</label>
    <input type="text" class="form-control" name="name" id="deptName" value="<?= htmlspecialchars($department['name']) ?>" placeholder="e.g., Anatomy" required/>
</div>

<div class="form-group">
     <label for="deptOverview">Overview</label>
    <textarea class="form-control" name="overview" id="deptOverview" rows="5" placeholder="Provide a brief overview of the department." required><?= htmlspecialchars($department['overview']) ?></textarea>
</div>

<div class="form-group">
     <label for="deptImage">Department Image</label>
    <?php if (!empty($department['image_url'])): ?>
        <img src="../images/<?= htmlspecialchars($department['image_url']) ?>" alt="Current Department Image" style="width: 150px; height: auto; margin-bottom: 10px;" /><br>
        <label><input type="checkbox" name="delete_image" value="1"> Delete current image</label><br>
    <?php else: ?>
        <p class="text-muted">No image uploaded for this department.</p>
    <?php endif; ?>
    <input type="file" class="form-control" name="image_url" id="deptImage" accept="image/*" />
    <small class="form-text text-muted">Upload a new image to replace the current one.</small>
</div>
    
<div class="form-group">
    <input type="submit" class="btn btn-primary" value="Update Department" style="margin-bottom:20px;">  
</div>
</form>
</div>
</body>
</html>