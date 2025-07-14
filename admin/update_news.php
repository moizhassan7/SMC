<?php
include_once "../config.php";

$id = mysqli_real_escape_string($con, $_POST['id']);
$title = mysqli_real_escape_string($con, $_POST['title']);
$description = mysqli_real_escape_string($con, $_POST['description']);
$event_date = mysqli_real_escape_string($con, $_POST['event_date']);
$full_article = mysqli_real_escape_string($con, $_POST['full_article']);

// Get current event data to handle image updates
$res = mysqli_query($con, "SELECT image_url, additional_images FROM news_events WHERE id='$id'");
$row = mysqli_fetch_array($res);

$current_main_image = $row['image_url'];
$current_additional_images = !empty($row['additional_images']) ? explode(',', $row['additional_images']) : [];

// Handle main image update
$image_name = $current_main_image;
if (isset($_POST['delete_main_image']) && $_POST['delete_main_image'] == '1') {
    if (!empty($current_main_image) && file_exists("../images/" . $current_main_image)) {
        unlink("../images/" . $current_main_image); // Delete old file
    }
    $image_name = '';
}
if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
    if (!empty($current_main_image) && file_exists("../images/" . $current_main_image)) {
        unlink("../images/" . $current_main_image); // Delete old file
    }
    $image_name = time() . '_' . basename($_FILES['image_url']['name']);
    $target = "../images/" . $image_name;
    move_uploaded_file($_FILES['image_url']['tmp_name'], $target);
}

// Handle additional images update
$updated_additional_images = $current_additional_images;

// Remove selected images
if (isset($_POST['delete_additional_images']) && is_array($_POST['delete_additional_images'])) {
    foreach ($_POST['delete_additional_images'] as $img_to_delete) {
        if (($key = array_search($img_to_delete, $updated_additional_images)) !== false) {
            unset($updated_additional_images[$key]);
            if (file_exists("../images/" . $img_to_delete)) {
                unlink("../images/" . $img_to_delete); // Delete file
            }
        }
    }
}
$updated_additional_images = array_values($updated_additional_images); // Re-index array

// Add new additional images
if (isset($_FILES['additional_images']) && count($_FILES['additional_images']['name']) > 0) {
    foreach ($_FILES['additional_images']['name'] as $key => $name) {
        if ($_FILES['additional_images']['error'][$key] == 0) {
            $new_image_name = time() . '_' . rand(1000, 9999) . '_' . basename($name);
            $target_additional = "../images/" . $new_image_name;
            if (move_uploaded_file($_FILES['additional_images']['tmp_name'][$key], $target_additional)) {
                $updated_additional_images[] = $new_image_name;
            }
        }
    }
}
$additional_images_string = implode(',', $updated_additional_images);

$q = mysqli_query($con, "UPDATE news_events SET
                            title = '$title',
                            description = '$description',
                            event_date = '$event_date',
                            full_article = '$full_article',
                            image_url = '$image_name',
                            additional_images = '$additional_images_string'
                            WHERE id = '$id'");

if ($q) {
    header('Location: view_news.php');
    exit();
} else {
    echo "Error: " . mysqli_error($con);
}
?>