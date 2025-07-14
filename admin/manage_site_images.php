<?php
session_start();
include_once "links.html"; // Your admin panel includes (Bootstrap, etc.)
include_once "../config.php"; // Database connection

// Fetch current site settings
$settings = [];
$q = mysqli_query($con, "SELECT * FROM site_settings");
while ($row = mysqli_fetch_assoc($q)) {
    $settings[$row['setting_key']] = [
        'value' => $row['setting_value'],
        'description' => $row['description']
    ];
}
?>
<body style="background:none;">
<link rel="stylesheet" type="text/css" href="css/style.css">

<div class="col-md-12 col-sm-12 col-xs-12" id="mainadd">
    <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2" id="adddata">

        <h3 style="text-align:center;">Manage Site Images & Banners</h3>
        <p class="text-center text-muted">Update the key images and banners used across the website.</p>

        <form action="update_site_images.php" method="post" enctype="multipart/form-data">

            <?php
            // Define the images you want to manage in the form
            $imageFields = [
                'principal_image' => 'Principal\'s Message Page Image',
                'vision_mission_highlight_image' => 'Vision & Mission Highlight Box Background',
                'vision_mission_hero_banner' => 'Vision & Mission Page Banner (Hero)',
                'research_hero_banner' => 'Research Page Banner (Hero)',
                'admission_hero_banner' => 'Admission Criteria Page Banner (Hero)',
                // Add more fields here as needed
                // 'why_choose_us_image' => 'Why Choose Us Section Image',
            ];

            foreach ($imageFields as $key => $label):
                $current_value = $settings[$key]['value'] ?? '';
                $description_text = $settings[$key]['description'] ?? $label;
            ?>
                <div class="form-group mb-4 p-3 border rounded">
                    <label for="<?= $key ?>_file"><strong><?= htmlspecialchars($label) ?></strong></label>
                    <p class="text-muted small"><?= htmlspecialchars($description_text) ?></p>

                    <?php if (!empty($current_value)): ?>
                        <div class="mb-2">
                            <img src="../images/<?= htmlspecialchars($current_value) ?>" alt="Current <?= htmlspecialchars($label) ?>" style="max-width: 200px; height: auto; border: 1px solid #ddd; border-radius: 4px;">
                            <span class="ms-2 text-muted small">Current: <?= htmlspecialchars($current_value) ?></span>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="delete_<?= $key ?>" id="delete_<?= $key ?>" value="1">
                            <label class="form-check-label" for="delete_<?= $key ?>">
                                Delete current image
                            </label>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">No image uploaded for this section yet.</p>
                    <?php endif; ?>

                    <label for="<?= $key ?>_file" class="form-label mt-2">Upload New Image</label>
                    <input type="file" class="form-control" name="<?= $key ?>" id="<?= $key ?>_file" accept="image/*"/>
                    <small class="form-text text-muted">Upload a new image (JPG, PNG, GIF) to update.</small>
                </div>
            <?php endforeach; ?>

            <div class="form-group text-center">
                <input type="submit" class="btn btn-primary btn-lg" value="Update All Images" style="margin-bottom:20px;">
            </div>
        </form>
    </div>
</div>
</body>
</html>