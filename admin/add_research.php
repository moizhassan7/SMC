<?php session_start();
include_once "links.html"; // Your admin panel includes
include_once "../config.php"; // Database connection
?>
<body style="background:none;">
<link rel="stylesheet" type="text/css" href="css/style.css">

<div class="col-md-12 col-sm-12 col-xs-12" id="mainadd">
<div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3" id="adddata">

<h3 style="text-align:center; ">Add New Research Paper/Project</h3>

<form action="process_research.php" method="post" enctype="multipart/form-data">

<div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" name="title" id="title" placeholder="Research Paper Title" required/>
</div>

<div class="form-group">
    <label for="authors">Authors</label>
    <input type="text" class="form-control" name="authors" id="authors" placeholder="e.g., Dr. Jane Doe, Prof. John Smith"/>
</div>

<div class="form-group">
    <label for="publication_date">Publication Date</label>
    <input type="date" class="form-control" name="publication_date" id="publication_date"/>
</div>

<div class="form-group">
    <label for="abstract">Abstract</label>
    <textarea class="form-control" name="abstract" id="abstract" rows="6" placeholder="Provide a brief abstract of the research." required></textarea>
</div>

<div class="form-group">
    <label for="keywords">Keywords</label>
    <input type="text" class="form-control" name="keywords" id="keywords" placeholder="Comma-separated keywords"/>
</div>

<div class="form-group">
    <label for="file_url">Research File (PDF/Document - Optional)</label>
    <input type="file" class="form-control" name="file_url" id="file_url" accept=".pdf,.doc,.docx"/>
    <small class="form-text text-muted">Upload the research paper file (PDF, Word).</small>
</div>

<div class="form-group">
    <label for="external_link">External Link (Optional)</label>
    <input type="url" class="form-control" name="external_link" id="external_link" placeholder="e.g., https://journal.com/paper-link"/>
    <small class="form-text text-muted">Link to the paper on a journal website or external platform.</small>
</div>

<div class="form-group">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="is_published" id="is_published" value="1" checked>
        <label class="form-check-label" for="is_published">
            Published (Show on website)
        </label>
    </div>
</div>
    
<div class="form-group">
    <input type="submit" class="btn btn-primary" value="Add Research" style="margin-bottom:20px;">  
</div>
</form>
</div>
</body>
</html>