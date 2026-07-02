<?php


include("config.php");


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="stylesheet" href="styles.css">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>

    <nav class="navbar">

        <div class="logo">
            <a href="#">YtPlay</a>
        </div>

        <ul class="nav-links">
            <li><a href="#">Home</a></li>
            <li><a href="#">Tools</a></li>
            <li><a href="#">Guides</a></li>
        </ul>

        <div class="nav-right">

            <a href="#" class="feedback">
                <i class="fa-regular fa-comment"></i>
                Feedback
            </a>

            <a href="#" class="language">
                <i class="fa-solid fa-globe"></i>
                English
                <i class="fa-solid fa-chevron-down"></i>
            </a>

        </div>

    </nav>

    <div class="content">
        <h2>Youtube Playlist Length Calculator</h2>
        <p>Calculate total duration instantly. See how long it takes to watch at different playbacks speeds (1.25x, 1.5x, 2x)</p>
    </div>
    <div class="playlist">
        <form action="index.php" method="post">
            <label for="">Paste Youtube URL --> </label>
            <input class="url" type="text" name="link"
            placeholder="Playlist -> https://www.youtube.com/watch?v=X8t8axbZnH8
                                    youtube.com
                                    Tip: Paste multiple links one per line">
             <input type="submit" name="submit" value="Calculate">                       
        </form>
    </div>




</body>
</html>



<?php

include("result.php");

?>