<?php
include_once "../config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "../images/"; 

    foreach ($_FILES as $input_name => $file_data) {
        if (strpos($input_name, '_file') === false) { // Skip non-file inputs
            continue;
        }

        $setting_key = str_replace('_file', '', $input_name); // Get setting key from input name
        $current_file_name_in_db = '';

        // Fetch current file name from DB to handle deletions/replacements
        $res = mysqli_query($con, "SELECT setting_value FROM site_settings WHERE setting_key = '$setting_key'");
        if ($res && mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            $current_file_name_in_db = $row['setting_value'];
        }

        $new_file_name = $current_file_name_in_db; // Default to existing file name

        // 1. Handle deletion request
        if (isset($_POST['delete_' . $setting_key]) && $_POST['delete_' . $setting_key] == '1') {
            if (!empty($current_file_name_in_db) && file_exists($target_dir . $current_file_name_in_db)) {
                unlink($target_dir . $current_file_name_in_db);
            }
            $new_file_name = ''; // Mark for deletion in DB
        }

        // 2. Handle new file upload
        if ($file_data['error'] == 0 && $file_data['size'] > 0) {
            $imageFileType = strtolower(pathinfo($file_data['name'], PATHINFO_EXTENSION));
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($imageFileType, $allowed_types)) {
                // Delete old file if a new one is uploaded and old one existed
                if (!empty($current_file_name_in_db) && file_exists($target_dir . $current_file_name_in_db)) {
                    unlink($target_dir . $current_file_name_in_db);
                }

                $new_file_name_generated = time() . '_' . rand(1000, 9999) . '.' . $imageFileType;
                $target_file = $target_dir . $new_file_name_generated;

                if (move_uploaded_file($file_data['tmp_name'], $target_file)) {
                    $new_file_name = $new_file_name_generated; // Update to the new file name
                } else {
                    echo "Error uploading new file for " . htmlspecialchars($setting_key) . ".<br>";
                    // If new upload fails, revert to previous state unless marked for delete
                    $new_file_name = (isset($_POST['delete_' . $setting_key]) && $_POST['delete_' . $setting_key] == '1') ? '' : $current_file_name_in_db;
                }
            } else {
                echo "Invalid file type for " . htmlspecialchars($setting_key) . ". Allowed: JPG, PNG, GIF.<br>";
                // If new upload is invalid type, revert to previous state unless marked for delete
                $new_file_name = (isset($_POST['delete_' . $setting_key]) && $_POST['delete_' . $setting_key] == '1') ? '' : $current_file_name_in_db;
            }
        }

        // Update the database only if the file name has changed OR was deleted
        if ($new_file_name !== $current_file_name_in_db || (isset($_POST['delete_' . $setting_key]) && $_POST['delete_' . $setting_key] == '1')) {
            $escaped_new_file_name = mysqli_real_escape_string($con, $new_file_name);
            $escaped_setting_key = mysqli_real_escape_string($con, $setting_key);

            // UPSERT (UPDATE if exists, INSERT if not)
            $sql = "INSERT INTO site_settings (setting_key, setting_value) VALUES ('$escaped_setting_key', '$escaped_new_file_name')
                    ON DUPLICATE KEY UPDATE setting_value = '$escaped_new_file_name'";
            
            if (!mysqli_query($con, $sql)) {
                echo "Error updating DB for " . htmlspecialchars($setting_key) . ": " . mysqli_error($con) . "<br>";
            }
        }
    }
    echo "Site images updated successfully.";
    header('Location: manage_site_images.php?status=success');
    exit();
} else {
    header('Location: manage_site_images.php');
    exit();
}
?>