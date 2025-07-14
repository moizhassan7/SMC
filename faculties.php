<?php
$sql = "SELECT * FROM faculties ORDER BY name ASC";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Faculties - Sargodha Medical Collage</title>
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
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-gray);
            color: var(--dark-text);
        }

        .section-title {
            color: var(--primary-color);
            font-size: 2.8em;
            font-weight: 700;
            margin-bottom: 40px;
            position: relative;
            padding-bottom: 15px;
        }



        .faculty-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            height: 100%;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .faculty-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .faculty-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .faculty-card-body {
            padding: 25px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .faculty-card-title {
            font-size: 1.8em;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .faculty-card-text {
            font-size: 1em;
            color: var(--light-text);
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            flex-grow: 1;
        }

        .btn-view-details {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 600;
            align-self: flex-start;
            transition: background-color 0.3s ease;
        }

        .btn-view-details:hover {
            background-color: var(--secondary-color);
            color: white;
        }

        .no-faculties-found {
            text-align: center;
            padding: 50px 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-top: 30px;
            color: var(--light-text);
            font-size: 1.2em;
        }

        @media (max-width: 768px) {
            .section-title {
                font-size: 2.2em;
            }
            .faculty-card-title {
                font-size: 1.5em;
            }
            .faculty-card img {
                height: 160px;
            }
        }
    </style>
</head>
<body>

<div class="container py-5">
    <h2 class="section-title" style="text-align: center;">Our Faculties</h2>

    <?php if ($result->num_rows > 0): ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" style="display: flex; justify-content: space-evenly;">
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="col d-flex">
                    <div class="faculty-card">
                        <?php if (!empty($row['image_url'])): ?>
                            <img src="images/<?= htmlspecialchars($row['image_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['name']) ?> Image">
                        <?php else: ?>
                            <img src="https://via.placeholder.com/400x200?text=Faculty+Image" class="card-img-top" alt="Placeholder Image">
                        <?php endif; ?>

                        <div class="faculty-card-body">
                            <h5 class="faculty-card-title"><?= htmlspecialchars($row['name']) ?></h5>
                            <p class="faculty-card-text">
                                <?= htmlspecialchars(substr($row['overview'], 0, 150)) . (strlen($row['overview']) > 150 ? '...' : '') ?>
                            </p>
                            <a href="faculty_detail.php?id=<?= $row['id'] ?>" class="btn btn-view-details mt-auto">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="no-faculties-found">
            <p><i class="far fa-sad-tear me-2"></i>No faculties found yet. Please check back later!</p>
        </div>
    <?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
