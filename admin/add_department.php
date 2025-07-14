<?php session_start();
include_once "links.html";
include_once "../config.php";

// Fetch faculties to link departments
$faculties_q = mysqli_query($con, "SELECT id, name FROM faculties ORDER BY name ASC");
?>
<body style="background:none;">
<link rel="stylesheet" type="text/css" href="css/style.css">

<div class="col-md-12 col-sm-12 col-xs-12" id="mainadd">

<div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3" id="adddata">

<h3 style="text-align:center; ">Add New Department</h3>

<form action="process_department.php" method="post" enctype="multipart/form-data">

<div class="form-group">
     <label for="facultyId">Belongs to Faculty</label>
    <select class="form-control" name="faculty_id" id="facultyId" required>
        <option value="">Select Faculty</option>
        <?php while($faculty_row = mysqli_fetch_assoc($faculties_q)): ?>
            <option value="<?= htmlspecialchars($faculty_row['id']) ?>"><?= htmlspecialchars($faculty_row['name']) ?></option>
        <?php endwhile; ?>
    </select>
</div>

<div class="form-group">
     <label for="deptName">Department Name</label>
    <input type="text" class="form-control" name="name" id="deptName" placeholder="e.g., Anatomy" required/>
</div>

<div class="form-group">
     <label for="deptOverview">Overview</label>
    <textarea class="form-control" name="overview" id="deptOverview" rows="5" placeholder="Provide a brief overview of the department." required></textarea>
</div>

<div class="form-group">
     <label for="deptImage">Department Image (optional)</label>
    <input type="file" class="form-control" name="image_url" id="deptImage" accept="image/*" />
    <small class="form-text text-muted">Upload a representative image for the department.</small>
</div>
    
<div class="form-group">
    <input type="submit" class="btn btn-primary" value="Add Department" style="margin-bottom:20px;">  
</div>
</form>
</div>
</body>
</html>