<?php
session_start();
include "config.php"; // Database connection
include_once "header.php";

// Fetch downloads
// We'll order by upload_date, assuming that's when the download entry was created.
$sql = "SELECT * FROM downloads ORDER BY upload_date DESC";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Downloads - SMC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
        }

        .section-title {
            color: #800000;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
        }

        .download-card {
            background-color: white;
            border-left: 5px solid #800000;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            padding: 20px;
            margin-bottom: 20px;
            display: flex; /* For alignment of title and button */
            justify-content: space-between; /* To push button to the right */
            align-items: center; /* Vertically align items */
        }

        .download-title {
            font-size: 22px;
            font-weight: 600;
            color: #333;
        }

        .btn-download {
            background-color: #800000;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-download:hover {
            background-color: #660000;
            color: white; /* Keep text white on hover */
        }
    </style>
</head>
<body>

<div class="container py-5">
    <h2 class="section-title">Downloads</h2>

    <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="download-card">
                <div class="download-details">
                    <div class="download-title"><?= htmlspecialchars($row['title']) ?></div>
                    <?php if (!empty($row['description'])): ?>
                        <p class="mb-0"><?= htmlspecialchars($row['description']) ?></p>
                    <?php endif; ?>
                </div>
                <a href="uploads/<?= htmlspecialchars($row['file_path']) ?>" class="btn btn-download" download>
                    <i class="fas fa-download me-2"></i> Download
                </a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="text-center">No downloads found.</p>
    <?php endif; ?>

</div>

<script src="https://kit.fontawesome.com/your-font-awesome-kit-id.js" crossorigin="anonymous"></script>

</body>
</html>
<?php include_once "footer.php"; ?>
<?php $con->close(); ?>