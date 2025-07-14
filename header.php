<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
<link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
<style>
    :root {
        --primary-red: #8B0000;
        --white: #ffffff;
        --text-color-dark: #333;
    }

    body {
        font-family: "Times New Roman", Times, serif;
    }

    .site-header {
        position: sticky;
        top: 0;
        z-index: 1030;
        width: 100%;
    }

    /* Top Red Bar */
    .top-bar {
        background-color: var(--primary-red);
        color: white;
        padding: 10px 0;
        font-size: 1rem;
        font-family: "Times New Roman", Times, serif;
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

    .main-navbar {
        background-color: var(--white);
        border-bottom: 1px solid #ddd;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand img {
        height: 100px;
        object-fit: contain;
        margin-right: 25px;
    }

    .navbar-nav .nav-link {
        color: var(--text-color-dark);
        padding: 12px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
        font-family: "Times New Roman";
    }

    /* Active/Hover states for nav links */
    .navbar-nav .nav-link.active,
    .navbar-nav .nav-link:hover {
        color: var(--primary-red);
        border-bottom: 2px solid var(--primary-red);
    }

    .dropdown-menu {
        background-color: var(--white);
        border: 1px solid #ddd;
        padding: 10px 0;
        display: none;
        transition: display 0.1s ease-in-out;
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

    /* Nested Dropdown Styling */
    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu > .dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -6px;
        margin-left: -1px;
        border-radius: 0.25rem;
    }

    /* Arrow for nested dropdowns */
    .dropdown-submenu > a::after {
        display: block;
        content: "\f105"; /* Font Awesome right arrow */
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        float: right;
        margin-top: 2px;
        margin-left: .5em;
        vertical-align: middle;
        transition: transform .2s ease-in-out;
    }

    .dropdown-submenu.show > a::after {
        transform: rotate(90deg); /* Rotate arrow when submenu is open on mobile */
    }

    /* CSS for Desktop Hover Behavior */
    @media (min-width: 992px) {
        .navbar-nav .dropdown:hover > .dropdown-menu {
            display: block; /* Show the main dropdown menu on hover */
        }

        .dropdown-submenu:hover > .dropdown-menu {
            display: block; /* Show nested dropdown menus on hover */
        }

        .dropdown-submenu > a::after {
            border-left-color: #ccc; /* Default arrow color for desktop */
        }

        .dropdown-submenu:hover > a::after {
            border-left-color: white; /* Arrow color on hover */
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

    @media (max-width: 991.98px) { /* Changed to match Bootstrap's lg breakpoint for consistency */
        .top-bar .contact-info,
        .top-bar .social-icons {
            justify-content: center;
            flex-wrap: wrap;
        }

        .navbar-nav .nav-link {
            padding: 10px 15px;
            border-bottom: none !important;
        }

        .navbar-brand img {
            height: 80px;
        }

        /* Adjustments for mobile nested dropdowns */
        .dropdown-submenu > .dropdown-menu {
            position: static; /* Stack vertically on mobile */
            left: auto;
            margin-top: 0;
            margin-left: 15px; /* Indent nested items */
            border: none;
            box-shadow: none;
        }

        .dropdown-submenu > a::after {
            float: none; /* Remove float */
            display: inline-block; /* Ensure it stays in line with text */
            margin-left: .5em; /* Space from text */
            transform: rotate(0deg); /* Default rotation on mobile */
        }

        /* For mobile, hide dropdown menus by default to be controlled by JS toggle */
        .dropdown-menu {
            display: none;
        }
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
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
                        include_once "config.php";
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
                            $departmentPages = ['faculty_detail.php', 'department_detail.php'];
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
                            $faculty_sql = "SELECT id, name FROM faculties ORDER BY name ASC";
                            $faculty_result = $con->query($faculty_sql);

                            if ($faculty_result && $faculty_result->num_rows > 0) {
                                while ($faculty_row = $faculty_result->fetch_assoc()) {
                                    echo '<li class="dropdown-submenu">';
                                    $facultyLinkActive = ($currentPage === 'faculty_detail.php' && isset($_GET['id']) && intval($_GET['id']) == $faculty_row['id']) ? 'active' : '';

                                    echo '<a class="dropdown-item dropdown-toggle ' . $facultyLinkActive . '" href="faculty_detail.php?id=' . htmlspecialchars($faculty_row['id']) . '">';
                                    echo htmlspecialchars($faculty_row['name']);
                                    echo '</a>';

                                    $department_sql = "SELECT id, name FROM departments WHERE faculty_id = " . intval($faculty_row['id']) . " ORDER BY name ASC";
                                    $department_result = $con->query($department_sql);

                                    if ($department_result && $department_result->num_rows > 0) {
                                        echo '<ul class="dropdown-menu">'; 
                                        while ($department_row = $department_result->fetch_assoc()) {
                                            
                                            $departmentLinkActive = ($currentPage === 'department_detail.php' && isset($_GET['id']) && intval($_GET['id']) == $department_row['id']) ? 'active' : '';
                                            echo '<li><a class="dropdown-item ' . $departmentLinkActive . '" href="department_detail.php?id=' . htmlspecialchars($department_row['id']) . '">';
                                            echo htmlspecialchars($department_row['name']);
                                            echo '</a></li>';
                                        }
                                        echo '</ul>'; 
                                    }
                                    echo '</li>'; 
                                }
                            } else {
                                echo '<li><a class="dropdown-item" href="#">No Faculties Found</a></li>';
                            }
                            ?>
                        </ul>
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
                        <a class="nav-link <?= isActive('contact.php', $currentPage) ?>" href="contact.php">CONTACT US</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.dropdown-submenu a.dropdown-toggle').forEach(function(element){
            element.addEventListener('click', function (e) {
                let nextEl = this.nextElementSibling;
                if(nextEl && nextEl.classList.contains('dropdown-menu')){
                    e.preventDefault();
                    e.stopPropagation(); 

                    let parentDropdown = this.closest('.dropdown-menu');
                    if(parentDropdown){
                        parentDropdown.querySelectorAll('.dropdown-menu.show').forEach(function(el){
                            if (el !== nextEl) { 
                                el.classList.remove('show');
                                el.closest('.dropdown-submenu').classList.remove('show');
                            }
                        });
                    }
                    // Toggle the current submenu
                    nextEl.classList.toggle('show');
                    this.closest('.dropdown-submenu').classList.toggle('show'); 
                }
            });
        });

        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown') && !e.target.closest('.navbar-toggler')) {
                document.querySelectorAll('.dropdown-menu.show').forEach(function(el) {
                    el.classList.remove('show');
                    el.closest('.dropdown-submenu')?.classList.remove('show');
                });
                const navbarCollapse = document.getElementById('navbarNav');
                if (navbarCollapse && navbarCollapse.classList.contains('show')) {
                    if (!e.target.closest('.navbar-toggler')) {
                        const bsCollapse = new bootstrap.Collapse(navbarCollapse, { toggle: false });
                        bsCollapse.hide();
                    }
                }
            }
        });

        const navbarToggler = document.querySelector('.navbar-toggler');
        const navbarCollapse = document.getElementById('navbarNav');

        navbarToggler.addEventListener('click', function() {
            document.querySelectorAll('.dropdown-menu.show').forEach(function(el) {
                el.classList.remove('show');
                el.closest('.dropdown-submenu')?.classList.remove('show');
            });
        });

        document.querySelectorAll('.dropdown-menu.dropdown-submenu').forEach(function(el){
            el.addEventListener('click', function (e) {
                if (window.innerWidth >= 992) { 
                    e.stopPropagation();
                }
            });
        });
    });
</script>
</body>
</html> 