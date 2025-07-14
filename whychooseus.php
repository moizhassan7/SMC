<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

    body {
        font-family: 'Poppins', sans-serif;

    }

    .section-title {
        color: #800000; /* Dark Red */
        font-weight: bold;
        font-size: 36px;
    }

    .highlight-box {
        background-color: #800000;
        color: white;
        text-align: center;
        padding: 40px 20px;
        font-size: 24px;
        width: 50%;
        height: 100%;
        font-family: 'Poppins', sans-serif;
    }

    .vision-bg {
        background: url('images/visionAndMission.jpg') no-repeat center center;
        background-size: cover;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        height: 100%;
        min-height: 300px;
    }
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

<div class="container p-4">

    <!-- Why Choose SMC Section -->
    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <h2 class="section-title">Why<br>Choose<br>SMC</h2>
            <p>Sargodha Medical College offers an outstanding learning environment for our graduates to practice in the modern and ever-growing social care and public health sector. The medical College offers MBBS five years degree program with due recognition from Pakistan Medical and Dental Council and FCPS/MS/MD degree programs in collaboration with the University of Health Sciences. Our research and clinical practice offer us opportunities for working in partnership with healthcare providers in the region to provide a variety of high-quality health service.</p>
        </div>
        <div class="col-md-6 text-center">
            <img src="images/smcbuliding.png" class="img-fluid rounded" alt="SMC Campus">
        </div>
    </div>

    <!-- Vision and Mission Section -->
    <div class="row align-items-stretch">
        <div class="col-md-4 vision-bg">
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
                    <img src="images/principal_image.png" alt="Prof. Dr. Muhammad Waris Farooka" class="principal-image">
                </div>
            </div>
        </div>
    </div>
