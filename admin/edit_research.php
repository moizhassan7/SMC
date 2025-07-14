<?php session_start();
include_once "links.html";
include_once "../config.php";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id == 0) {
    header("Location: view_research.php");
    exit();
}

$q = mysqli_query($con, "SELECT * FROM research_papers WHERE id = $id");
$research = mysqli_fetch_assoc($q);

if (!$research) {
    header("Location: view_research.php");
    exit();
}
?>
<body style="background:none;">
<link rel="stylesheet" type="text/css" href="css/style.css">

<div class="col-md-12 col-sm-12 col-xs-12" id="mainadd">
<div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3" id="adddata">

<h3 style="text-align:center; ">Edit Research Paper/Project</h3>

<form action="update_research.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?= htmlspecialchars($research['id']) ?>" />

<div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" name="title" id="title" value="<?= htmlspecialchars($research['title']) ?>" placeholder="Research Paper Title" required/>
</div>

<div class="form-group">
    <label for="authors">Authors</label>
    <input type="text" class="form-control" name="authors" id="authors" value="<?= htmlspecialchars($research['authors']) ?>" placeholder="e.g., Dr. Jane Doe, Prof. John Smith"/>
</div>

<div class="form-group">
    <label for="publication_date">Publication Date</label>
    <input type="date" class="form-control" name="publication_date" id="publication_date" value="<?= htmlspecialchars($research['publication_date']) ?>"/>
</div>

<div class="form-group">
    <label for="abstract">Abstract</label>
    <textarea class="form-control" name="abstract" id="abstract" rows="6" placeholder="Provide a brief abstract of the research." required><?= htmlspecialchars($research['abstract']) ?></textarea>
</div>

<div class="form-group">
    <label for="keywords">Keywords</label>
    <input type="text" class="form-control" name="keywords" id="keywords" value="<?= htmlspecialchars($research['keywords']) ?>" placeholder="Comma-separated keywords"/>
</div>

<div class="form-group">
    <label>Current File:</label>
    <?php if (!empty($research['file_url'])): ?>
        <p><a href="../files/<?= htmlspecialchars($research['file_url']) ?>" target="_blank"><?= htmlspecialchars($research['file_url']) ?></a></p>
        <label><input type="checkbox" name="delete_file" value="1"> Delete current file</label><br>
    <?php else: ?>
        <p>No file uploaded.</p>
    <?php endif; ?>
    <label for="file_url">Upload New File (Optional)</label>
    <input type="file" class="form-control" name="file_url" id="file_url" accept=".pdf,.doc,.docx"/>
    <small class="form-text text-muted">Upload a new file to replace the current one.</small>
</div>

<div class="form-group">
    <label for="external_link">External Link (Optional)</label>
    <input type="url" class="form-control" name="external_link" id="external_link" value="<?= htmlspecialchars($research['external_link']) ?>" placeholder="e.g., https://journal.com/paper-link"/>
    <small class="form-text text-muted">Link to the paper on a journal website or external platform.</small>
</div>

<div class="form-group">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="is_published" id="is_published" value="1" <?= $research['is_published'] ? 'checked' : '' ?>>
        <label class="form-check-label" for="is_published">
            Published (Show on website)
        </label>
    </div>
</div>
    
<div class="form-group">
    <input type="submit" class="btn btn-primary" value="Update Research" style="margin-bottom:20px;">  
</div>
</form>
</div>
</body>
</html>