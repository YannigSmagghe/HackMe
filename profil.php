<?php
// including the database connection file
include_once("config.php");
session_start();
if (isset($_POST['update'])) {

    $id = mysqli_real_escape_string($mysqli, $_POST['id']);

    $name = mysqli_real_escape_string($mysqli, $_POST['name']);
    $password = mysqli_real_escape_string($mysqli, $_POST['password']);
    $age = mysqli_real_escape_string($mysqli, $_POST['age']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $avatar = mysqli_real_escape_string($mysqli, $_POST['avatar']);

    // checking empty fields
    if (empty($name) || empty($age) || empty($email) || empty($avatar) || empty($password)) {

        if (empty($name)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }
        if (empty($password)) {
            echo "<font color='red'>Password field is empty.</font><br/>";
        }

        if (empty($age)) {
            echo "<font color='red'>Age field is empty.</font><br/>";
        }

        if (empty($email)) {
            echo "<font color='red'>Email field is empty.</font><br/>";
        }
        if (empty($avatar)) {
            echo "<font color='red'>Avatar field is empty.</font><br/>";
        }

    } else {
        //updating the table
        $hashed_password = md5($password);
        $result = mysqli_query($mysqli, "UPDATE people SET denomination='$name',age='$age',email='$email'
                                                ,avatar='$avatar',code_2_connexion='$hashed_password'WHERE id=".$_SESSION['userId']);

        //redirectig to the display page. In our case, it is index.php
        header("Location: profil.php");
    }
}
?>
<?php
//getting id from url
$id = $_SESSION['userId'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM people WHERE id=$id");


while ($res = mysqli_fetch_array($result)) {
    $name = $res['denomination'];
    $age = $res['age'];
    $email = $res['email'];
    $avatar = $res['avatar'];
}
?>
<html>
<head>
    <title>Edit Data</title>
</head>

<body>
<a href="index.php">Home</a>
<br/><br/>

<form name="form1" method="post" action="profil.php">
    <table border="0">
        <tr>
            <td>login</td>
            <td><input type="text" name="name" value="<?php echo $name; ?>"></td>
        </tr>
        <tr>
            <td>password</td>
            <td><input  placeholder="Password" id="password" name="password" required></td>
        </tr>
        <tr>
            <td>confirm password</td>

            <td><input type="password" placeholder="Confirm Password" id="confirm_password" required></td>
            <!--<td><input type="password" placeholder="Confirm Password" id="confirm_password" required></td>-->

        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email" value="<?php echo $email; ?>"></td>
        </tr>
        <tr>
            <td>age</td>
            <td><input type="text" name="age" value="<?php echo $age; ?>"></td>
        </tr>
        <tr>
            <td>avatar</td>
            <td><input type="file" name="avatar" id="fileToUpload" value="<?php echo $avatar; ?>"></td>
        </tr>

        <tr>
            <td><input type="hidden" name="id" value=<?php echo $_GET['id']; ?>></td>
            <td><input type="submit" name="update" value="Update"></td>
        </tr>
    </table>
</form>
<script src="script.js"></script>
</body>
</html>
