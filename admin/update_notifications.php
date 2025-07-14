<?php
session_start();
include_once "links.html"; // Includes your common CSS links (Bootstrap etc.)
include_once "../config.php";

$notification_id = null;
$notification = null;
$error = null;
$success = null;

// Fetch existing notification data if ID is provided
if (isset($_GET['id'])) {
    $notification_id = $_GET['id'];
    $stmt = $con->prepare("SELECT * FROM notifications WHERE id = ?");
    $stmt->bind_param("i", $notification_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $notification = $result->fetch_assoc();
    } else {
        $error = "Notification not found.";
    }
    $stmt->close();
}

// Handle form submission for update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $notification_id = $_POST['id'];
    $title = $_POST['title'];
    $current_file_path = $_POST['current_file_path']; // Hidden field for current file name

    $new_file_name = $current_file_path; // Assume no new file unless uploaded

    if (isset($_FILES['notification_file']) && $_FILES['notification_file']['error'] == 0) {
        $target_dir = "../images/";
        $new_file_name = time() . '_' . basename($_FILES['notification_file']['name']); // New unique name
        $target_file = $target_dir . $new_file_name;
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $allowed_types = array("pdf", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "zip", "rar", "jpg", "jpeg", "png", "gif", "bmp", "webp");
        
        if (in_array($file_type, $allowed_types)) {
            if (move_uploaded_file($_FILES['notification_file']['tmp_name'], $target_file)) {
                // If old file exists and is different from the new one, delete the old physical file
                if (!empty($current_file_path) && file_exists($target_dir . $current_file_path) && $current_file_path != $new_file_name) {
                    unlink($target_dir . $current_file_path);
                }
            } else {
                $error = "Error uploading new file. Check folder permissions.";
                // Revert to current file path if new upload fails
                $new_file_name = $current_file_path;
            }
        } else {
            $error = "Invalid file type for new upload. Allowed types: " . implode(", ", $allowed_types);
            $new_file_name = $current_file_path; // Keep old file if new one is invalid
        }
    } elseif (isset($_POST['remove_file']) && $_POST['remove_file'] == '1') {
        $target_dir = "../images/";
        if (!empty($current_file_path) && file_exists($target_dir . $current_file_path)) {
            unlink($target_dir . $current_file_path);
            $new_file_name = ''; // Set file_path to empty in DB
            $success = "File removed successfully!";
        } else {
            $error = "No file to remove or file not found.";
        }
    }

    if (!$error) { // Only proceed with DB update if no file upload error occurred
        $stmt = $con->prepare("UPDATE notifications SET title = ?, image_url = ? WHERE id = ?");
        $stmt->bind_param("ssi", $title,  $new_file_name, $notification_id);

        if ($stmt->execute()) {
            if (!$success) { // Don't override file removal success message
                $success = "Notification updated successfully!";
            }
            // Re-fetch notification data to show updated state immediately
            $stmt = $con->prepare("SELECT * FROM notifications WHERE id = ?");
            $stmt->bind_param("i", $notification_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $notification = $result->fetch_assoc();
            $stmt->close();
        } else {
            $error = "Error updating notification: " . $stmt->error;
        }
    }
}
?>

<body style="background:none;">
<link rel="stylesheet" type="text/css" href="css/style.css"> <div class="col-md-12 col-sm-12 col-xs-12" id="mainadd">

    <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3" id="adddata">

        <h3 style="text-align:center;">Edit Notification</h3>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert" style="margin-top: 15px;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php elseif (isset($success)): ?>
            <div class="alert alert-success" role="alert" style="margin-top: 15px;">
                <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>

        <?php if (!$notification): ?>
            <div class="alert alert-warning" role="alert" style="margin-top: 15px;">
                Notification ID not provided or notification not found.
            </div>
            <a href="view_admin_notifications.php" class="btn btn-default">Back to Notifications</a>
        <?php else: ?> 
            <form action="update_notifications.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= htmlspecialchars($notification['id']) ?>">
                <input type="hidden" name="current_file_path" value="<?= htmlspecialchars($notification['image_url']) ?>">

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($notification['title']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="notification_file">Replace File (Image/PDF/Doc)</label>
                    <?php if (!empty($notification['image_url'])): ?>
                        <p class="text-muted">Current File: <strong><a href="../images/<?= htmlspecialchars($notification['image_url']) ?>" target="_blank"><?= htmlspecialchars($notification['image_url']) ?></a></strong></p>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remove_file" value="1"> Remove current file
                            </label>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">No file currently associated.</p>
                    <?php endif; ?>
                    <input type="file" class="form-control" id="notification_file" name="notification_file">
                    <small class="form-text text-muted">Upload a new file to replace the existing one, or check "Remove current file".</small>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Update Notification" style="margin-bottom:20px;">
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
<?php $con->close(); ?>