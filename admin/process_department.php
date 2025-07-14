<?php
include_once "../config.php";

$faculty_id = mysqli_real_escape_string($con, $_POST['faculty_id']);
$name = mysqli_real_escape_string($con, $_POST['name']);
$overview = mysqli_real_escape_string($con, $_POST['overview']);

$image_name = '';
if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
    $image_name = time() . '_' . basename($_FILES['image_url']['name']);
    $target_dir = "../images/";
    $target_file = $target_dir . $image_name;

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    move_uploaded_file($_FILES['image_url']['tmp_name'], $target_file);
}

$q = mysqli_query($con, "INSERT INTO departments (faculty_id, name, overview, image_url)
                         VALUES ('$faculty_id', '$name', '$overview', '$image_name')");

if ($q) {
    header('Location: view_departments.php');
    exit();
} else {
    echo "Error: " . mysqli_error($con);
}
?>