<?php
// This section doesn't strictly need session_start() or config.php if the main index.php
// already includes them. However, it's safer to include them for standalone testing or
// if this section might be used on other pages directly.
// if (!isset($_SESSION)) { session_start(); }
// if (!isset($con)) { include "config.php"; } // Assuming config.php sets up your database connection
?>

<style>
    /* Section Specific Styles - to avoid conflict, consider scoping these */
    /* If you're embedding this, ensure your main styles don't conflict */

    /* If you have a global :root and body style already, you might remove these */
    :root {
        --primary-color: #800000; /* Maroon */
        --secondary-color: #660000; /* Darker Maroon */
        --light-gray: #f9f9f9;
        --dark-text: #333;
        --light-text: #666;
        --border-color: #ddd;
    }

    /* Remove body styling if already global */
    /* body {
        font-family: 'Poppins', sans-serif;
        background-color: var(--light-gray);
        color: var(--dark-text);
        line-height: 1.7;
    } */

    .section-title.location-section-title { /* Added unique class for this section's title */
        color: var(--primary-color);
        font-size: 2.5em; /* Slightly smaller for a section */
        font-weight: 700;
        margin-bottom: 40px;
        text-align: center;
        position: relative;
        padding-bottom: 15px;
    }

    .section-title.location-section-title::after {
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

    .contact-section-card { /* Unified card for all content */
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        padding: 30px;
        margin-bottom: 30px; /* Space if there are multiple sections */
    }

    .contact-info-compact .contact-info-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 15px; /* Reduced margin */
        color: var(--dark-text);
    }

    .contact-info-compact .contact-info-item i {
        font-size: 1.3em; /* Slightly smaller icon */
        color: var(--primary-color);
        margin-right: 12px;
        width: 25px; /* Fixed width for icon */
        text-align: center;
    }

    .contact-info-compact .contact-info-item strong {
        display: block;
        font-size: 1em; /* Slightly smaller font */
        color: var(--secondary-color);
        margin-bottom: 3px;
    }

    .contact-info-compact .contact-info-item p {
        margin-bottom: 0;
        font-size: 0.9em; /* Smaller font */
    }

    .contact-info-compact .opening-hours {
        padding-left: 0; /* Remove default list padding */
        margin-top: 20px;
    }

    .contact-info-compact .opening-hours li {
        list-style: none;
        padding-left: 0;
        margin-bottom: 3px;
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        font-size: 0.9em;
    }

    .contact-info-compact .opening-hours li span:first-child {
        font-weight: 600;
        color: var(--dark-text);
    }

    .contact-info-compact .opening-hours li span:last-child {
        color: var(--light-text);
    }

    .contact-form-compact .form-label {
        font-weight: 600;
        color: var(--dark-text);
        margin-bottom: 6px; /* Reduced margin */
    }

    .contact-form-compact .form-control {
        border-radius: 5px;
        border: 1px solid var(--border-color);
        padding: 8px 12px; /* Reduced padding */
        font-size: 0.9em; /* Smaller font */
    }

    .contact-form-compact textarea.form-control {
        min-height: 100px; /* Reduced height */
    }

    .btn-send-message-compact {
        background-color: var(--primary-color);
        color: white;
        padding: 10px 25px; /* Reduced padding */
        border-radius: 5px;
        font-weight: 600;
        transition: background-color 0.3s ease;
        width: 100%;
        margin-top: 15px; /* Reduced margin */
    }

    .btn-send-message-compact:hover {
        background-color: var(--secondary-color);
        color: white;
    }

    .map-container-compact {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); /* Lighter shadow */
        height: 350px; /* Condensed height for the map */
        width: 100%;
        margin-top: 20px; /* Space between info/form and map on mobile */
    }

    .map-container-compact iframe {
        width: 100%;
        height: 100%;
        border: 0;
    }

    /* Responsive adjustments */
    @media (min-width: 992px) { /* Adjust for larger screens (desktop) */
        .map-container-compact {
            height: 100%; /* Make map fill available height in column */
            margin-top: 0; /* Remove top margin when side-by-side */
        }
        .contact-info-compact, .contact-form-compact {
            /* Adjust padding or font size if needed for desktop to condense */
        }
    }

    @media (max-width: 767.98px) {
        .section-title.location-section-title {
            font-size: 2em;
            margin-bottom: 25px;
        }
        .contact-section-card {
            padding: 20px;
        }
        .map-container-compact {
            height: 250px; /* Even smaller map on mobile */
        }
    }
</style>

<section class="our-location-section py-5">
    <div class="container">
        <h2 class="section-title location-section-title">Our Location</h2>

        <div class="contact-section-card">
            <div class="row g-4">
                <div class="col-lg-6 order-lg-2"> <h3 class="mb-4" style="color: var(--primary-color); font-weight: 600;">Find Us</h3>
                    <div class="contact-info-compact">
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

                        <h4 class="mt-4 mb-3" style="color: var(--primary-color);">Opening Hours</h4>
                        <ul class="opening-hours">
                            <li><span>Monday - Friday:</span> <span>9:00 AM - 5:00 PM</span></li>
                            <li><span>Saturday:</span> <span>9:00 AM - 1:00 PM</span></li>
                            <li><span>Sunday:</span> <span>Closed</span></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-6 order-lg-1">
                    <div class="map-container-compact">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3383.4112224148685!2d72.72056577477761!3d32.003972773996345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3921826576c80d67%3A0x1701a729b24f826!2sSargodha%20Medical%20College!5e0!3m2!1sen!2s!4v1752401393147!5m2!1sen!2s" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>

            </div>
    </div>
</section>