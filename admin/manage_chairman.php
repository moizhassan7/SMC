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

// Check if a chairman already exists for this department
$chairman_q = mysqli_query($con, "SELECT * FROM chairmen WHERE department_id = $dept_id LIMIT 1");
$chairman = mysqli_fetch_assoc($chairman_q);

$action_url = $chairman ? "update_chairman.php" : "process_chairman.php";
$button_text = $chairman ? "Update Chairman" : "Add Chairman";
$page_title = $chairman ? "Edit Chairman for " . $dept_name : "Add Chairman for " . $dept_name;
?>
<body style="background:none;">
<link rel="stylesheet" type="text/css" href="css/style.css">

<div class="col-md-12 col-sm-12 col-xs-12" id="mainadd">

<div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3" id="adddata">

<h3 style="text-align:center; "><?= $page_title ?></h3>

<form action="<?= $action_url ?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="department_id" value="<?= htmlspecialchars($dept_id) ?>" />
<?php if ($chairman): ?>
    <input type="hidden" name="chairman_id" value="<?= htmlspecialchars($chairman['id']) ?>" />
<?php endif; ?>

<div class="form-group">
     <label for="chairmanName">Chairman Name</label>
    <input type="text" class="form-control" name="name" id="chairmanName" value="<?= htmlspecialchars($chairman['name'] ?? '') ?>" placeholder="e.g., Dr. Jane Doe" required/>
</div>

<div class="form-group">
     <label for="chairmanDesignation">Designation</label>
    <input type="text" class="form-control" name="designation" id="chairmanDesignation" value="<?= htmlspecialchars($chairman['designation'] ?? '') ?>" placeholder="e.g., Head of Department" required/>
</div>

<div class="form-group">
     <label for="chairmanMessage">Message (Optional)</label>
    <textarea class="form-control" name="message" id="chairmanMessage" rows="5" placeholder="A message from the chairman."><?= htmlspecialchars($chairman['message'] ?? '') ?></textarea>
</div>

<div class="form-group">
     <label for="chairmanImage">Chairman Picture (optional)</label>
    <?php if ($chairman && !empty($chairman['image_url'])): ?>
        <img src="../images/<?= htmlspecialchars($chairman['image_url']) ?>" alt="Current Chairman Picture" style="width: 150px; height: auto; margin-bottom: 10px;" /><br>
        <label><input type="checkbox" name="delete_image" value="1"> Delete current picture</label><br>
    <?php else: ?>
        <p class="text-muted">No picture uploaded.</p>
    <?php endif; ?>
    <input type="file" class="form-control" name="image_url" id="chairmanImage" accept="image/*" />
    <small class="form-text text-muted">Upload a new picture to replace the current one.</small>
</div>
    
<div class="form-group">
    <input type="submit" class="btn btn-primary" value="<?= $button_text ?>" style="margin-bottom:20px;">  
    <a href="view_departments.php" class="btn btn-secondary">Back to Departments</a>
</div>
</form>
</div>
</body>
</html>