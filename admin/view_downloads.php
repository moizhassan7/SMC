<?php
session_start();
include_once "links.html"; // Includes your common CSS links (Bootstrap etc.)
include_once "../config.php";

// Fetch downloads
$sql = "SELECT * FROM downloads ORDER BY upload_date DESC";
$result = $con->query($sql);
?>

<body style="background:none;">
<div id="view" class="col-md-12 col-sm-12 col-xs-12">
    <h4 style="text-align:center; color:#fff; padding-top:3%; padding-bottom:3; text-transform:uppercase;">View All Downloads</h4>

    <a href="add_downloads.php">
        <button type="button" class="btn btn-info" style="margin-left:20px; margin-bottom:20px;">Add New Download<span class="glyphicon glyphicon-plus" style="padding-left:20px;"></span></button>
    </a>

    <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
        <div class="alert alert-success alert-dismissible fade in" role="alert" style="margin: 0 20px 20px 20px;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Download operation completed successfully!
        </div>
    <?php elseif (isset($_GET['status']) && $_GET['status'] == 'error'): ?>
        <div class="alert alert-danger alert-dismissible fade in" role="alert" style="margin: 0 20px 20px 20px;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Error: <?= htmlspecialchars($_GET['message'] ?? 'An unknown error occurred.') ?>
        </div>
    <?php endif; ?>

    <div class="table-responsive col-md-12 col-sm-12 col-xs-12" style="height:400px;">
        <table class="table table-bordered">
            <tr>
                <th>Sr#</th>
                <th>Title</th>
                <th>Description</th>
                <th>File Name</th>
                <th>Upload Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            $count = 1;
            if ($result->num_rows > 0):
                while($row = $result->fetch_assoc()):
            ?>
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                    <td>
                        <a href="../uploads/<?php echo htmlspecialchars($row['file_path']); ?>" target="_blank" title="View File">
                            <?php echo htmlspecialchars($row['file_path']); ?>
                        </a>
                    </td>
                    <td><?php echo date("F d, Y H:i A", strtotime($row['upload_date'])); ?></td>
                    <td>
                        <a href="update_downloads.php?id=<?php echo $row['id']; ?>">
                            <img src="img/edit.png" style="cursor:pointer;" alt="Edit">
                        </a>
                    </td>
                    <td>
                        <a href="delete_downloads.php?id=<?php echo $row['id'];?>" onClick="return confirm('Are you sure you want to Permanently Delete this download?');">
                            <img src="logo/deletep.png" class="center-block" alt="Delete">
                        </a>
                    </td>
                </tr>
            <?php
                $count++;
                endwhile;
            else:
            ?>
                <tr>
                    <td colspan="7" class="text-center">No downloads found.</td>
                </tr>
            <?php
            endif;
            ?>
        </table>
    </div>
</div>
</body>
</html>
<?php $con->close(); ?>