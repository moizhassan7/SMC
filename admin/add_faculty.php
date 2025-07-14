<?php session_start();
include_once "links.html"; // Assuming this includes Bootstrap CSS and other necessary links
include_once "../config.php"; // Assuming this connects to your database
?>
<body style="background:none;">
<link rel="stylesheet" type="text/css" href="css/style.css">

<div class="col-md-12 col-sm-12 col-xs-12" id="mainadd">

<div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3" id="adddata">

<h3 style="text-align:center; ">Add New Faculty</h3>

<form action="process_faculty.php" method="post" enctype="multipart/form-data">

<div class="form-group">
     <label for="facultyName">Faculty Name</label>
    <input type="text" class="form-control" name="name" id="facultyName" placeholder="e.g., Faculty of Basic Sciences" required/>
</div>

<div class="form-group">
     <label for="facultyOverview">Overview</label>
    <textarea class="form-control" name="overview" id="facultyOverview" rows="5" placeholder="Provide a brief overview of the faculty." required></textarea>
</div>

<div class="form-group">
     <label for="facultyImage">Faculty Image (optional)</label>
    <input type="file" class="form-control" name="image_url" id="facultyImage" accept="image/*" />
    <small class="form-text text-muted">Upload a representative image for the faculty.</small>
</div>
    
<div class="form-group">
    <input type="submit" class="btn btn-primary" value="Add Faculty" style="margin-bottom:20px;">  
</div>
</form>
</div>
</body>
</html>