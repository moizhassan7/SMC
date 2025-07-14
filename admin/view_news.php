<?php session_start();
include_once "links.html";
include_once "../config.php";
?>
<body style="background:none;">
<div id="view" class="col-md-12 col-sm-12 col-xs-12">
<h4 style="text-align:center; color:#fff; padding-top:3%; padding-bottom:3; text-transform:uppercase;">View News and Events</h4>

<a href="add_news.php">
<button type="button" class="btn btn-info" style="margin-left:20px; margin-bottom:20px;">Add News and Events<span class="glyphicon glyphicon-plus" style="padding-left:20px;"></span></button></a>

<div class="table-responsive col-md-12 col-sm-12 col-xs-12"  style="height:400px;">
<table class="table table-bordered">

<tr>
<th>Sr#</th>
<th>Title</th>
<th>Description</th>
<th>Event Date</th>
<th>Full Article</th>
<th>Main Image</th>
<th>Additional Images</th>
<th>Edit</th>
<th>Delete</th>
</tr>
<?php
$count=1;
$q=mysqli_query($con,"select * from news_events ORDER BY event_date DESC");
while($row=mysqli_fetch_array($q))
{
?>
<tr>
<td><?php echo $count; ?></td>
<td><?php echo htmlspecialchars($row['title']); ?></td>
<td><?php echo htmlspecialchars(substr($row['description'], 0, 50)) . (strlen($row['description']) > 50 ? '...' : ''); ?></td>
<td><?php echo htmlspecialchars($row['event_date']); ?></td>
<td><?php echo htmlspecialchars(substr($row['full_article'], 0, 50)) . (strlen($row['full_article']) > 50 ? '...' : ''); ?></td>
<td>
    <?php if (!empty($row['image_url'])) { ?>
        <img src="../images/<?php echo htmlspecialchars($row['image_url']); ?>" alt="news_img" style="width: 70px; height: 70px; object-fit: cover;">
    <?php } else { ?>
        No Image
    <?php } ?>
</td>
<td>
    <?php
    $additional_images_arr = !empty($row['additional_images']) ? explode(',', $row['additional_images']) : [];
    if (!empty($additional_images_arr)) {
        foreach ($additional_images_arr as $img) {
            if (!empty($img)) {
                echo '<img src="../images/' . htmlspecialchars($img) . '" alt="add_img" style="width: 50px; height: 50px; object-fit: cover; margin-right: 5px;">';
            }
        }
    } else {
        echo 'None';
    }
    ?>
</td>
<td>
<a href="edit_news.php?id=<?php echo htmlspecialchars($row['id']); ?>">
<img src="img/edit.png" style="cursor:pointer;">
</a>
</td>

<td>
<a href="del_news.php?id=<?php echo htmlspecialchars($row['id']);?>" onClick="return confirm('Are You Sure you want to Permanently Delete it?');"><img src="logo/deletep.png" class="center-block"></a>
</td>

</tr>
<?php $count++; } ?>
</table>
</div>
</div>
</body>
</html>