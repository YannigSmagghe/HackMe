<html>
<head>
    <title>List books</title>
</head>

<body>
<?php
//including the database connection file
include_once("config.php");

$books = mysqli_query($mysqli, "SELECT id, denomination FROM comics;")

?>

<h1>Liste des livres.</h1>

<ul>
    <?php
    while ($row = $books->fetch_array()) {
        ?>
        <li>
            <a href="fiche.php?name=<?= $row['denomination'] ?>"> <?= $row['denomination'] ?></a>
        </li>
        <?php
    }
    ?>
</ul>


</body>
</html>
