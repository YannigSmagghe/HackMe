<html>
<head>
    <title>Search book</title>
</head>

<body>
<?php
//including the database connection file
include_once("config.php");

$books = mysqli_query($mysqli, "SELECT id, denomination FROM comics;")

?>

<h1>Rechercher un livre.</h1>

<form action="search.php" method="post">
    <select name="books" id="select_book">
        <?php
        while($row = $books->fetch_array()){
            ?>
            <option value="<?= $row['id']  ?>"><?= $row['denomination'] ?></option>
            <?php
        }
        ?>
    </select>
    <input type="submit" value="Valider">
</form>


<?php
//traitement formulaire

$data = mysqli_escape_string($mysqli, $_POST['books']);

$result = mysqli_query($mysqli, "SELECT denomination,id, denomination_secondaire, code
    FROM comics
    WHERE id = $data; ");


//if ($mysqli->error) {
//    echo '<h3 style="color:red;">' . $mysqli->error . '</h3>';
//}

echo '<ul>';
while ($row = $result->fetch_array()) {
    echo '<li>' .  $row['denomination'] . ' - ' .  $row['denomination_secondaire'] . ' // code : ' . $row['code'] . '</li>';
}
echo '</ul>';

?>


</body>
</html>
