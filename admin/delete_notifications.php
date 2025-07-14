<?php
session_start();
include_once "../config.php"; // Assuming config.php is one directory up

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $notification_id = $_GET['id'];

    // First, get the file path from the database to delete the physical file
    $stmt = $con->prepare("SELECT image_url FROM notifications WHERE id = ?");
    $stmt->bind_param("i", $notification_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $file_to_delete = null;

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $file_to_delete = $row['image_url'];
    }
    $stmt->close();

    // Now, delete the record from the database
    $stmt = $con->prepare("DELETE FROM notifications WHERE id = ?");
    $stmt->bind_param("i", $notification_id);

    if ($stmt->execute()) {
        // If database record deleted successfully, delete the physical file
        if (!empty($file_to_delete)) {
            $target_dir = "../images/"; // Consistent with your image storage
            $full_file_path = $target_dir . $file_to_delete;
            if (file_exists($full_file_path)) {
                unlink($full_file_path); // Delete the file
            }
        }
        header('Location: view_admin_notifications.php?status=success');
        exit();
    } else {
        header('Location: view_admin_notifications.php?status=error&message=' . urlencode("Error deleting notification from database: " . $stmt->error));
        exit();
    }
} else {
    header('Location: view_notifications.php?status=error&message=' . urlencode("No notification ID provided for deletion."));
    exit();
}


?>