<?php
include_once "../config.php";

$title = mysqli_real_escape_string($con, $_POST['title']);
$event_date = mysqli_real_escape_string($con, $_POST['event_date']);
$description = mysqli_real_escape_string($con, $_POST['description']);
$full_article = mysqli_real_escape_string($con, $_POST['full_article']);

$image_name = '';
if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
    $image_name = time() . '_' . basename($_FILES['image_url']['name']);
    $target = "../images/" . $image_name;
    move_uploaded_file($_FILES['image_url']['tmp_name'], $target);
}

$additional_images_names = [];
if (isset($_FILES['additional_images']) && count($_FILES['additional_images']['name']) > 0) {
    foreach ($_FILES['additional_images']['name'] as $key => $name) {
        if ($_FILES['additional_images']['error'][$key] == 0) {
            $new_image_name = time() . '_' . rand(1000, 9999) . '_' . basename($name);
            $target_additional = "../images/" . $new_image_name;
            if (move_uploaded_file($_FILES['additional_images']['tmp_name'][$key], $target_additional)) {
                $additional_images_names[] = $new_image_name;
            }
        }
    }
}
$additional_images_string = implode(',', $additional_images_names);

$q = mysqli_query($con, "INSERT INTO news_events (title, event_date, description, full_article, image_url, additional_images)
                             VALUES ('$title', '$event_date', '$description', '$full_article', '$image_name', '$additional_images_string')");

if ($q) {
    header('Location: view_news.php');
    exit(); // Always exit after a header redirect
} else {
    echo "Error: " . mysqli_error($con);
}
?>