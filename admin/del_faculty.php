<?php
include_once "../config.php"; // Your database connection

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Fetch image URL before deleting the record
    $res = mysqli_query($con, "SELECT image_url FROM faculties WHERE id='$id'");
    $row = mysqli_fetch_assoc($res);
    $image_to_delete = $row['image_url'];

    // Delete associated departments first due to FOREIGN KEY ON DELETE CASCADE if not set, or if you want to explicitly handle
    // If you set ON DELETE CASCADE in your database, this step is automatically handled by the DB.
    // If not, you might need: mysqli_query($con, "DELETE FROM departments WHERE faculty_id='$id'");

    $q = mysqli_query($con, "DELETE FROM faculties WHERE id='$id'");

    if ($q) {
        // Delete the physical image file if it exists
        if (!empty($image_to_delete) && file_exists("../images/" . $image_to_delete)) {
            unlink("../images/" . $image_to_delete);
        }
        header('Location: view_faculties.php'); // Redirect to view page
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }
} else {
    header('Location: view_faculties.php'); // Redirect if no ID provided
    exit();
}
?>