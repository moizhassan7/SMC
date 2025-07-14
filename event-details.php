<?php
session_start();
include "config.php";
include_once "header.php";

// Get event ID from URL and sanitize it
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch current event
$sql = "SELECT * FROM news_events WHERE id = $id";
$result = $con->query($sql);
$event = $result->fetch_assoc();

// Check if event exists
if (!$event) {
    // Redirect or display an error if event not found
    header("Location: news-events.php?error=eventnotfound");
    exit();
}

// Prepare additional images for display
$additional_images = [];
if (!empty($event['additional_images'])) {
    $additional_images = explode(',', $event['additional_images']);
    // Filter out any empty strings that might result from multiple commas
    $additional_images = array_filter($additional_images);
}

// Fetch more news (excluding current one), limited to 3
$more_news_sql = "SELECT * FROM news_events WHERE id != $id ORDER BY event_date DESC LIMIT 3";
$more_news_result = $con->query($more_news_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($event['title']) ?> - SMC</title>
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
            --border-color: #eee;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-gray);
            color: var(--dark-text);
            line-height: 1.7; /* Improved readability for paragraphs */
        }

        .container {
            padding-top: 40px;
            padding-bottom: 40px;
        }

        /* Main Event Content */
        .event-detail-content {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 30px;
        }

        .event-detail-title {
            color: var(--primary-color);
            font-size: 2.5em; /* Larger title */
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .event-meta {
            font-size: 0.95em;
            color: var(--light-text);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
        }

        .event-meta i {
            margin-right: 8px;
            color: var(--secondary-color);
        }

        .event-image {
            width: 100%;
            max-height: 450px; /* Taller main image */
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        /* Carousel for multiple images */
        .carousel-item img {
            width: 100%;
            height: 400px; /* Adjust height as needed */
            object-fit: cover;
            border-radius: 8px;
        }

        .carousel-indicators [data-bs-target] {
            background-color: var(--primary-color);
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            filter: invert(1); /* Make arrows visible on darker images */
        }
        /* End Carousel */


        .event-full-article {
            font-size: 1.05em; /* Slightly larger text for readability */
            color: var(--dark-text);
            margin-bottom: 30px;
        }

        .event-full-article p {
            margin-bottom: 1.5em; /* Space between paragraphs */
        }

        .back-button {
            background-color: #6c757d; /* Bootstrap secondary color */
            color: white;
            padding: 10px 25px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #5a6268;
            color: white;
        }

        /* More News Section (Sidebar) */
        .more-news-sidebar {
            position: sticky; /* Makes the sidebar stick as you scroll */
            top: 20px; /* Distance from the top of the viewport */
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 25px;
            margin-left: 20px; /* Space from main content */
        }

        .more-news-title-sidebar {
            color: var(--primary-color);
            font-size: 1.8em;
            font-weight: 700;
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--border-color);
        }

        .more-news-item {
            display: flex;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px dashed var(--border-color); /* Dashed separator */
            align-items: flex-start;
        }

        .more-news-item:last-child {
            border-bottom: none; /* No border for the last item */
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .more-news-image {
            width: 90px; /* Fixed width for thumbnail */
            height: 70px; /* Fixed height for thumbnail */
            object-fit: cover;
            border-radius: 4px;
            margin-right: 15px;
            flex-shrink: 0; /* Prevent image from shrinking */
        }

        .more-news-info {
            flex-grow: 1;
        }

        .more-news-info h6 {
            font-size: 1.1em;
            font-weight: 600;
            margin-bottom: 5px;
            line-height: 1.4;
        }

        .more-news-info h6 a {
            color: var(--dark-text);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .more-news-info h6 a:hover {
            color: var(--primary-color);
        }

        /* Responsive adjustments */
        @media (max-width: 991px) { /* Adjust for smaller desktops and tablets */
            .more-news-sidebar {
                position: static; /* Disable sticky on smaller screens */
                margin-left: 0;
                margin-top: 40px;
            }
        }

        @media (max-width: 767px) {
            .event-detail-title {
                font-size: 2em;
            }
            .event-image {
                max-height: 300px;
            }
            .event-detail-content, .more-news-sidebar {
                padding: 20px;
            }
            .carousel-item img {
                height: 250px; /* Adjust for mobile */
            }
        }
          /* Section Title Styling */
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
    </style>
</head>
<body>

<div class="container">
    <h2 class="section-title">News & Events</h2>
    <div class="row">
        <div class="col-lg-8">
            <div class="event-detail-content">
                <h1 class="event-detail-title"><?= htmlspecialchars($event['title']) ?></h1>
                
                <p class="event-meta">
                    <i class="far fa-calendar-alt"></i>
                    Published on: <?= date("F d, Y", strtotime($event['event_date'])) ?>
                </p>

                <?php if (!empty($event['image_url']) || !empty($additional_images)): ?>
                    <div id="eventImagesCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <?php if (!empty($event['image_url'])): ?>
                                <button type="button" data-bs-target="#eventImagesCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <?php endif; ?>
                            <?php
                            $indicator_index = !empty($event['image_url']) ? 1 : 0;
                            foreach ($additional_images as $index => $img): ?>
                                <button type="button" data-bs-target="#eventImagesCarousel" data-bs-slide-to="<?= $indicator_index + $index ?>" aria-label="Slide <?= $indicator_index + $index + 1 ?>"></button>
                            <?php endforeach; ?>
                        </div>
                        <div class="carousel-inner">
                            <?php if (!empty($event['image_url'])): ?>
                                <div class="carousel-item active">
                                    <img src="images/<?= htmlspecialchars($event['image_url']) ?>" class="d-block w-100" alt="<?= htmlspecialchars($event['title']) ?> Main Image">
                                </div>
                            <?php endif; ?>
                            <?php foreach ($additional_images as $img): ?>
                                <div class="carousel-item <?= empty($event['image_url']) && $img === $additional_images[0] ? 'active' : '' ?>">
                                    <img src="images/<?= htmlspecialchars($img) ?>" class="d-block w-100" alt="Additional Image">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php if (count($additional_images) > 0 || !empty($event['image_url']) && count($additional_images) > 0): ?>
                        <button class="carousel-control-prev" type="button" data-bs-target="#eventImagesCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#eventImagesCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <p class="text-muted text-center mt-3 mb-4">No images available for this event.</p>
                <?php endif; ?>

                <div class="event-full-article">
                    <p><strong>Description:</strong></p>
                    <p><?= nl2br(htmlspecialchars($event['description'])) ?></p>
                    
                    <?php if (!empty($event['full_article'])): ?>
                        <p><strong>Full Article:</strong></p>
                        <p><?= nl2br(htmlspecialchars($event['full_article'])) ?></p>
                    <?php endif; ?>
                </div>

                <a href="news-events.php" class="btn back-button mt-3">
                    <i class="fas fa-arrow-left me-2"></i> Back to News & Events
                </a>
            </div>
        </div>

        <div class="col-lg-4 d-none d-lg-block">
            <?php if ($more_news_result->num_rows > 0): ?>
                <div class="more-news-sidebar">
                    <h4 class="more-news-title-sidebar">More News</h4>
                    <?php while ($more = $more_news_result->fetch_assoc()): ?>
                        <div class="more-news-item">
                            <?php if (!empty($more['image_url'])): ?>
                                <img src="images/<?= htmlspecialchars($more['image_url']) ?>" alt="<?= htmlspecialchars($more['title']) ?> thumbnail" class="more-news-image">
                            <?php endif; ?>
                            <div class="more-news-info">
                                <h6><a href="event-details.php?id=<?= $more['id'] ?>"><?= htmlspecialchars($more['title']) ?></a></h6>
                                <small><?= date("F d, Y", strtotime($more['event_date'])) ?></small>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include'footer.php'; ?>
</body>
</html>

<?php $con->close(); ?>