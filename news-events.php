<?php
session_start();
include "config.php";
include_once "header.php";

$sql = "SELECT * FROM news_events ORDER BY event_date DESC";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News & Events - SMC</title>
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

        .event-card {
            background-color: white;
            border-radius: 8px; /* Rounded corners */
            overflow: hidden; /* Ensures image corners match card */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08); /* More pronounced shadow */
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            display: flex; /* Flexbox for internal layout */
            flex-direction: column; /* Stack content vertically */
            height: 100%; /* Ensures cards in a row have same height */
        }

        .event-card:hover {
            transform: translateY(-5px); /* More noticeable lift */
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .event-card img {
            width: 100%;
            height: 220px; /* Fixed height for consistent image size */
            object-fit: cover; /* Ensures images cover the area without distortion */
            border-top-left-radius: 8px; /* Match card border radius */
            border-top-right-radius: 8px; /* Match card border radius */
        }

        .event-card-body {
            padding: 25px; /* More padding */
            display: flex;
            flex-direction: column;
            flex-grow: 1; /* Allows body to expand */
        }

        .event-date {
            color: var(--primary-color);
            font-weight: 600;
            font-size: 0.95em;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .event-date i {
            margin-right: 8px;
            color: var(--secondary-color); /* Icon color */
        }

        .event-title {
            font-size: 1.6em; /* Slightly larger for emphasis */
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 15px;
            line-height: 1.3;
        }

        .event-description {
            font-size: 1em;
            color: var(--light-text);
            margin-bottom: 20px;
            flex-grow: 1; /* Allows description to take available space */
            /* Optional: Limit description to a few lines */
            display: -webkit-box;
            -webkit-line-clamp: 3; /* Show max 3 lines */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .btn-read-more {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 600;
            align-self: flex-start; /* Aligns button to the left */
            transition: background-color 0.3s ease;
        }

        .btn-read-more:hover {
            background-color: var(--secondary-color);
            color: white; /* Keep text white on hover */
        }

        .no-events-found {
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
            .event-card img {
                height: 180px;
            }
            .event-title {
                font-size: 1.4em;
            }
        }
    </style>
</head>
<body>

<div class="container py-5">
    <h2 class="section-title">News & Events</h2>
    

    <?php if ($result->num_rows > 0): ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4"> <?php while($row = $result->fetch_assoc()): ?>
                <div class="col d-flex"> <div class="event-card">
                        <?php if (!empty($row['image_url'])): ?>
                            <img src="images/<?= htmlspecialchars($row['image_url']) ?>" class="card-img-top" alt="Event Image">
                        <?php endif; ?>

                        <div class="event-card-body">
                            <div class="event-date">
                                <i class="far fa-calendar-alt"></i> <?= date("F d, Y", strtotime($row['event_date'])) ?>
                            </div>
                            <h5 class="event-title"><?= htmlspecialchars($row['title']) ?></h5>
                            <p class="event-description"><?= htmlspecialchars($row['description']) ?></p>
                            <a href="event-details.php?id=<?= $row['id'] ?>" class="btn btn-read-more mt-auto">Read More</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="no-events-found">
            <p><i class="far fa-sad-tear me-2"></i>Currently, there are no news or events to display. Please check back later!</p>
        </div>
    <?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php include'footer.php'; ?>
<?php $con->close(); ?>