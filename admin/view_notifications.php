<?php
session_start();
include_once "links.html"; // Includes your common CSS links (Bootstrap etc.)
include_once "../config.php";

// Fetch notifications
$sql = "SELECT * FROM notifications";
$result = $con->query($sql);
?>

<body style="background:none;">
<div id="view" class="col-md-12 col-sm-12 col-xs-12">
    <h4 style="text-align:center; color:#fff; padding-top:3%; padding-bottom:3; text-transform:uppercase;">Manage Notifications</h4>

    <a href="add_notifications.php">
        <button type="button" class="btn btn-info" style="margin-left:20px; margin-bottom:20px;">Add New Notification<span class="glyphicon glyphicon-plus" style="padding-left:20px;"></span></button>
    </a>

    <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
        <div class="alert alert-success alert-dismissible fade in" role="alert" style="margin: 0 20px 20px 20px;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Notification operation completed successfully!
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
                <th>File</th>
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
                    
                    <td>
                        <?php if (!empty($row['image_url'])) { ?>
                            <a href="../images/<?php echo htmlspecialchars($row['image_url']); ?>" target="_blank">
                                <?php
                                $file_extension = pathinfo($row['image_url'], PATHINFO_EXTENSION);
                                $is_image = in_array(strtolower($file_extension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']);
                                if ($is_image) {
                                    echo '<img src="../images/' . htmlspecialchars($row['image_url']) . '" alt="file_img" style="width: 80px; height: 80px; object-fit: cover;">';
                                } else {
                                    echo '<i class="fas fa-file-alt fa-2x"></i> ' . htmlspecialchars($row['image_url']);
                                }
                                ?>
                            </a>
                        <?php } else { ?>
                            No File
                        <?php } ?>
                    </td>
                    <td>
                        <a href="update_notifications.php?id=<?php echo $row['id']; ?>">
                            <img src="img/edit.png" style="cursor:pointer;" alt="Edit">
                        </a>
                    </td>
                    <td>
                        <a href="delete_notifications.php?id=<?php echo $row['id'];?>" onClick="return confirm('Are You Sure you want to Permanently Delete this notification and its associated file?');">
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
                    <td colspan="8" class="text-center">No notifications found. Click "Add New Notification" to get started.</td>
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