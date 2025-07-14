<?php
include_once "../config.php";

$id = mysqli_real_escape_string($con, $_POST['id']);
$faculty_id = mysqli_real_escape_string($con, $_POST['faculty_id']);
$name = mysqli_real_escape_string($con, $_POST['name']);
$overview = mysqli_real_escape_string($con, $_POST['overview']);

$res = mysqli_query($con, "SELECT image_url FROM departments WHERE id='$id'");
$row = mysqli_fetch_assoc($res);
$current_image_url = $row['image_url'];

$new_image_name = $current_image_url;

if (isset($_POST['delete_image']) && $_POST['delete_image'] == '1') {
    if (!empty($current_image_url) && file_exists("../images/" . $current_image_url)) {
        unlink("../images/" . $current_image_url);
    }
    $new_image_name = '';
}

if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
    if (!empty($current_image_url) && file_exists("../images/" . $current_image_url)) {
        unlink("../images/" . $current_image_url);
    }
    $new_image_name = time() . '_' . basename($_FILES['image_url']['name']);
    $target_dir = "../images/";
    $target_file = $target_dir . $new_image_name;
    move_uploaded_file($_FILES['image_url']['tmp_name'], $target_file);
}

$q = mysqli_query($con, "UPDATE departments SET
                            faculty_id = '$faculty_id',
                            name = '$name',
                            overview = '$overview',
                            image_url = '$new_image_name'
                            WHERE id = '$id'");

if ($q) {
    header('Location: view_departments.php');
    exit();
} else {
    echo "Error: " . mysqli_error($con);
}
?>