<?php session_start();
include_once "links.html"; // Your admin panel includes
include_once "../config.php"; // Database connection
?>
<body style="background:none;">
<div id="view" class="col-md-12 col-sm-12 col-xs-12">
<h4 style="text-align:center; color:#fff; padding-top:3%; padding-bottom:3; text-transform:uppercase;">Manage Research Papers & Projects</h4>

<a href="add_research.php">
<button type="button" class="btn btn-info" style="margin-left:20px; margin-bottom:20px;">Add New Research <span class="glyphicon glyphicon-plus" style="padding-left:20px;"></span></button></a>

<div class="table-responsive col-md-12 col-sm-12 col-xs-12" style="height:400px; overflow-y: auto;">
<table class="table table-bordered table-striped">
<thead>
<tr>
<th>Sr#</th>
<th>Title</th>
<th>Authors</th>
<th>Pub. Date</th>
<th>Abstract</th>
<th>File</th>
<th>External Link</th>
<th>Published</th>
<th>Edit</th>
<th>Delete</th>
</tr>
</thead>
<tbody>
<?php
$count = 1;
$q = mysqli_query($con, "SELECT * FROM research_papers ORDER BY publication_date DESC");
if (mysqli_num_rows($q) > 0) {
    while($row = mysqli_fetch_assoc($q)) {
?>
<tr>
<td><?php echo $count; ?></td>
<td><?php echo htmlspecialchars(substr($row['title'], 0, 50)) . (strlen($row['title']) > 50 ? '...' : ''); ?></td>
<td><?php echo htmlspecialchars(substr($row['authors'], 0, 30)) . (strlen($row['authors']) > 30 ? '...' : ''); ?></td>
<td><?php echo htmlspecialchars($row['publication_date']); ?></td>
<td><?php echo htmlspecialchars(substr($row['abstract'], 0, 100)) . (strlen($row['abstract']) > 100 ? '...' : ''); ?></td>
<td>
    <?php if (!empty($row['file_url'])) { ?>
        <a href="../files/<?php echo htmlspecialchars($row['file_url']); ?>" target="_blank"><i class="fas fa-file-pdf"></i> View</a>
    <?php } else { ?>
        N/A
    <?php } ?>
</td>
<td>
    <?php if (!empty($row['external_link'])) { ?>
        <a href="<?php echo htmlspecialchars($row['external_link']); ?>" target="_blank"><i class="fas fa-external-link-alt"></i> Link</a>
    <?php } else { ?>
        N/A
    <?php } ?>
</td>
<td>
    <?php echo $row['is_published'] ? '<span class="text-success"><i class="fas fa-check-circle"></i> Yes</span>' : '<span class="text-danger"><i class="fas fa-times-circle"></i> No</span>'; ?>
</td>
<td>
<a href="edit_research.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-sm btn-warning">
<i class="fas fa-edit"></i> Edit
</a>
</td>
<td>
<a href="del_research.php?id=<?php echo htmlspecialchars($row['id']);?>" class="btn btn-sm btn-danger" onClick="return confirm('Are you sure you want to permanently delete this research paper?');">
<i class="fas fa-trash-alt"></i> Delete
</a>
</td>
</tr>
<?php
        $count++;
    }
} else {
    echo '<tr><td colspan="10" class="text-center">No research papers found.</td></tr>';
}
?>
</tbody>
</table>
</div>
</div>
</body>
</html>