<?php

$dir = '/tmp';
$files1 = scandir($dir);
$files2 = scandir($dir, 1);


?>

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
