<?php session_start();
include_once "links.html"; // Assuming this includes Bootstrap CSS and other necessary links
include_once "../config.php"; // Assuming this connects to your database

$faculty_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($faculty_id == 0) {
    header("Location: view_faculties.php"); // Redirect if no ID provided
    exit();
}

$q = mysqli_query($con, "SELECT * FROM faculties WHERE id = $faculty_id");
$faculty = mysqli_fetch_assoc($q);

if (!$faculty) {
    header("Location: view_faculties.php"); // Redirect if faculty not found
    exit();
}
?>
<body style="background:none;">
<link rel="stylesheet" type="text/css" href="css/style.css">

<div class="col-md-12 col-sm-12 col-xs-12" id="mainadd">

<div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3" id="adddata">

<h3 style="text-align:center; ">Edit Faculty Details</h3>

<form action="update_faculty.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo htmlspecialchars($faculty['id']); ?>" />

<div class="form-group">
     <label for="facultyName">Faculty Name</label>
    <input type="text" class="form-control" name="name" id="facultyName" value="<?php echo htmlspecialchars($faculty['name']); ?>" placeholder="e.g., Faculty of Basic Sciences" required/>
</div>

<div class="form-group">
     <label for="facultyOverview">Overview</label>
    <textarea class="form-control" name="overview" id="facultyOverview" rows="5" placeholder="Provide a brief overview of the faculty." required><?php echo htmlspecialchars($faculty['overview']); ?></textarea>
</div>

<div class="form-group">
     <label for="facultyImage">Current Faculty Image</label>
    <?php if (!empty($faculty['image_url'])): ?>
        <img src="../images/<?php echo htmlspecialchars($faculty['image_url']); ?>" alt="Current Faculty Image" style="width: 150px; height: auto; margin-bottom: 10px;" /><br>
        <label><input type="checkbox" name="delete_image" value="1"> Delete current image</label><br>
    <?php else: ?>
        <p class="text-muted">No image uploaded for this faculty.</p>
    <?php endif; ?>
    <input type="file" class="form-control" name="image_url" id="facultyImage" accept="image/*" />
    <small class="form-text text-muted">Upload a new image to replace the current one.</small>
</div>
    
<div class="form-group">
    <input type="submit" class="btn btn-primary" value="Update Faculty" style="margin-bottom:20px;">  
</div>
</form>
</div>
</body>
</html>