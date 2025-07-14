<?php
session_start();
include "config.php";
include_once "header.php";

// Fetch published research papers, ordered by publication date
$sql = "SELECT * FROM research_papers WHERE is_published = TRUE ORDER BY publication_date DESC";
$result = $con->query($sql);
$siteSettings = [];
$settings_q = mysqli_query($con, "SELECT setting_key, setting_value FROM site_settings");
while ($row = mysqli_fetch_assoc($settings_q)) {
    $siteSettings[$row['setting_key']] = $row['setting_value'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Research - Sargodha Medical Collage</title>
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
            --border-color: #ddd;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-gray);
            color: var(--dark-text);
            line-height: 1.7;
        }

        /* Hero section */
        .page-hero {
            position: relative;
            height: 35vh;
            background: url('images/research.jpg') no-repeat center center/cover; /* Custom hero image */
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            margin-top: -1px;
        }

        .page-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Dark overlay */
            z-index: 1;
        }

        .page-hero h1 {
            font-size: 3.5em;
            font-weight: 700;
            z-index: 2;
            position: relative;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.7);
        }

        .section-title {
            color: var(--primary-color);
            font-size: 2.8em;
            font-weight: 700;
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

        .research-paper-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 30px;
            margin-bottom: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%; /* Ensure consistent height in grid */
            display: flex;
            flex-direction: column;
        }

        .research-paper-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .research-paper-title {
            color: var(--primary-color);
            font-size: 1.8em;
            font-weight: 700;
            margin-bottom: 10px;
            line-height: 1.3;
        }

        .research-meta {
            font-size: 0.95em;
            color: var(--light-text);
            margin-bottom: 15px;
        }

        .research-meta i {
            margin-right: 5px;
            color: var(--secondary-color);
        }

        .research-abstract {
            font-size: 1em;
            color: var(--dark-text);
            margin-bottom: 20px;
            flex-grow: 1; /* Allow abstract to take available space */
            display: -webkit-box;
            -webkit-line-clamp: 5; /* Limit abstract to 5 lines */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .research-links a {
            display: inline-block;
            margin-right: 15px;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .research-links a:hover {
            color: var(--secondary-color);
        }

        .no-research-found {
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
        @media (max-width: 991.98px) {
            .page-hero h1 {
                font-size: 3em;
            }
            .research-paper-title {
                font-size: 1.5em;
            }
        }

        @media (max-width: 767.98px) {
            .page-hero {
                height: 25vh;
            }
            .page-hero h1 {
                font-size: 2.5em;
            }
            .section-title {
                font-size: 2.2em;
                margin-bottom: 30px;
            }
            .research-paper-card {
                padding: 20px;
            }
            .research-paper-title {
                font-size: 1.3em;
            }
            .research-abstract {
                font-size: 0.95em;
            }
        }
    </style>
</head>
<body>

<div class="page-hero" style="background-image: url('images/<?= htmlspecialchars($siteSettings['research_hero_banner'] ?? 'placeholder_research.jpg') ?>');">
    <h1>Our Research & Publications</h1>
</div>

<div class="container py-5">
    <h2 class="section-title">Recent Papers & Projects</h2>

    <?php if ($result->num_rows > 0): ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="col d-flex">
                    <div class="research-paper-card">
                        <h3 class="research-paper-title"><?= htmlspecialchars($row['title']) ?></h3>
                        <div class="research-meta">
                            <?php if (!empty($row['authors'])): ?>
                                <span><i class="fas fa-user-friends"></i> <?= htmlspecialchars($row['authors']) ?></span><br>
                            <?php endif; ?>
                            <?php if (!empty($row['publication_date'])): ?>
                                <span><i class="far fa-calendar-alt"></i> <?= date("F j, Y", strtotime($row['publication_date'])) ?></span>
                            <?php endif; ?>
                        </div>
                        <p class="research-abstract"><?= nl2br(htmlspecialchars($row['abstract'])) ?></p>
                       <div class="research-links mt-auto">
                            <a href="research_detail.php?id=<?= $row['id'] ?>" class="btn btn-primary-research">Read More <i class="fas fa-arrow-right ms-2"></i></a>
                            <?php if (!empty($row['file_url'])): ?>
                                <a href="files/<?= htmlspecialchars($row['file_url']) ?>" target="_blank" class="btn btn-outline-secondary-research ms-2"><i class="fas fa-file-pdf me-1"></i> PDF</a>
                            <?php endif; ?>
                            <?php if (!empty($row['external_link'])): ?>
                                <a href="<?= htmlspecialchars($row['external_link']) ?>" target="_blank" class="btn btn-outline-secondary-research ms-2"><i class="fas fa-external-link-alt me-1"></i> External Link</a>
                            <?php endif; ?>
                        </div>
                        
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="no-research-found">
            <p><i class="far fa-sad-tear me-2"></i>No research papers or projects to display yet. Please check back later!</p>
        </div>
    <?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include'footer.php'; ?>
</body>
</html>

<?php $con->close(); ?>