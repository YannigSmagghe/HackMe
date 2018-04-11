<html>
<head>
    <title>List books</title>
</head>

<body>
<?php
//including the database connection file
include_once("config.php");

$name = $_GET['name'];
$book = mysqli_query($mysqli, "
SELECT id, denomination, denomination_secondaire, code 
FROM comics
WHERE denomination = '$name'
;");

$commentaires = mysqli_query($mysqli, "
SELECT commentarie, user_name, comics_name
FROM commentaries
WHERE comics_name = '$name'
");


?>

<?php
while ($row = $book->fetch_array()) { ?>
    <h1> <?= $row['denomination'] ?> </h1>
    <h3> <?= $row['denomination_secondaire'] ?> </h3>
    <p> <?= $row['code'] ?> </p>
<?php } ?>
<hr>
<h1 style="border-bottom: 1px solid cadetblue;">Les commentaires</h1>
<div>
    <?php while ($row = $commentaires->fetch_array()) {
        if(sizeof($row) > 0) {
        ?>
        <h6 style="color: dimgrey;"> Titre <?= $row['user_name'] ?></h6><br>
        <p><?= $row['commentarie'] ?></p>
    <?php }else{
            echo '<p>Aucun commentaire.</p>';
        }
    } ?>
</div>

<form action="fiche.php?name=<?= $name ?>" method="post">
    <input type="text" name="user_name" placeholder="Nom..." required> <br><br>
    <textarea name="comment" rows="4" cols="50" required></textarea> <br><br>
    <input type="submit" value="Envoyer le commentaire">
</form>


<?php

$user_name = mysqli_escape_string($mysqli, $_POST['user_name']);
$comment = mysqli_escape_string($mysqli, $_POST['comment']);

function verif_script($user){
    if(strstr($user, '<script>')){
        echo '<h1 style="color: red;">hahahaha</h1>';
        return false;
    }
    return true;
}

if(verif_script($user_name) && !empty($_POST)){
    $add_comment = mysqli_query($mysqli, "
INSERT INTO commentaries (user_name, commentarie, comics_name) VALUES ('$user_name', '$comment', '$name');
");
}


if ($mysqli->error) {
    echo '<h3 style="color:red;">' . $mysqli->error . '</h3>';
}



?>


</body>
</html>