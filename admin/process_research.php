<?php
include_once "../config.php";

$title = mysqli_real_escape_string($con, $_POST['title']);
$authors = mysqli_real_escape_string($con, $_POST['authors']);
$publication_date = mysqli_real_escape_string($con, $_POST['publication_date']);
$abstract = mysqli_real_escape_string($con, $_POST['abstract']);
$keywords = mysqli_real_escape_string($con, $_POST['keywords']);
$external_link = mysqli_real_escape_string($con, $_POST['external_link']);
$is_published = isset($_POST['is_published']) ? 1 : 0;

$file_name = '';
if (isset($_FILES['file_url']) && $_FILES['file_url']['error'] == 0) {
    $file_info = pathinfo($_FILES['file_url']['name']);
    $file_extension = strtolower($file_info['extension']);
    $allowed_extensions = ['pdf', 'doc', 'docx']; // Allowed file types

    if (in_array($file_extension, $allowed_extensions)) {
        $file_name = time() . '_' . basename($_FILES['file_url']['name']);
        $target_dir = "../files/"; // Directory for research files
        $target_file = $target_dir . $file_name;

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        if (!move_uploaded_file($_FILES['file_url']['tmp_name'], $target_file)) {
            echo "Error uploading file. Please check permissions for 'files/' directory.";
            $file_name = ''; // Reset file name if upload fails
        }
    } else {
        echo "Invalid file type. Only PDF, DOC, DOCX are allowed.";
    }
}

$q = mysqli_query($con, "INSERT INTO research_papers (title, authors, publication_date, abstract, keywords, file_url, external_link, is_published)
                         VALUES ('$title', '$authors', '$publication_date', '$abstract', '$keywords', '$file_name', '$external_link', '$is_published')");

if ($q) {
    header('Location: view_research.php');
    exit();
} else {
    echo "Error: " . mysqli_error($con);
}
?>