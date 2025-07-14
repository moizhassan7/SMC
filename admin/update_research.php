<?php
include_once "../config.php";

$id = mysqli_real_escape_string($con, $_POST['id']);
$title = mysqli_real_escape_string($con, $_POST['title']);
$authors = mysqli_real_escape_string($con, $_POST['authors']);
$publication_date = mysqli_real_escape_string($con, $_POST['publication_date']);
$abstract = mysqli_real_escape_string($con, $_POST['abstract']);
$keywords = mysqli_real_escape_string($con, $_POST['keywords']);
$external_link = mysqli_real_escape_string($con, $_POST['external_link']);
$is_published = isset($_POST['is_published']) ? 1 : 0;

// Fetch current file_url from the database
$res = mysqli_query($con, "SELECT file_url FROM research_papers WHERE id='$id'");
$row = mysqli_fetch_assoc($res);
$current_file_url = $row['file_url'];

$new_file_name = $current_file_url; // Assume existing file remains unless changed or deleted

// Handle file deletion
if (isset($_POST['delete_file']) && $_POST['delete_file'] == '1') {
    if (!empty($current_file_url) && file_exists("../files/" . $current_file_url)) {
        unlink("../files/" . $current_file_url); // Delete the physical file
    }
    $new_file_name = ''; // Set file_url to empty in DB
}

// Handle new file upload
if (isset($_FILES['file_url']) && $_FILES['file_url']['error'] == 0) {
    $file_info = pathinfo($_FILES['file_url']['name']);
    $file_extension = strtolower($file_info['extension']);
    $allowed_extensions = ['pdf', 'doc', 'docx'];

    if (in_array($file_extension, $allowed_extensions)) {
        // Delete old file if a new one is uploaded and old one exists
        if (!empty($current_file_url) && file_exists("../files/" . $current_file_url)) {
            unlink("../files/" . $current_file_url);
        }

        $new_file_name = time() . '_' . basename($_FILES['file_url']['name']);
        $target_dir = "../files/";
        $target_file = $target_dir . $new_file_name;

        if (!move_uploaded_file($_FILES['file_url']['tmp_name'], $target_file)) {
            echo "Error uploading new file. Please check permissions for 'files/' directory.";
            // Keep the old file name if new upload fails, unless it was marked for deletion
            $new_file_name = (isset($_POST['delete_file']) && $_POST['delete_file'] == '1') ? '' : $current_file_url;
        }
    } else {
        echo "Invalid new file type. Only PDF, DOC, DOCX are allowed.";
        // Keep the old file name if new upload is invalid, unless it was marked for deletion
        $new_file_name = (isset($_POST['delete_file']) && $_POST['delete_file'] == '1') ? '' : $current_file_url;
    }
}

$q = mysqli_query($con, "UPDATE research_papers SET
                            title = '$title',
                            authors = '$authors',
                            publication_date = '$publication_date',
                            abstract = '$abstract',
                            keywords = '$keywords',
                            file_url = '$new_file_name',
                            external_link = '$external_link',
                            is_published = '$is_published'
                            WHERE id = '$id'");

if ($q) {
    header('Location: view_research.php');
    exit();
} else {
    echo "Error: " . mysqli_error($con);
}
?>