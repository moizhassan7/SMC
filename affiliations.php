<style>
    /* Affiliation & Recognition Section Styles */
.affiliation-section {
    background-color: #f9f9f9; /* Light background similar to previous sections */
    padding: 60px 0;
    overflow: hidden; /* Hide the overflowing parts of the carousel */
}

.affiliation-title {
    font-size: 2.8em;
    font-weight: 700;
    color: var(--primary-color); 
    position: relative;
    display: inline-block; 
}

/* Underline for the title */
.affiliation-title::after {
    content: '';
    display: block;
    width: 60px; 
    height: 3px;
    background-color: var(--primary-color);
    margin: 10px auto 0; 
    border-radius: 2px;
}

.logo-carousel-container {
    overflow: hidden; /* Important: Hides parts of the track that are outside */
    white-space: nowrap; /* Ensures logos stay in a single line */
    position: relative;
    padding: 20px 0; /* Vertical padding for logos */
}

.logo-carousel-track {
    display: inline-block; 
    animation: scrollLogos 25s linear infinite; /* Animation applied here */
    will-change: transform; /* Optimize for animation */
}

.affiliation-logo {
    height: 100px; 
    margin: 0 20px; 
    vertical-align: middle; 
    opacity: 0.8; /* Slight transparency */
    transition: opacity 0.3s ease;
}

.affiliation-logo:hover {
    opacity: 1;
}


@keyframes scrollLogos {
    0% {
        transform: translateX(0); 
    }
    100% {
        transform: translateX(-50%); 
    }
}

.logo-carousel-container:hover .logo-carousel-track {
    animation-play-state: paused;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .affiliation-title {
        font-size: 2em;
    }
    .affiliation-logo {
        height: 60px; /* Smaller logos on mobile */
        margin: 0 20px;
    }
    .logo-carousel-container {
        padding: 15px 0;
    }
    @keyframes scrollLogos {
        100% {
            transform: translateX(-50%); /* Adjust for potentially smaller total width */
        }
    }
}

@media (max-width: 576px) {
    .affiliation-title {
        font-size: 1.8em;
    }
    .affiliation-logo {
        height: 50px;
        margin: 0 15px;
    }
}
</style>
<section class="affiliation-section py-5">
    <div class="container text-center mb-5">
        <h2 class="affiliation-title">Affiliation & Recognition</h2>
    </div>

    <div class="logo-carousel-container">
        <div class="logo-carousel-track">
            <img src="images/logo1.webp" alt="PMDC Logo" class="affiliation-logo">
            <img src="images/logo2.png" alt="Punjab Govt Logo" class="affiliation-logo">
            <img src="images/logo3.webp" alt="UHS Lahore Logo" class="affiliation-logo">
            <img src="images/logo4.png" alt="Hospital Logo" class="affiliation-logo">

            <img src="images/logo1.webp" alt="PMDC Logo" class="affiliation-logo">
            <img src="images/logo2.png" alt="Punjab Govt Logo" class="affiliation-logo">
            <img src="images/logo3.webp" alt="UHS Lahore Logo" class="affiliation-logo">
            <img src="images/logo4.png" alt="Hospital Logo" class="affiliation-logo">
            <img src="images/logo1.webp" alt="PMDC Logo" class="affiliation-logo">
            <img src="images/logo2.png" alt="Punjab Govt Logo" class="affiliation-logo">
            <img src="images/logo3.webp" alt="UHS Lahore Logo" class="affiliation-logo">
            <img src="images/logo4.png" alt="Hospital Logo" class="affiliation-logo">
             </div>
    </div>
</section>