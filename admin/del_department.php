<?php
include_once "../config.php";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $res = mysqli_query($con, "SELECT image_url FROM departments WHERE id='$id'");
    $row = mysqli_fetch_assoc($res);
    $image_to_delete = $row['image_url'];

    $q = mysqli_query($con, "DELETE FROM departments WHERE id='$id'");

    if ($q) {
        if (!empty($image_to_delete) && file_exists("../images/" . $image_to_delete)) {
            unlink("../images/" . $image_to_delete);
        }
        header('Location: view_departments.php');
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }
} else {
    header('Location: view_departments.php');
    exit();
}
?>