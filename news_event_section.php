<style>
    /* Custom styles for Latest Events Section */
.latest-events-section {
    background-color: var(--light-gray); /* Match your body background */
    padding: 60px 0; /* Consistent vertical padding */
}

/* Reusing existing section-title but ensuring it's centered */
.latest-events-section .section-title {
    color: var(--primary-color); /* Maroon */
    font-size: 2.8em;
    font-weight: 700;
    margin-bottom: 40px;
    text-align: center;
    position: relative;
    padding-bottom: 15px;
}

.latest-events-section .section-title::after {
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

.event-card-latest {
    background-color: white;
    border-radius: 10px; /* Slightly more rounded corners */
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1); /* More pronounced shadow */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    height: 100%; /* Ensures cards in a row have same height */
    border: 1px solid #e0e0e0; /* Subtle border */
}

.event-card-latest:hover {
    transform: translateY(-8px); /* More noticeable lift */
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
}

.event-card-latest img {
    width: 100%;
    height: 250px; /* Fixed height for consistent image size */
    object-fit: cover; /* Ensures images cover the area without distortion */
    border-bottom: 1px solid #f0f0f0; /* Separator for image */
}

.card-body-latest {
    padding: 25px; /* Ample padding */
    display: flex;
    flex-direction: column;
    flex-grow: 1; /* Allows body to expand */
}

.event-date-latest {
    font-size: 0.95em;
    color: var(--secondary-color); /* Darker Maroon for date */
    font-weight: 600;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
}

.event-date-latest i {
    color: var(--primary-color); /* Maroon icon */
    margin-right: 8px;
}

.card-title-latest {
    font-size: 1.5em; /* Prominent title */
    font-weight: 700;
    color: var(--dark-text); /* Dark text color */
    margin-bottom: 15px;
    line-height: 1.3;
    display: -webkit-box;
    -webkit-line-clamp: 2; /* Limit title to 2 lines */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}

.card-text-latest {
    font-size: 1em;
    color: var(--light-text);
    margin-bottom: 20px;
    flex-grow: 1; /* Allows description to take available space */
    display: -webkit-box;
    -webkit-line-clamp: 3; /* Limit description to 3 lines */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}

.btn-primary-latest {
    background-color: var(--primary-color); /* Maroon button */
    color: white;
    border: none;
    padding: 10px 25px;
    border-radius: 6px;
    font-weight: 600;
    align-self: flex-start; /* Aligns button to the left */
    transition: background-color 0.3s ease, transform 0.2s ease;
    text-decoration: none; /* Ensure no underline */
}

.btn-primary-latest:hover {
    background-color: var(--secondary-color); /* Darker Maroon on hover */
    transform: translateY(-2px); /* Slight lift on hover */
    color: white; /* Keep text white on hover */
}

.btn-outline-primary-latest {
    border: 2px solid var(--primary-color);
    color: var(--primary-color);
    background-color: transparent;
    padding: 12px 30px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-outline-primary-latest:hover {
    background-color: var(--primary-color);
    color: white;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
}

/* Responsive Adjustments */
@media (max-width: 991.98px) {
    .event-card-latest img {
        height: 220px;
    }
    .card-title-latest {
        font-size: 1.3em;
    }
}

@media (max-width: 767.98px) {
    .latest-events-section .section-title {
        font-size: 2.2em;
    }
    .event-card-latest img {
        height: 200px;
    }
    .card-body-latest {
        padding: 20px;
    }
    .card-title-latest {
        font-size: 1.2em;
    }
    .card-text-latest {
        font-size: 0.95em;
    }
    .btn-primary-latest {
        padding: 8px 20px;
    }
    .btn-outline-primary-latest {
        padding: 10px 25px;
        font-size: 0.95em;
    }
}
</style>
<?php
// Ensure config.php is included to get $con (database connection)
if (!isset($con)) {
    include "config.php";
}

// Fetch the latest 3 news/events
$latest_events_sql = "SELECT id, title, description, event_date, image_url FROM news_events ORDER BY event_date DESC LIMIT 3";
$latest_events_result = $con->query($latest_events_sql);
?>

<section class="latest-events-section py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5">Latest News & Events</h2>

        <?php if ($latest_events_result->num_rows > 0): ?>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php while($event = $latest_events_result->fetch_assoc()): ?>
                    <div class="col d-flex">
                        <div class="event-card-latest">
                            <?php if (!empty($event['image_url'])): ?>
                                <img src="images/<?= htmlspecialchars($event['image_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($event['title']) ?>">
                            <?php else: ?>
                                <img src="https://via.placeholder.com/400x250?text=Event+Image" class="card-img-top" alt="Placeholder Event Image">
                            <?php endif; ?>
                            <div class="card-body-latest">
                                <div class="event-date-latest">
                                    <i class="far fa-calendar-alt me-2"></i>
                                    <?= date("F d, Y", strtotime($event['event_date'])) ?>
                                </div>
                                <h3 class="card-title-latest"><?= htmlspecialchars($event['title']) ?></h3>
                                <p class="card-text-latest">
                                    <?= htmlspecialchars(substr($event['description'], 0, 120)) . (strlen($event['description']) > 120 ? '...' : '') ?>
                                </p>
                                <a href="event-details.php?id=<?= $event['id'] ?>" class="btn btn-primary-latest mt-auto">Read More</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="text-center mt-5">
                <a href="news-events.php" class="btn btn-outline-primary-latest btn-lg">View All News & Events <i class="fas fa-arrow-right ms-2"></i></a>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center" role="alert">
                <i class="fas fa-info-circle me-2"></i> No upcoming news or events to display at the moment. Please check back soon!
            </div>
        <?php endif; ?>
    </div>
</section>