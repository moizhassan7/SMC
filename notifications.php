<?php
session_start();
include "config.php"; // Database connection
include_once "header.php"; // Your site's header

$sql = "SELECT * FROM notifications "; 
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - SMC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #800000; /* Maroon */
            --secondary-color: #660000; /* Darker Maroon */
            --light-gray: #f9f9f9;
            --dark-text: #333;
            --light-text: #666;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-gray);
            color: var(--dark-text);
        }

        .section-title {
            color: var(--primary-color);
            font-size: 2.8em; /* Slightly larger for impact */
            font-weight: 700; /* Bolder */
            margin-bottom: 40px;
            text-align: center;
            position: relative;
            padding-bottom: 15px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background-color: var(--primary-color);
            border-radius: 2px;
        }

        .notification-card { /* Renamed from .event-card */
            background-color: white;
            border-radius: 8px; /* Rounded corners */
            overflow: hidden; /* Ensures image corners match card */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08); /* More pronounced shadow */
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            display: flex; /* Flexbox for internal layout */
            flex-direction: column; /* Stack content vertically */
            height: 100%; /* Ensures cards in a row have same height */
        }

        .notification-card:hover { /* Renamed from .event-card:hover */
            transform: translateY(-5px); /* More noticeable lift */
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .notification-card img { /* Renamed from .event-card img */
            width: 100%;
            height: 220px; /* Fixed height for consistent image size */
            object-fit: cover; /* Ensures images cover the area without distortion */
            border-top-left-radius: 8px; /* Match card border radius */
            border-top-right-radius: 8px; /* Match card border radius */
        }

        .notification-card-body {
            padding: 25px; /* More padding */
            display: flex;
            flex-direction: column;
            flex-grow: 1; /* Allows body to expand */
        }

        .notification-title { /* Renamed from .notification-title */
            font-size: 1.6em; /* Slightly larger for emphasis */
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 15px;
            line-height: 1.3;
        }

        .notification-description { /* Added for the description */
            color: var(--light-text);
            font-size: 0.95em;
            margin-bottom: 15px;
            flex-grow: 1; /* Allows description to take available space */
        }

        .btn-view-more { /* Renamed from .btn-read-more */
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 600;
            align-self: flex-start; /* Aligns button to the left */
            transition: background-color 0.3s ease;
            text-decoration: none; /* Ensure no underline */
        }

        .btn-view-more:hover { /* Renamed from .btn-read-more:hover */
            background-color: var(--secondary-color);
            color: white; /* Keep text white on hover */
        }

        .no-notifications-found { /* Renamed from .no-events-found */
            text-align: center;
            padding: 50px 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-top: 30px;
            color: var(--light-text);
            font-size: 1.2em;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .section-title {
                font-size: 2.2em;
            }
            .notification-card img {
                height: 180px;
            }
            .notification-title {
                font-size: 1.2em;
            }
        }
    </style>
</head>
<body>

<div class="container py-5">
    <h2 class="section-title">Notifications</h2>

    <?php if ($result->num_rows > 0): ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="col d-flex">
                    <div class="notification-card">
                        <?php
                        // Determine if it's an image or other file type for display
                        $file_extension = pathinfo($row['image_url'], PATHINFO_EXTENSION);
                        $is_image = in_array(strtolower($file_extension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']);
                        ?>

                        <?php if (!empty($row['image_url'])): ?>
                            <?php if ($is_image): ?>
                                <img src="images/<?= htmlspecialchars($row['image_url']) ?>" class="card-img-top" alt="Notification Image">
                            <?php else: ?>
                                <div style="height: 220px; width: 100%; display: flex; align-items: center; justify-content: center; background-color: #f0f0f0; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                                    <i class="fas fa-file-alt fa-5x" style="color: var(--primary-color);"></i>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div style="height: 220px; width: 100%; display: flex; align-items: center; justify-content: center; background-color: #f0f0f0; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                                <i class="fas fa-bell fa-5x" style="color: var(--primary-color);"></i>
                            </div>
                        <?php endif; ?>

                        <div class="notification-card-body">
                            <h5 class="notification-title"><?= htmlspecialchars($row['title']) ?></h5>
                            <?php if (!empty($row['image_url'])): ?>
                                <a href="images/<?= htmlspecialchars($row['image_url']) ?>" target="_blank" class="btn btn-view-more mt-auto">View More <i class="fas fa-external-link-alt ms-2"></i></a>
                            <?php else: ?>
                                <button type="button" class="btn btn-secondary mt-auto" disabled>No File to View</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="no-notifications-found">
            <p><i class="far fa-sad-tear me-2"></i>Currently, there are no notifications to display. Please check back later!</p>
        </div>
    <?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php include_once 'footer.php'; // Your site's footer ?>
<?php $con->close(); ?>