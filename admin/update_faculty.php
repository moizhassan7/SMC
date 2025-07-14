<?php
include_once "../config.php"; // Your database connection

$id = mysqli_real_escape_string($con, $_POST['id']);
$name = mysqli_real_escape_string($con, $_POST['name']);
$overview = mysqli_real_escape_string($con, $_POST['overview']);

// Fetch current image_url from the database
$res = mysqli_query($con, "SELECT image_url FROM faculties WHERE id='$id'");
$row = mysqli_fetch_assoc($res);
$current_image_url = $row['image_url'];

$new_image_name = $current_image_url; // Assume existing image remains unless changed or deleted

// Handle image deletion
if (isset($_POST['delete_image']) && $_POST['delete_image'] == '1') {
    if (!empty($current_image_url) && file_exists("../images/" . $current_image_url)) {
        unlink("../images/" . $current_image_url); // Delete the physical file
    }
    $new_image_name = ''; // Set image_url to empty in DB
}

// Handle new image upload
if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
    // Delete old image if a new one is uploaded and old one exists
    if (!empty($current_image_url) && file_exists("../images/" . $current_image_url)) {
        unlink("../images/" . $current_image_url);
    }

    $new_image_name = time() . '_' . basename($_FILES['image_url']['name']);
    $target_dir = "../images/";
    $target_file = $target_dir . $new_image_name;

    if (move_uploaded_file($_FILES['image_url']['tmp_name'], $target_file)) {
        // New file uploaded successfully
    } else {
        echo "Sorry, there was an error uploading the new file.";
        // Keep the old image name if new upload fails, unless it was marked for deletion
        $new_image_name = (isset($_POST['delete_image']) && $_POST['delete_image'] == '1') ? '' : $current_image_url;
    }
}

$q = mysqli_query($con, "UPDATE faculties SET
                            name = '$name',
                            overview = '$overview',
                            image_url = '$new_image_name'
                            WHERE id = '$id'");

if ($q) {
    header('Location: view_faculties.php'); // Redirect to view page
    exit();
} else {
    echo "Error: " . mysqli_error($con);
}
?>