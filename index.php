<!DOCTYPE html>

<html>
<head>
    <title>Netflix</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="shortcut icon" href="images/pornflix.ico">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
</head>

<body>
    <?php
        include_once "php/header.php";
        include "php/videos.php";

    ?>
    <div id="content">
        <ul>
            <?php
                showVideos();
            ?>
        </ul>
    </div>
</body>

</html>
