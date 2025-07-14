<?php
include_once "../config.php";

$chairman_id = mysqli_real_escape_string($con, $_POST['chairman_id']);
$department_id = mysqli_real_escape_string($con, $_POST['department_id']);
$name = mysqli_real_escape_string($con, $_POST['name']);
$designation = mysqli_real_escape_string($con, $_POST['designation']);
$message = mysqli_real_escape_string($con, $_POST['message']);

$res = mysqli_query($con, "SELECT image_url FROM chairmen WHERE id='$chairman_id'");
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

$q = mysqli_query($con, "UPDATE chairmen SET
                            name = '$name',
                            designation = '$designation',
                            message = '$message',
                            image_url = '$new_image_name'
                            WHERE id = '$chairman_id'");

if ($q) {
    header('Location: manage_chairman.php?dept_id=' . $department_id);
    exit();
} else {
    echo "Error: " . mysqli_error($con);
}
?>