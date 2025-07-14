<?php
session_start();
include_once "links.html"; // Includes your common CSS links (Bootstrap etc.)
include_once "../config.php";

$error = null; // Initialize error variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $file_name = ''; // Initialize file name

    // Handle file upload
    if (isset($_FILES['download_file']) && $_FILES['download_file']['error'] == 0) {
        $target_dir = "../uploads/"; // Directory where files will be stored
        // Create the directory if it doesn't exist
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_name = time() . '_' . basename($_FILES['download_file']['name']); // Unique file name
        $target_file = $target_dir . $file_name;
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Basic validation: allowed file types
        $allowed_types = array("pdf", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "zip", "rar", "jpg", "jpeg", "png", "gif"); // Added common image formats
        if (in_array($file_type, $allowed_types)) {
            if (move_uploaded_file($_FILES['download_file']['tmp_name'], $target_file)) {
                // File uploaded successfully, now insert into database
                $stmt = $con->prepare("INSERT INTO downloads (title, description, file_path) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $title, $description, $file_name);

                if ($stmt->execute()) {
                    header('Location: view_downloads.php?status=success');
                    exit();
                } else {
                    $error = "Error adding download to database: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $error = "Error uploading file. Check folder permissions.";
            }
        } else {
            $error = "Invalid file type. Allowed types: " . implode(", ", $allowed_types);
        }
    } else {
        $error = "No file uploaded or an upload error occurred.";
        if ($_FILES['download_file']['error'] == UPLOAD_ERR_NO_FILE) {
            $error = "Please select a file to upload.";
        }
    }
}
?>

<body style="background:none;">
<div class="col-md-12 col-sm-12 col-xs-12" id="mainadd">

    <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3" id="adddata">

        <h3 style="text-align:center;">Add New Download</h3>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert" style="margin-top: 15px;">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form action="add_downloads.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Download Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description (Optional)</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="download_file">Upload File</label>
                <input type="file" class="form-control" id="download_file" name="download_file" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Add Download" style="margin-bottom:20px;">
            </div>
        </form>
    </div>
</div>
</body>
</html>
<?php $con->close(); ?>