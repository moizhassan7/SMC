<?php
session_start();
include "config.php"; // Assuming config.php sets up your database connection
include_once "header.php"; // Include your header file here
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal's Message - Sargodha Medical Collage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-red: #8B0000; /* As defined in your header.php */
            --white: #ffffff;
            --text-color-dark: #333;
        }

        body {
            font-family: 'Poppins', sans-serif; /* Consistent with other pages */
            background-color: #f9f9f9; /* Light background for the overall page */
            color: var(--text-color-dark);
            line-height: 1.7;
        }

        /* Hero Section (Main Principal Message Area) */
        .principal-hero-section {
            background-color: var(--primary-red);
            color: var(--white);
            padding: 80px 0; /* Adjust padding as needed */
            margin-top: -1px; /* To counter any top margin/spacing from header */
        }

        .principal-content-wrapper {
            display: flex;
            align-items: center; /* Vertically align items */
            justify-content: space-between; /* Space out content and image */
            flex-wrap: wrap; /* Allow wrapping on smaller screens */
        }

        .principal-text-content {
            flex: 1; /* Take available space */
            padding-right: 30px; /* Space between text and image */
        }

        .principal-role {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
            opacity: 0.8;
            color:  #FFD700;;
        }

        .principal-name {
            font-size: 3.2em; /* Large, bold name */
            font-weight: 900; /* Extra bold */
            margin-bottom: 25px;
            line-height: 1.2;
            text-transform: uppercase;
        }

        .principal-message-text {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .principal-image-container {
            flex-shrink: 0; /* Prevent image from shrinking */
            width: 200px; /* Fixed width for the image container */
            height: 300px; /* Fixed height for the image container */
            overflow: hidden; /* Hide overflow for circular shape */
            border: 5px solid var(--white); /* White border around image */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3); /* Shadow for depth */
        }

        .principal-image {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ensure image covers the area */
            display: block;
        }

      .read-more-btn {
            background-color: var(--white);
            color: var(--primary-red);
            padding: 12px 30px;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .read-more-btn:hover {
            background-color:  #FFD700;; /* Lighter yellow on hover */
        }

        /* Additional content section (if needed below the hero) */
        .additional-content-section {
            padding: 50px 0;
            background-color: var(--white);
        }

        /* Responsive Adjustments */
        @media (max-width: 991.98px) {
            .principal-content-wrapper {
                flex-direction: column; /* Stack items vertically on smaller screens */
                text-align: center;
            }
            .principal-text-content {
                padding-right: 0;
                margin-bottom: 30px;
            }
            .principal-image-container {
                margin-bottom: 30px; /* Space below image when stacked */
            }
            .principal-name {
                font-size: 2.5em;
            }
        }

        @media (max-width: 767.98px) {
            .principal-hero-section {
                padding: 60px 0;
            }
            .principal-name {
                font-size: 2em;
            }
            .principal-message-text {
                font-size: 1rem;
            }
            .principal-image-container {
                width: 200px;
                height: 200px;
            }
        }
    </style>
</head>
<body>

    <div class="principal-hero-section">
        <div class="container">
            <div class="principal-content-wrapper">
                <div class="principal-text-content">
                    <p class="principal-role">Principal/Head of Institution</p>
                    <h1 class="principal-name">PROF. DR. MUHAMMAD WARIS FAROOKA</h1>
                    <p class="principal-message-text">
                        Sargodha Medical College (SMC) is one of the prestigious institutions of Punjab situated in the city of Sargodha. Since our inception in 2006, we are putting our utmost efforts in imparting standardized and quality education, and producing talented and proficient healthcare professionals, independent intellectuals and dynamic citizens. This institution has developed outstandingly accomplishing a stupendous success in many directions and reached up to present stage.
                    </p>
                    <a href="#full-message" class="read-more-btn">READ MORE</a>
                </div>
                <div class="principal-image-container">
                   <?php
$principal_img_q = mysqli_query($con, "SELECT setting_value FROM site_settings WHERE setting_key = 'principal_image'");
$principal_img_row = mysqli_fetch_assoc($principal_img_q);
$principal_image_path = $principal_img_row['setting_value'] ?? 'placeholder_principal.jpg'; 
?>
<img src="images/<?= htmlspecialchars($principal_image_path) ?>" alt="Prof. Dr. Muhammad Waris Farooka" class="principal-image">
                </div>
            </div>
        </div>
    </div>

    <div id="full-message" class="additional-content-section">
        <div class="container">
            <h2 class="text-center" style="color: var(--primary-red); font-weight: 700; margin-bottom: 30px;">
                Our Vision and Commitment
            </h2>
            <p>
                As the Principal of Sargodha Medical College, it is my immense pleasure to welcome you to our esteemed institution. Since its establishment in 2006, SMC has been dedicated to upholding the highest standards of medical education and fostering a nurturing environment for our students. Our mission extends beyond academics; we aim to cultivate compassionate, ethical, and competent healthcare professionals who will serve society with distinction.
            </p>
            <p>
                We continually strive to update our curriculum, integrate modern teaching methodologies, and provide state-of-the-art facilities to ensure that our graduates are well-equipped to meet the challenges of the rapidly evolving healthcare landscape. Our faculty comprises highly qualified and experienced professionals who are committed to mentorship and academic excellence.
            </p>
            <p>
                We believe in holistic development, encouraging students to participate in extracurricular activities, research, and community service. This approach ensures that they not only excel academically but also develop into well-rounded individuals and responsible citizens.
            </p>
            <p>
                Thank you for considering Sargodha Medical College as your partner in education. We look forward to welcoming you to our vibrant community.
            </p>
            <p class="mt-4" style="font-weight: 600; color: var(--primary-red);">
                Prof. Dr. Muhammad Waris Farooka<br>
                Principal, Sargodha Medical College
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php

?>
<?php include_once "footer.php"; ?> </body>
</html>