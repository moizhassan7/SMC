<?php
session_start();
include "config.php";
include_once "header.php"; // Assuming you have a header.php file

// Get faculty ID from URL and sanitize it
$faculty_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($faculty_id == 0) {
    // Redirect or show an error if no ID is provided
    header("Location: index.php"); // Or wherever your faculty listing page is
    exit();
}

// Fetch faculty details
$sql_faculty = "SELECT * FROM faculties WHERE id = $faculty_id";
$result_faculty = $con->query($sql_faculty);
$faculty = $result_faculty->fetch_assoc();

// Check if faculty exists
if (!$faculty) {
    header("Location: index.php?error=facultynotfound"); // Redirect if faculty not found
    exit();
}

// Fetch departments related to this faculty, NOW INCLUDING THE 'id'
$sql_departments = "SELECT id, name FROM departments WHERE faculty_id = $faculty_id ORDER BY name ASC";
$result_departments = $con->query($sql_departments);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($faculty['name']) ?> - SMC</title>
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
            --border-color: #eee;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-gray);
            color: var(--dark-text);
            line-height: 1.7;
        }

        .container-fluid.faculty-hero {
            padding: 0;
            overflow: hidden;
            position: relative;
            height: 70vh;
        }

        .faculty-hero-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(0.7);
        }

        .faculty-hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: rgba(0, 0, 0, 0.4); /* Dark overlay */
            color: white;
            flex-direction: column;
            padding: 20px;
        }

        .faculty-hero-overlay h1 {
            font-size: 3.5em;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .faculty-hero-overlay p {
            font-size: 1.2em;
            max-width: 800px;
            opacity: 0.9;
        }

        .faculty-content-section {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 40px;
            margin-top: -80px; /* Overlap with hero section */
            position: relative;
            z-index: 1;
        }

        .section-title {
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

        .overview-text {
            font-size: 1.1em;
            color: var(--dark-text);
            margin-bottom: 30px;
        }

        .departments-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }

        .departments-list li {
            background-color: var(--light-gray);
            border-left: 5px solid var(--primary-color);
            padding: 15px 20px;
            border-radius: 5px;
            font-size: 1em;
            color: var(--dark-text);
            font-weight: 500;
            transition: transform 0.2s ease, background-color 0.2s ease;
        }

        .departments-list li:hover {
            transform: translateX(5px);
            background-color: #e6e6e6;
        }
        
        .back-button {
            background-color: #6c757d; /* Bootstrap secondary color */
            color: white;
            padding: 10px 25px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-top: 30px;
            display: inline-flex;
            align-items: center;
        }

        .back-button:hover {
            background-color: #5a6268;
            color: white;
        }

        @media (max-width: 768px) {
            .container-fluid.faculty-hero {
                height: 40vh;
            }
            .faculty-hero-overlay h1 {
                font-size: 2.5em;
            }
            .faculty-hero-overlay p {
                font-size: 1em;
            }
            .faculty-content-section {
                padding: 20px;
                margin-top: -40px;
            }
            .section-title {
                font-size: 1.8em;
            }
            .departments-list {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="container-fluid faculty-hero">
    <?php if (!empty($faculty['image_url'])): ?>
        <img src="images/<?= htmlspecialchars($faculty['image_url']) ?>" alt="<?= htmlspecialchars($faculty['name']) ?> Image" class="faculty-hero-image">
    <?php else: ?>
        <img src="https://bshksk.uet.edu.pk/wp-content/uploads/2016/11/Picture-3.jpeg" alt="Placeholder Image" class="faculty-hero-image">
    <?php endif; ?>
    <div class="faculty-hero-overlay">
        <h1><?= htmlspecialchars($faculty['name']) ?></h1>
    </div>
</div>

<div class="container py-5">
    <div class="faculty-content-section">
        <h2 class="section-title">Overview</h2>
        <p class="overview-text">
            <?= nl2br(htmlspecialchars($faculty['overview'])) ?>
        </p>

        <h2 class="section-title">Departments</h2>
        <?php if ($result_departments->num_rows > 0): ?>
            <ul class="departments-list">
                <?php while ($department = $result_departments->fetch_assoc()): ?>
                <li>
                    <a href="department_detail.php?id=<?= htmlspecialchars($department['id']) ?>" style="text-decoration: none; color: inherit;">
                        <i class="fas fa-arrow-right me-2" style="color: var(--secondary-color);"></i> <?= htmlspecialchars($department['name']) ?>
                    </a>
                </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p class="text-muted">No departments listed for this faculty yet.</p>
        <?php endif; ?>

        <a href="index.php" class="btn back-button">
            <i class="fas fa-arrow-left me-2"></i> Back to Faculties
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'footer.php'; ?>
</body>
</html>

<?php $con->close(); ?>