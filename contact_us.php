<?php
session_start();
include "config.php"; // Assuming your database connection
include_once "header.php"; // Your site header
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us & Our Location - Sargodha Medical Collage</title>
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

        .contact-info-card, .contact-form-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 30px;
            height: 100%; /* Ensures cards in a row have consistent height */
        }

        .contact-info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
            color: var(--dark-text);
        }

        .contact-info-item i {
            font-size: 1.5em;
            color: var(--primary-color);
            margin-right: 15px;
            width: 30px; /* Fixed width for icon to align text */
            text-align: center;
        }

        .contact-info-item strong {
            display: block;
            font-size: 1.1em;
            color: var(--secondary-color);
            margin-bottom: 5px;
        }

        .contact-info-item p {
            margin-bottom: 0;
            font-size: 0.95em;
        }

        .opening-hours li {
            list-style: none;
            padding-left: 0;
            margin-bottom: 5px;
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            font-size: 0.95em;
        }

        .opening-hours li span:first-child {
            font-weight: 600;
            color: var(--dark-text);
        }

        .opening-hours li span:last-child {
            color: var(--light-text);
        }

        .contact-form .form-label {
            font-weight: 600;
            color: var(--dark-text);
            margin-bottom: 8px;
        }

        .contact-form .form-control {
            border-radius: 5px;
            border: 1px solid var(--border-color);
            padding: 10px 15px;
            font-size: 0.95em;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .contact-form .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(128, 0, 0, 0.25);
        }

        .contact-form textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .btn-send-message {
            background-color: var(--primary-color);
            color: white;
            padding: 12px 30px;
            border-radius: 5px;
            font-weight: 600;
            transition: background-color 0.3s ease;
            width: 100%;
            margin-top: 20px;
        }

        .btn-send-message:hover {
            background-color: var(--secondary-color);
            color: white; /* Ensure text remains white */
        }

        .map-container {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            height: 500px; /* Fixed height for the map */
            width: 100%;
        }

        .map-container iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }

        /* Responsive adjustments */
        @media (max-width: 991.98px) {
            .map-container {
                height: 400px; /* Adjust map height for tablets */
                margin-top: 30px; /* Add space above map on smaller screens */
            }
        }

        @media (max-width: 767.98px) {
            .section-title {
                font-size: 2.2em;
                margin-bottom: 30px;
            }
            .map-container {
                height: 300px; /* Adjust map height for mobile */
            }
            .contact-info-card, .contact-form-card {
                padding: 20px;
            }
            .contact-info-item i {
                font-size: 1.3em;
                margin-right: 10px;
            }
            .contact-info-item strong {
                font-size: 1em;
            }
            .contact-info-item p {
                font-size: 0.9em;
            }
        }
    </style>
</head>
<body>

<div class="container py-5">
    <h2 class="section-title">Contact Us & Our Location</h2>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="contact-form-card">
                <h3 class="mb-4" style="color: var(--primary-color); font-weight: 600;">Send Us a Message</h3>
                <form action="process_contact_form.php" method="POST" class="contact-form">
                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Your Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="e.g., Admission Inquiry">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Your Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Type your message here..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-send-message">Send Message</button>
                </form>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="contact-info-card">
                <h3 class="mb-4" style="color: var(--primary-color); font-weight: 600;">Our Information</h3>

                <div class="contact-info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <strong>Address</strong>
                        <p>Sargodha Medical College, Faisalbad Road, Sargodha, Punjab, Pakistan</p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <i class="fas fa-phone-alt"></i>
                    <div>
                        <strong>Phone</strong>
                        <p>(048) 9232004</p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <strong>Email</strong>
                        <p>Principle.smc.health@punjab.gov.pk</p>
                    </div>
                </div>

                <h4 class="mt-5 mb-3" style="color: var(--primary-color);">Opening Hours</h4>
                <ul class="opening-hours">
                    <li><span>Monday - Friday:</span> <span>9:00 AM - 5:00 PM</span></li>
                    <li><span>Saturday:</span> <span>9:00 AM - 1:00 PM</span></li>
                    <li><span>Sunday:</span> <span>Closed</span></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <h3 class="section-title">Find Us on Map</h3>
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3383.4112224148685!2d72.72056577477761!3d32.003972773996345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3921826576c80d67%3A0x1701a729b24f826!2sSargodha%20Medical%20College!5e0!3m2!1sen!2s!4v1752401393147!5m2!1sen!2s" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php
$con->close();
include_once "footer.php";
?>
</body>
</html>