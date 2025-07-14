<?php
include_once "../config.php"; // Your database connection

$name = mysqli_real_escape_string($con, $_POST['name']);
$overview = mysqli_real_escape_string($con, $_POST['overview']);

$image_name = '';
if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
    $image_name = time() . '_' . basename($_FILES['image_url']['name']);
    $target_dir = "../images/"; // Directory where images are stored
    $target_file = $target_dir . $image_name;

    // Ensure the directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if (move_uploaded_file($_FILES['image_url']['tmp_name'], $target_file)) {
        // File uploaded successfully
    } else {
        echo "Sorry, there was an error uploading your file.";
        $image_name = ''; // Reset image name if upload fails
    }
}

$q = mysqli_query($con, "INSERT INTO faculties (name, overview, image_url)
                         VALUES ('$name', '$overview', '$image_name')");

if ($q) {
    header('Location: view_faculties.php'); // Redirect to view page
    exit();
} else {
    echo "Error: " . mysqli_error($con);
}
?>