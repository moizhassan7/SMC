<?php
include_once "../config.php";

$department_id = mysqli_real_escape_string($con, $_POST['department_id']);
$name = mysqli_real_escape_string($con, $_POST['name']);
$designation = mysqli_real_escape_string($con, $_POST['designation']);
$details = mysqli_real_escape_string($con, $_POST['details']);

$image_name = '';
if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
    $image_name = time() . '_' . basename($_FILES['image_url']['name']);
    $target_dir = "../images/";
    $target_file = $target_dir . $image_name;
    if (!is_dir($target_dir)) { mkdir($target_dir, 0777, true); }
    move_uploaded_file($_FILES['image_url']['tmp_name'], $target_file);
}

$q = mysqli_query($con, "INSERT INTO staff_members (department_id, name, designation, details, image_url)
                         VALUES ('$department_id', '$name', '$designation', '$details', '$image_name')");

if ($q) {
    header('Location: manage_staff.php?dept_id=' . $department_id);
    exit();
} else {
    echo "Error: " . mysqli_error($con);
}
?>