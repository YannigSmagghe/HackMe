<?php

$dir = '/tmp';
$files1 = scandir($dir);
$files2 = scandir($dir, 1);


?>

<html>
<head>
    <title>Homepage</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
<div class="container-fluid top">
<ul>
    <li>
        <a href="../index.php">Home</a>
    </li>
</ul>
</div>

<div class="container bc-secondaire">
    <h1>Book Reader</h1>
    <ul>
        <?php
        if ($handle = opendir('.')) {

            echo('<ul>');
            while (false !== ($entry = readdir($handle))) {

                if ($entry != "." && $entry != ".." && $entry != "index.php" && $entry != "liseuse.php") {
                    $message = "<li><a href=liseuse.php/?livres=". $entry . ">" . $entry . "</a></li>";
                    echo $message;
                }
            }
            echo('</ul>');

            closedir($handle);
        }
        ?>
    </ul>
</div>
</body>
</html>
