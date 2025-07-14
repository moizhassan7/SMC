<?php
session_start();
include "config.php"; // Assuming config.php sets up your database connection
include_once "header.php"; // Include your header file
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
    <title>Vision & Mission - Sargodha Medical Collage</title>
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

        /* Hero section (optional, but good for main pages) */
        .page-hero {
            position: relative;
            height: 35vh; /* A bit shorter for sub-pages */
     background: url('images/smcbuliding.png') no-repeat center center;
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

        /* Main content section */
        .vision-mission-content-section {
            padding: 60px 0;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-top: -80px; /* Overlap with hero */
            position: relative;
            z-index: 1;
        }

        .vision-bg {
     background: url('images/visionAndMission.jpg') no-repeat center center;
                 display: flex;
            align-items: center;
            justify-content: center;
            min-height: 350px; /* Ensure it has enough height */
            position: relative;
            border-radius: 8px 0 0 8px; /* Rounded left side only */
            overflow: hidden;
        }

        .vision-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(128, 0, 0, 0.85); /* Dark maroon overlay */
            z-index: 1;
        }

        .highlight-box {
            color: white;
            font-size: 2.5em; /* Large text */
            font-weight: 700;
            text-align: center;
            line-height: 1.2;
            text-transform: uppercase;
            z-index: 2;
            position: relative;
            text-shadow: 1px 1px 4px rgba(0,0,0,0.5);
            padding: 20px;
        }

        .section-title { /* Main title for the text content */
            color: var(--primary-color);
            font-size: 2.2em;
            font-weight: 700;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 10px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 60px;
            height: 3px;
            background-color: var(--primary-color);
            border-radius: 2px;
        }

        /* Responsive adjustments */
        @media (max-width: 991.98px) {
            .page-hero {
                height: 30vh;
            }
            .page-hero h1 {
                font-size: 3em;
            }
            .vision-mission-content-section {
                padding: 40px 0;
                margin-top: -60px;
            }
            .vision-bg {
                min-height: 250px; /* Smaller height on tablets */
                border-radius: 8px 8px 0 0; /* Rounded top for stacking */
            }
            .highlight-box {
                font-size: 2em;
            }
            .section-title {
                font-size: 2em;
                margin-top: 30px; 
            }
        }

        @media (max-width: 767.98px) {
            .page-hero {
                height: 25vh;
            }
            .page-hero h1 {
                font-size: 2.5em;
            }
            .vision-mission-content-section {
                padding: 30px 0;
                margin-top: -40px;
            }
            .vision-bg {
                min-height: 200px;
            }
            .highlight-box {
                font-size: 1.8em;
            }
            .section-title {
                font-size: 1.8em;
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>
<div class="page-hero" style="background-image: url('images/<?= htmlspecialchars($siteSettings['vision_mission_hero_banner'] ?? 'placeholder_hero.jpg') ?>');">
    <h1>Our Vision & Mission</h1>
</div>

<div class="container py-5">
    <div class="vision-mission-content-section">
        <div class="row align-items-stretch g-0"> <div class="col-md-4 vision-bg">
                <div class="highlight-box">
                    OUR<br>VISION<br>&<br>MISSION
                </div>
            </div>
            <div class="col-md-8 d-flex flex-column justify-content-center align-items-start p-4">
                <h2 class="section-title">Our Vision & Mission</h2>
                <p>To modify the health care dynamics of the region according to modern international standards through knowledge, skill and altitudes impacting on the health care professionals trained here.</p>
                <p>Sargodha Medical College will transform the health care system in the region through continuous teaching, training and research in the field of medical sciences, enhancing the medical education and patient care standards, by teaching young professionals and imparting them the required skills, knowledge and altitudes mandatory for performance in medical profession par excellence.</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php
// Close the database connection
$con->close();
// Include your footer file
include_once "footer.php";
?>
</body>
</html>