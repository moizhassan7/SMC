<?php
// This file is for the "Coming Soon" page of the website.
// It is designed to be simple and visually appealing, indicating that the site is under construction.
session_start();
include_once "config.php";
include_once "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coming - Soon</title>
</head>
<style>
    .coming_soon_container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 80vh;
        background-color: #f3f4f6; /* Light gray background */
    }
     h1{
        font-size:3rem; color:#374151; margin-bottom:10px; font-family:'Segoe UI', Arial, sans-serif; text-align: center;"}
    p{
        font-size:1.2rem;
         color:#6b7280; 
         margin-bottom:30px;
        text-align: center;
        font-family:'Segoe UI', Arial, sans-serif;

        
    }
</style>
<body>
    <div class="coming_soon_container">
         <h1 >Coming Soon</h1>
        <p>We're working hard to bring you something awesome. <strong>
 Please check back later!
        </strong></p>

    </div>
       
       
    </div>
</body>
<?php
include_once "footer.php";
?>
</html>