<?php
session_start();
include "config.php";
include_once "header.php"; // Assuming your header includes Bootstrap and custom CSS

$department_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($department_id == 0) {
    header("Location: index.php"); // Or your main departments listing page
    exit();
}

// Fetch department details
$sql_department = "SELECT * FROM departments WHERE id = $department_id";
$result_department = $con->query($sql_department);
$department = $result_department->fetch_assoc();

// Check if department exists
if (!$department) {
    header("Location: index.php?error=departmentnotfound"); // Redirect if not found
    exit();
}

// Fetch Chairman details for this department
$sql_chairman = "SELECT * FROM chairmen WHERE department_id = $department_id LIMIT 1";
$result_chairman = $con->query($sql_chairman);
$chairman = $result_chairman->fetch_assoc();

// Fetch Staff Members for this department
$sql_staff = "SELECT * FROM staff_members WHERE department_id = $department_id ORDER BY name ASC";
$result_staff = $con->query($sql_staff);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($department['name']) ?> - SMC</title>
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


        .section-heading {
            color: var(--primary-color);
            font-size: 2em;
            font-weight: 600;
            margin-top: 40px;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 10px;
        }

        .section-heading::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 60px;
            height: 3px;
            background-color: var(--primary-color);
            border-radius: 2px;
        }

        .overview-box {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            height: 100%; /* Ensure consistent height in grid */
        }

        .chairman-box {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            height: 100%; /* Ensure consistent height in grid */
        }

        .chairman-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--primary-color);
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .chairman-name {
            font-size: 1.8em;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 5px;
        }

        .chairman-designation {
            font-size: 1.1em;
            color: var(--secondary-color);
            font-weight: 500;
            margin-bottom: 15px;
        }

        .chairman-message {
            font-size: 0.95em;
            color: var(--light-text);
            font-style: italic;
        }

        .staff-member-card {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            height: 100%;
            width: 400px;
        }

        .staff-member-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--light-gray);
            margin-bottom: 15px;
        }

        .staff-member-name {
            font-size: 1.3em;
            font-weight: 600;
            color: var(--dark-text);
            margin-bottom: 5px;
        }

        .staff-member-designation {
            font-size: 0.9em;
            color: var(--light-text);
            margin-bottom: 10px;
        }

        .staff-member-details {
            font-size: 0.85em;
            color: var(--light-text);
            flex-grow: 1; /* Allows details to take available space */
            text-align: left; /* Align text within details */
            width: 100%;
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


        @media (max-width: 991px) {
            .department-hero-image {
                height: 300px;
            }
            .chairman-box, .overview-box {
                margin-bottom: 20px; /* Less margin on smaller screens */
            }
        }

        @media (max-width: 767px) {
            .department-title {
                font-size: 2.2em;
            }
            .department-hero-image {
                height: 250px;
            }
            .section-heading {
                font-size: 1.8em;
            }
            .chairman-box {
                padding: 20px;
            }
            .chairman-img {
                width: 120px;
                height: 120px;
            }
            .chairman-name {
                font-size: 1.5em;
            }
            .staff-member-card {
                padding: 15px;
            }
            .staff-member-img {
                width: 100px;
                height: 100px;
            }
        }
    </style>
</head>
<body>
<div class="container-fluid faculty-hero">
    <?php if (!empty($department['image_url'])): ?>
        <img src="images/<?= htmlspecialchars($department['image_url']) ?>" alt="<?= htmlspecialchars($department['name']) ?> Image" class="dept-hero-image">
    <?php else: ?>
        <img src="https://bshksk.uet.edu.pk/wp-content/uploads/2016/11/Picture-3.jpeg" alt="Placeholder Image" class="departmetn-hero-image">
    <?php endif; ?>
    <div class="faculty-hero-overlay">
        <h1><?= htmlspecialchars($department['name']) ?></h1>
    </div>
</div>

<div class="container py-5">
    
    <div class="row">
        <div class="col-lg-8">
            <div class="overview-box">
                <h2 class="section-heading">Overview</h2>
                <p><?= nl2br(htmlspecialchars($department['overview'])) ?></p>
            </div>
        </div>
        <div class="col-lg-4">
            <?php if ($chairman): ?>
                <div class="chairman-box">
                    <img src="images/<?= htmlspecialchars($chairman['image_url'] ?: 'placeholder_chairman.jpg') ?>" alt="<?= htmlspecialchars($chairman['name']) ?>" class="chairman-img">
                    <h3 class="chairman-name"><?= htmlspecialchars($chairman['name']) ?></h3>
                    <p class="chairman-designation"><?= htmlspecialchars($chairman['designation']) ?></p>
                    <?php if (!empty($chairman['message'])): ?>
                        <p class="chairman-message">"<?= nl2br(htmlspecialchars($chairman['message'])) ?>"</p>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="chairman-box text-muted">
                    <i class="fas fa-user-tie fa-4x mb-3" style="color: var(--light-text);"></i>
                    <p>Chairman details not available yet.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <h2 class="section-heading">Staff Members</h2>
    <?php if ($result_staff->num_rows > 0): ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php while($staff = $result_staff->fetch_assoc()): ?>
                <div class="col d-flex">
                    <div class="staff-member-card">
                        <img src="images/<?= htmlspecialchars($staff['image_url'] ?: 'placeholder_staff.jpg') ?>" alt="<?= htmlspecialchars($staff['name']) ?>" class="staff-member-img">
                        <h4 class="staff-member-name"><?= htmlspecialchars($staff['name']) ?></h4>
                        <p class="staff-member-designation"><?= htmlspecialchars($staff['designation']) ?></p>
                       
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p class="text-muted text-center">No staff members listed for this department yet.</p>
    <?php endif; ?>

    <a href="faculty_detail.php?id=<?= htmlspecialchars($department['faculty_id']) ?>" class="btn back-button">
        <i class="fas fa-arrow-left me-2"></i> Back to Faculty
    </a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include'footer.php'; ?>
</body>
</html>

<?php $con->close(); ?>