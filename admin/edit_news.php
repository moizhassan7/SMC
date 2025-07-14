<?php session_start();
include_once "links.html";
include_once "../config.php";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id == 0) {
    header("Location: view_news.php");
    exit();
}

$q = mysqli_query($con, "SELECT * FROM news_events WHERE id = $id");
$row = mysqli_fetch_array($q);

if (!$row) {
    header("Location: view_news.php");
    exit();
}

$existing_additional_images = !empty($row['additional_images']) ? explode(',', $row['additional_images']) : [];
?>
<body style="background:none;">
<link rel="stylesheet" type="text/css" href="css/style.css">

<div class="col-md-12 col-sm-12 col-xs-12" id="mainadd">

<div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3" id="adddata">

<h3 style="text-align:center; ">Edit News or Event</h3>

<form action="update_news.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>" />

<div class="form-group">
     <label for="formGroupExampleInput">Title</label>
    <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" placeholder="Title" required/>
</div>

<div class="form-group">
     <label for="formGroupExampleInput">Description</label>
    <textarea class="form-control" name="description" placeholder="Description" required><?php echo htmlspecialchars($row['description']); ?></textarea>
</div>

<div class="form-group">
     <label for="formGroupExampleInput">Event Date</label>
    <input type="date" class="form-control" name="event_date" value="<?php echo htmlspecialchars($row['event_date']); ?>" required/>
</div>

<div class="form-group">
     <label for="formGroupExampleInput">Full article</label>
    <textarea class="form-control" name="full_article"><?php echo htmlspecialchars($row['full_article']); ?></textarea>
</div>

<div class="form-group">
     <label for="formGroupExampleInput">Main Image</label>
    <?php if (!empty($row['image_url'])): ?>
        <img src="../images/<?php echo htmlspecialchars($row['image_url']); ?>" alt="Current Main Image" style="width: 150px; height: auto; margin-bottom: 10px;" /><br>
        <label><input type="checkbox" name="delete_main_image" value="1"> Delete main image</label><br>
    <?php endif; ?>
    <input type="file" class="form-control" name="image_url" accept="image/*" />
    <small class="form-text text-muted">Upload a new image to replace the current one.</small>
</div>

<div class="form-group">
     <label for="formGroupExampleInput">Additional Images</label>
    <div class="current-additional-images row">
        <?php if (!empty($existing_additional_images)): ?>
            <?php foreach ($existing_additional_images as $img): ?>
                <?php if (!empty($img)): ?>
                    <div class="col-md-3 col-sm-4 col-xs-6 mb-2 text-center">
                        <img src="../images/<?php echo htmlspecialchars($img); ?>" alt="Additional Image" style="width: 100px; height: 100px; object-fit: cover;" /><br>
                        <label><input type="checkbox" name="delete_additional_images[]" value="<?php echo htmlspecialchars($img); ?>"> Remove</label>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted">No additional images uploaded yet.</p>
        <?php endif; ?>
    </div>
    <input type="file" class="form-control" name="additional_images[]" accept="image/*" multiple />
    <small class="form-text text-muted">Select multiple images to add more.</small>
</div>
    
    <div class="form-group">
    <input type="submit" class="btn btn-primary" value="Update Data" style="margin-bottom:20px;">  
  </div>
</form>
</div>
</body>
</html>