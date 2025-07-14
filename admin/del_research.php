<?php
include_once "../config.php";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Fetch file_url before deleting the record
    $res = mysqli_query($con, "SELECT file_url FROM research_papers WHERE id='$id'");
    $row = mysqli_fetch_assoc($res);
    $file_to_delete = $row['file_url'];

    $q = mysqli_query($con, "DELETE FROM research_papers WHERE id='$id'");

    if ($q) {
        // Delete the physical file if it exists
        if (!empty($file_to_delete) && file_exists("../files/" . $file_to_delete)) {
            unlink("../files/" . $file_to_delete);
        }
        header('Location: view_research.php');
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }
} else {
    header('Location: view_research.php');
    exit();
}
?>