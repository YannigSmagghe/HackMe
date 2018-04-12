<html>
<head>
    <title>Search book</title>
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
    <h1>Rechercher un livre.</h1>

    <form action="search.php" method="post">
        <div class="row">
            <select name="books" id="select_book">
                <?php
                while($row = $books->fetch_array()){
                    ?>
                    <option value="<?= $row['id']  ?>"><?= $row['denomination'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="row submit">
            <input type="submit" value="Valider">
        </div>
    </form>
</div>


<?php
//traitement formulaire

$data = mysqli_escape_string($mysqli, $_POST['books']);

$result = mysqli_query($mysqli, "SELECT denomination, denomination_secondaire, code
    FROM comics
    WHERE id = $data; ");


//if ($mysqli->error) {
//    echo '<h3 style="color:red;">' . $mysqli->error . '</h3>';
//}

echo '<div class="container"><ul>';
while ($row = $result->fetch_array()) {
    echo '<li>' .  $row['denomination'] . ' - ' .  $row['denomination_secondaire'] . ' // code : ' . $row['code'] . '</li>';
}
echo '</ul></div>';

?>


</body>
</html>
