<?php
session_start();
include_once "links.html"; // Includes your common CSS links (Bootstrap etc.)
include_once "../config.php";

$download_id = null;
$download = null;
$error = null;

// Fetch existing download data if ID is provided
if (isset($_GET['id'])) {
    $download_id = $_GET['id'];
    $stmt = $con->prepare("SELECT * FROM downloads WHERE id = ?");
    $stmt->bind_param("i", $download_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $download = $result->fetch_assoc();
    } else {
        $error = "Download not found.";
    }
    $stmt->close();
}

// Handle form submission for update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $download_id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $current_file_path = $_POST['current_file_path']; // Hidden field for current file name

    $new_file_name = $current_file_path; // Assume no new file unless uploaded

    // Handle new file upload if provided
    if (isset($_FILES['download_file']) && $_FILES['download_file']['error'] == 0) {
        $target_dir = "../uploads/";
        $new_file_name = time() . '_' . basename($_FILES['download_file']['name']); // New unique name
        $target_file = $target_dir . $new_file_name;
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $allowed_types = array("pdf", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "zip", "rar", "jpg", "jpeg", "png", "gif");
        if (in_array($file_type, $allowed_types)) {
            if (move_uploaded_file($_FILES['download_file']['tmp_name'], $target_file)) {
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
    }

    if (!$error) { // Only proceed with DB update if no file upload error occurred
        $stmt = $con->prepare("UPDATE downloads SET title = ?, description = ?, file_path = ? WHERE id = ?");
        $stmt->bind_param("sssi", $title, $description, $new_file_name, $download_id);

        if ($stmt->execute()) {
            header('Location: view_downloads.php?status=success');
            exit();
        } else {
            $error = "Error updating download: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<body style="background:none;">
<link rel="stylesheet" type="text/css" href="css/style.css"> <div class="col-md-12 col-sm-12 col-xs-12" id="mainadd">

    <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3" id="adddata">

        <h3 style="text-align:center;">Edit Download</h3>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert" style="margin-top: 15px;">
                <?= $error ?>
            </div>
        <?php elseif (!$download): ?>
            <div class="alert alert-warning" role="alert" style="margin-top: 15px;">
                Download ID not provided or download not found.
            </div>
        <?php else: ?>
            <form action="update_downloads.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= htmlspecialchars($download['id']) ?>">
                <input type="hidden" name="current_file_path" value="<?= htmlspecialchars($download['file_path']) ?>">

                <div class="form-group">
                    <label for="title">Download Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($download['title']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Description (Optional)</label>
                    <textarea class="form-control" id="description" name="description" rows="3"><?= htmlspecialchars($download['description']) ?></textarea>
                </div>
                <div class="form-group">
                    <label for="download_file">Replace File (Optional)</label>
                    <p class="text-muted">Current File: <strong><?= htmlspecialchars($download['file_path']) ?></strong></p>
                    <input type="file" class="form-control" id="download_file" name="download_file">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Update Download" style="margin-bottom:20px;">
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
<?php $con->close(); ?>