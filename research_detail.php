<?php
session_start();
include "config.php";
include_once "header.php";

// Get research ID from URL and sanitize it
$research_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($research_id == 0) {
    header("Location: research.php"); // Redirect if no ID provided
    exit();
}

// Fetch research paper details
$sql = "SELECT * FROM research_papers WHERE id = $research_id AND is_published = TRUE";
$result = $con->query($sql);
$paper = $result->fetch_assoc();
$siteSettings = [];
$settings_q = mysqli_query($con, "SELECT setting_key, setting_value FROM site_settings");
while ($row = mysqli_fetch_assoc($settings_q)) {
    $siteSettings[$row['setting_key']] = $row['setting_value'];}
// Check if research paper exists and is published
if (!$paper) {
    header("Location: research.php?error=notfound"); // Redirect if not found or not published
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($paper['title']) ?> - Research Detail</title>
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

        /* Hero section (can be reused from research.php or simpler) */
        .page-hero-small {
            position: relative;
            height: 50vh; /* Smaller hero for detail pages */
            background: url('images/research.jpg') no-repeat center center/cover; /* Custom hero image */
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            margin-top: -1px;
        }

        .page-hero-small::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6); /* Darker overlay for text on image */
            z-index: 1;
        }

        .page-hero-small h1 {
            font-size: 2.8em;
            font-weight: 700;
            z-index: 2;
            position: relative;
            text-shadow: 1px 1px 6px rgba(0,0,0,0.8);
            padding: 0 20px; /* Ensure text doesn't hit edges */
        }

        .research-detail-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 40px;
            margin-top: -60px; /* Overlap with hero */
            position: relative;
            z-index: 1;
        }

        .research-detail-title {
            color: var(--primary-color);
            font-size: 2.5em;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .research-detail-meta {
            font-size: 1em;
            color: var(--light-text);
            margin-bottom: 25px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 15px;
        }

        .research-detail-meta span {
            display: block;
            margin-bottom: 8px;
        }

        .research-detail-meta i {
            margin-right: 8px;
            color: var(--secondary-color);
        }

        .research-full-abstract {
            font-size: 1.1em;
            color: var(--dark-text);
            margin-bottom: 30px;
        }

        .research-full-abstract p {
            margin-bottom: 1.5em; /* Space between paragraphs */
        }

        .research-download-links a {
            display: inline-flex; /* To align icon and text */
            align-items: center;
            margin-right: 20px;
            margin-bottom: 15px; /* For stacking on small screens */
            background-color: var(--primary-color);
            color: white;
            padding: 10px 25px;
            border-radius: 5px;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .research-download-links a:hover {
            background-color: var(--secondary-color);
            color: white;
        }

        .research-download-links a i {
            margin-right: 8px;
        }

        .back-to-research-btn {
            background-color: #6c757d; /* Bootstrap secondary color */
            color: white;
            padding: 10px 25px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-top: 30px;
            display: inline-flex;
            align-items: center;
        }

        .back-to-research-btn:hover {
            background-color: #5a6268;
            color: white;
        }

        /* Responsive adjustments */
        @media (max-width: 991.98px) {
            .page-hero-small h1 {
                font-size: 2.2em;
            }
            .research-detail-card {
                padding: 30px;
            }
            .research-detail-title {
                font-size: 2em;
            }
        }

        @media (max-width: 767.98px) {
            .page-hero-small {
                height: 20vh;
            }
            .page-hero-small h1 {
                font-size: 1.8em;
            }
            .research-detail-card {
                padding: 20px;
                margin-top: -40px;
            }
            .research-detail-title {
                font-size: 1.5em;
            }
            .research-detail-meta {
                font-size: 0.9em;
            }
            .research-full-abstract {
                font-size: 1em;
            }
            .research-download-links a {
                width: 100%;
                margin-right: 0;
                margin-bottom: 10px;
                justify-content: center; /* Center buttons when stacked */
            }
        }
    </style>
</head>
<body>

<div class="page-hero-small" style="background-image: url('images/<?= htmlspecialchars($siteSettings['research_hero_banner'] ?? 'placeholder_research.jpg') ?>');">
    <h1>Research & Publication Details</h1>
</div>

<div class="container py-5">
    <div class="research-detail-card">
        <h1 class="research-detail-title"><?= htmlspecialchars($paper['title']) ?></h1>
        
        <div class="research-detail-meta">
            <?php if (!empty($paper['authors'])): ?>
                <span><i class="fas fa-user-friends"></i> <strong>Authors:</strong> <?= htmlspecialchars($paper['authors']) ?></span>
            <?php endif; ?>
            <?php if (!empty($paper['publication_date'])): ?>
                <span><i class="far fa-calendar-alt"></i> <strong>Published:</strong> <?= date("F j, Y", strtotime($paper['publication_date'])) ?></span>
            <?php endif; ?>
            <?php if (!empty($paper['keywords'])): ?>
                <span><i class="fas fa-tags"></i> <strong>Keywords:</strong> <?= htmlspecialchars($paper['keywords']) ?></span>
            <?php endif; ?>
        </div>

        <div class="research-full-abstract">
            <p><strong>Abstract:</strong></p>
            <p><?= nl2br(htmlspecialchars($paper['abstract'])) ?></p>
        </div>

        <div class="research-download-links">
            <?php if (!empty($paper['file_url'])): ?>
                <a href="files/<?= htmlspecialchars($paper['file_url']) ?>" target="_blank" class="btn"><i class="fas fa-file-pdf me-2"></i> Download PDF</a>
            <?php endif; ?>
            <?php if (!empty($paper['external_link'])): ?>
                <a href="<?= htmlspecialchars($paper['external_link']) ?>" target="_blank" class="btn"><i class="fas fa-external-link-alt me-2"></i> View External Link</a>
            <?php endif; ?>
        </div>

        <a href="research.php" class="btn back-to-research-btn">
            <i class="fas fa-arrow-left me-2"></i> Back to Research
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include'footer.php'; ?>
</body>
</html>

<?php $con->close(); ?>