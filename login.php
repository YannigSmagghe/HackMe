<html>
<head>
    <title>Login</title>
</head>

<body>
<?php
// Start the session
session_start();
//including the database connection file
include_once("config.php");

$login = mysqli_real_escape_string($mysqli, $_POST['login']);
$password = mysqli_real_escape_string($mysqli, $_POST['password']);

// checking empty fields
if(empty($login) || empty($password)){

    if(empty($login)) {
        echo "<font color='red'>$login login field is empty.</font><br/>";
    }

    if(empty($password)) {
        echo "<font color='red'>$password login field is empty.</font><br/>";
    }

    //link to the previous page
    echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
} else {
    // if all the fields are filled (not empty)

    //insert data to database
    $hashed_password = md5($password);
    $result = mysqli_query($mysqli, "SELECT IF( EXISTS(
            SELECT denomination
            FROM people
            WHERE `denomination` =  '" . $login . "' AND `code_2_connexion` = '" . $hashed_password . "'), true, false)");
    $res = mysqli_fetch_array($result);
//    var_dump($res);die;
    if ($res[0] === '1'){
        $data = mysqli_query($mysqli, "
            SELECT *
            FROM people
            WHERE `denomination` =  '" . $login . "' AND `code_2_connexion` = '" . $hashed_password . "'");
        $data = mysqli_fetch_array($data);
        $_SESSION["userId"] = $data['id'];
    }

    //display success message
    echo "<font color='green'>New Users added successfully.";
    echo "<br/><a href='index.php'>View Result</a>";

    if ($res[0] === '1'){
        header('Location: profil.php');
    }else{
        header('Location: index.php');
    }
}
?>
</body>
</html>
