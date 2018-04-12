<html>
<head>
    <title>List books</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php
//including the database connection file
include_once("config.php");

$books = mysqli_query($mysqli, "SELECT id, denomination FROM comics;")

?>

<div class="container-fluid top">
    <ul>
        <li>
            <a href="index.php">Home</a>
        </li>
    </ul>
</div>
<div class="container bc-secondaire">

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

</div>


</body>
</html>
