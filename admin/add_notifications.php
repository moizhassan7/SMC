<?php
session_start();
include_once "links.html"; // Includes your common CSS links (Bootstrap etc.)
include_once "../config.php";

$error = null; // Initialize error variable
$success = null; // Initialize success variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];

    $file_name = ''; // Initialize file name

    // Handle file upload
    if (isset($_FILES['notification_file']) && $_FILES['notification_file']['error'] == 0) {
        $target_dir = "../images/"; // Consistent with your existing structure for notifications images
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true); // Create directory if it doesn't exist
        }

        $file_name = time() . '_' . basename($_FILES['notification_file']['name']); // Unique file name
        $target_file = $target_dir . $file_name;
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Allowed types for notifications (images and common document types)
        $allowed_types = array("pdf", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "zip", "rar", "jpg", "jpeg", "png", "gif", "bmp", "webp");
        
        if (in_array($file_type, $allowed_types)) {
            if (move_uploaded_file($_FILES['notification_file']['tmp_name'], $target_file)) {
                // File uploaded successfully, now insert into database
                // Using image_url column for the file path, as per your table structure
                $stmt = $con->prepare("INSERT INTO notifications (title, image_url) VALUES (?, ?)");
                $stmt->bind_param("ss", $title,  $file_name);

                if ($stmt->execute()) {
                    $success = "Notification added successfully!";
                } else {
                    $error = "Error adding notification to database: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $error = "Error uploading file. Check folder permissions.";
            }
        } else {
            $error = "Invalid file type. Allowed types: " . implode(", ", $allowed_types);
        }
    } else {
        // If no file is uploaded, you can still add a notification without a file
        $stmt = $con->prepare("INSERT INTO notifications (title, image_url) VALUES (?, ?)");
        $stmt->bind_param("ss", $title,  $file_name);
        if ($stmt->execute()) {
            $success = "Notification added successfully (without a file)!";
        } else {
            $error = "Error adding notification to database: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<body style="background:none;">
<div class="col-md-12 col-sm-12 col-xs-12" id="mainadd">

    <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3" id="adddata">

        <h3 style="text-align:center;">Add New Notification</h3>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert" style="margin-top: 15px;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php elseif (isset($success)): ?>
            <div class="alert alert-success" role="alert" style="margin-top: 15px;">
                <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>

        <form action="add_notifications.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="notification_file">Upload File (Image/PDF/Doc)</label>
                <input type="file" class="form-control" id="notification_file" name="notification_file">
                <small class="form-text text-muted">Leave empty if no file is associated.</small>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Add Notification" style="margin-bottom:20px;">
            </div>
        </form>
    </div>
</div>
</body>
</html>
<?php $con->close(); ?>