<style>
    :root {
        --primary-red: #8B0000;
        --white: #ffffff;
        --text-color-dark: #333333;
    }

    body {
        font-family: "Times New Roman", Times, serif;
    }

    .site-header {
        width: 100%;
  position: sticky; /* Make the main navbar sticky */
        top: 0; 
          z-index: 1020;
            transition: top 0.3s ease-out; 

    }
    .top-bar {
        background-color: var(--primary-red);
        color: white;
        padding: 10px 0;
        font-size: 1rem;
        font-family: "Times New Roman", Times, serif;
        transition: transform 0.3s ease-out; /* Smooth transition for hide/show */
    }

    /* New style for hiding the top bar */
    .top-bar.hidden {
        transform: translateY(-100%);
        opacity: 0; 
        visibility: hidden; 
    }


    .top-bar a,
    .top-bar span {
        color: white;
        text-decoration: none;
        font-weight: 500;
    }

    .top-bar .social-icons a {
        font-size: 1.2rem;
        margin-left: 15px;
        transition: color 0.3s;
    }

    .top-bar .social-icons a:hover {
        color: #f0e68c;
    }
    .nav-item{
        font-size: .9rem;
        font-weight: 500;
    }
    .main-navbar {
        background-color: var(--white);
        border-bottom: 1px solid #ddd;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        z-index: 1020;   }

    .navbar-brand img {
        height: 100px;
        object-fit: contain;
        margin-right: 25px;
    }

    .navbar-nav .nav-link {
        color: var(--text-color-dark);
        padding: 8px 20px; /* Reduced padding */
        font-weight: 500;
        transition: all 0.3s ease;
        font-family: "Times New Roman";
    }

    .navbar-nav .nav-link.active,
    .navbar-nav .nav-link:hover {
        color: var(--primary-red);
        border-bottom: 2px solid var(--primary-red);
    }

    .dropdown-menu {
        background-color: var(--primary-red);
        border: 1px solid #ddd;
        padding: 10px 0;
        display: none;
    }

    .dropdown-menu.show {
        display: block;
    }

    .dropdown-item {
        color: var(--text-color-dark);
        padding: 8px 20px;
        font-size: 0.95rem;
        font-family: "Times New Roman";
    }

    .dropdown-item:hover {
        background-color: var(--primary-red);
        color: white;
    }

    /* CSS for Desktop Hover Behavior */
    @media (min-width: 992px) {
        .navbar-nav .dropdown:hover > .dropdown-menu {
            display: block; /* Show the main dropdown menu on hover */
        }
    }

    .navbar-toggler {
        border: none;
        padding: 0;
    }

    .navbar-toggler-icon .fas {
        color: var(--primary-red);
        font-size: 1.8rem;
    }

    .container {
        max-width: 1300px;
    }
.remove_navbar {
    transition: top 0.3s ease-out; /* Smooth transition for hiding the navbar */
        top: -50px; 
    }
    .remove_navbar_mobile {
        top: -50px;
        transition: top 0.3s ease-out; 
    }
    @media (max-width: 991.98px) {
        .top-bar .contact-info,
        .top-bar .social-icons {
            justify-content: center;
            flex-wrap: wrap;
        }

        .navbar-nav .nav-link {
            padding: 10px 15px;
            border-bottom: none !important;
        }
        .top-bar .social-icons a{
            display: none;
        }
        .navbar-brand img {
            height: 80px;
        }
        
        .dropdown-menu {
            display: none;
        }
    
      
    }
        /* Custom scrollbar */
::-webkit-scrollbar {
    width: 10px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #d1002c 0%, #d1002c 100%);
    border-radius: 5px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #d1002c 0%,#d1002c 100%);
}
   
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
<link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<header class="site-header">
    <div class="top-bar">
        <div class="container d-flex flex-column flex-lg-row justify-content-between align-items-center">
            <div class="contact-info d-flex align-items-center gap-4">
                <span><i class="fas fa-phone me-2"></i> (048) 9232004</span>
                <span><i class="fas fa-envelope ms-2 me-1"></i> Principle.smc.health@punjab.gov.pk</span>
            </div>
            <div class="d-flex align-items-center gap-3 mt-2 mt-lg-0">
                <div class="social-icons d-flex gap-3">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg main-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="./images/logo.png" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <?php
                    $currentPage = basename($_SERVER['PHP_SELF']);

                    function isActive($pageName, $currentPage) {
                        return ($currentPage === $pageName) ? 'active' : '';
                    }
                    if (!isset($con)) {
                      include_once 'config.php';
                    }
                    ?>

                    <li class="nav-item">
                        <a class="nav-link <?= isActive('index.php', $currentPage) ?>" href="index.php">HOME</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= isActive('vision_mission.php', $currentPage) ?> <?= isActive('principal_message.php', $currentPage) ?>" href="#" id="aboutUsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            ABOUT US
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="aboutUsDropdown">
                            <li><a class="dropdown-item <?= isActive('vision_mission.php', $currentPage) ?>" href="vision_mission.php">Vision & Mission</a></li>
                            <li><a class="dropdown-item <?= isActive('principal_message.php', $currentPage) ?>" href="principal_message.php">Principal's Message</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= isActive('admission_criteria.php', $currentPage) ?>" href="#" id="admissionsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            ADMISSIONS
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="admissionsDropdown">
                            <li><a class="dropdown-item <?= isActive('admission_criteria.php', $currentPage) ?>" href="admission_criteria.php">Admission Criteria</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle
                            <?php
                            $isDepartmentActive = false;
                            $departmentPages = ['faculty_detail.php']; // Only faculty_detail.php
                            if (in_array($currentPage, $departmentPages)) {
                                $isDepartmentActive = true;
                            }
                            echo $isDepartmentActive ? 'active' : '';
                            ?>
                            " href="#" id="departmentsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            DEPARTMENTS
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="departmentsDropdown">
                            <?php
                            if (isset($con) && $con->ping()) {
                                $faculty_sql = "SELECT id, name FROM faculties ORDER BY name ASC";
                                $faculty_result = $con->query($faculty_sql);

                                if ($faculty_result && $faculty_result->num_rows > 0) {
                                    while ($faculty_row = $faculty_result->fetch_assoc()) {
                                        echo '<li>';
                                        $facultyLinkActive = ($currentPage === 'faculty_detail.php' && isset($_GET['id']) && intval($_GET['id']) == $faculty_row['id']) ? 'active' : '';

                                        echo '<a class="dropdown-item ' . $facultyLinkActive . '" href="faculty_detail.php?id=' . htmlspecialchars($faculty_row['id']) . '">';
                                        echo htmlspecialchars($faculty_row['name']);
                                        echo '</a>';
                                        echo '</li>';
                                    }
                                } else {
                                    echo '<li><a class="dropdown-item" href="#">No Faculties Found</a></li>';
                                }
                            } else {
                                echo '<li><a class="dropdown-item" href="#">Database connection not available</a></li>';
                            }
                            ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= isActive('research.php', $currentPage) ?>" href="research.php">RESEARCH</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= isActive('news-events.php', $currentPage) ?>" href="news-events.php">NEWS & EVENTS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= isActive('notifications.php', $currentPage) ?>" href="notifications.php">NOTIFICATION</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= isActive('downloads.php', $currentPage) ?>" href="downloads.php">DOWNLOADS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= isActive('contact.php', $currentPage) ?>" href="contact_us.php">CONTACT US</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            // Check if the clicked element is not inside a dropdown or the navbar toggler
            if (!e.target.closest('.dropdown') && !e.target.closest('.navbar-toggler')) {
                document.querySelectorAll('.dropdown-menu.show').forEach(function(el) {
                    el.classList.remove('show');
                });
                const navbarCollapse = document.getElementById('navbarNav');
                if (navbarCollapse && navbarCollapse.classList.contains('show')) {
                    // Only close the navbar if the click wasn't on the toggler itself
                    if (!e.target.closest('.navbar-toggler')) {
                        const bsCollapse = new bootstrap.Collapse(navbarCollapse, { toggle: false });
                        bsCollapse.hide();
                    }
                }
            }
        });

        // Close dropdowns when the navbar toggler is clicked (for mobile menu)
        const navbarToggler = document.querySelector('.navbar-toggler');
        navbarToggler.addEventListener('click', function() {
            document.querySelectorAll('.dropdown-menu.show').forEach(function(el) {
                el.classList.remove('show');
            });
        });

        // New: Hide top bar on scroll for a cooler look and reduced space
        const topBar = document.querySelector('.top-bar');
        topBarHeight = topBar.offsetHeight; // Store the height of the top bar
        const siteHeader = document.querySelector('.site-header');
        let lastScrollTop = 0; 

        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollTop > lastScrollTop) {
                topBar.classList.add('hidden'); // Hide the top bar when scrolling down
                siteHeader.style.top = `-${topBarHeight}px`; // Adjust the header position
            }else{
                topBar.classList.remove('hidden'); 
                siteHeader.style.top = '0'; 
            }
            lastScrollTop= scrollTop; 
        

});
});

</script>

 