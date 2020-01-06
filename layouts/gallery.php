<?php
require_once '../db.php';
require '../models/file.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formula 1 | Drivers</title>
    <link rel="icon" type="image/png" href="static/racing-flag.png">
    <link rel="stylesheet" href="static/style.css">
    <script src="static/darkmode.js"></script>
</head>
<body>
    <header>
        <img src="static/f1.svg" alt="logo">
    </header>
    <nav>
        <a href="/">Home</a>     
        <div class="dropdown active">
            <span>Drivers</span>
            <div class="dropdown-content">
                <a href="/info">Driver Information</a>
                <a href="/gallery">Driver Gallery</a>
                <a href="/form">Upload Your Files</a>
            </div>
        </div>
        <a href="/teams">Teams</a>
        <a href="/form">Upload</a>
    </nav>
    <div class="content" id="content-dark">
        <div class="paragraph" id="para-dark">
            <h2 class="h2dark">Driver Gallery.</h2>
            <div class="row">
                <div class="gallery ">
                    <?php
                        $images = fileHandling::get_all();
                        $num = 0;
                        $page = 0;
                        if(isset($_GET["page"])){
                            $page = $_GET["page"];
                            $page = ($page*4)-4;
                        } ?>
                    <?php foreach($images as $image): ?>
                        <?php if($num >= $page && $num < $page + 4): ?>
                        <div class="gcol-3 gcol-s-6 gallerybox">
                            <a href="/images/watermarked_images/<?= $image -> filename; ?>" target="_blank"><img src="images/thumbnails/<?= $image -> filename; ?>" alt="<?= $image -> title; ?>"></a>
                            <p><?= $image -> title; ?></p>
                            <p><?= $image -> author; ?></p>
                        </div>
                        <?php endif ?>
                        <?php $num++; ?>
                    <?php endforeach ?>
                    <!-- <div class="gcol-3 gcol-s-6 gallerybox">
                        <img src="images/thumbnails/ " alt=" ">
                        <p>Ferrari</p>
                        <p>Charles Leclerc</p>
                        <p>No: 16</p>
                        </div> -->
                </div>
            </div>
            <form method="GET" style="height: 70px; ">
                    <?php
                    $a=$num/4;
                    $a=ceil($a);
                    for($page_num = 1; $page_num <= $a; $page_num++): ?>
                        <input type="submit" value="<?= $page_num; ?>" name="page">
                    <?php endfor ?>
            </form>
        </div>
    </div>
    <footer id="footer">
        <p>WAI Project 2019 - made by Marcel Bieniek</p>
        <p>Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik" target="_blank">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon" target="_blank">www.flaticon.com</a></p>
        <p>Logo By Liberty Media - Own work, Public Domain, <a href="https://commons.wikimedia.org/w/index.php?curid=67670446" target="_blank">Link</a></p>
    </footer>
</body>
</html>