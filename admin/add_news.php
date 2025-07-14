<?php
session_start();
include_once "links.html";
include_once "../config.php";
?>
<body style="background:none;">
<link rel="stylesheet" type="text/css" href="css/style.css">

<div class="col-md-12 col-sm-12 col-xs-12"  id="mainadd">

<div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3" id="adddata">

<h3 style="text-align:center; ">Add News or Event</h3>

<form action="process_news.php" method="post" enctype="multipart/form-data">

<div class="form-group">
     <label for="formGroupExampleInput">Title</label>
    <input type="text" class="form-control" name="title" placeholder="Title" required/>
</div>

<div class="form-group">
     <label for="formGroupExampleInput">Description</label>
    <textarea class="form-control" name="description" placeholder="Description" required></textarea>
</div>

<div class="form-group">
     <label for="formGroupExampleInput">Event Date</label>
    <input type="date" class="form-control" name="event_date" required/>
</div>

<div class="form-group">
     <label for="formGroupExampleInput">Full article</label>
    <textarea class="form-control" name="full_article"></textarea>
</div>

<div class="form-group">
     <label for="formGroupExampleInput">Main Image (optional)</label>
    <input type="file" class="form-control" name="image_url" accept="image/*" />
</div>

<div class="form-group">
     <label for="formGroupExampleInput">Additional Images (optional, select multiple)</label>
    <input type="file" class="form-control" name="additional_images[]" accept="image/*" multiple />
</div>
    <div class="form-group">
    <input type="submit" class="btn btn-primary" value="Add Data" style="margin-bottom:20px;">  
  </div>
</form>
</div>
</body>
</html>