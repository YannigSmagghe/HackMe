<?php
//including the database connection file
include_once("config.php");

//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($mysqli, "SELECT * FROM people ORDER BY id DESC"); // using mysqli_query instead
?>

<html>
<head>	
	<title>Homepage</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
<div class="container-fluid top">
    <ul>
        <li>
            <a href="register.html">Register</a>
        </li>
        <li>
            <a href="login.html">Login</a>
        </li>
        <li>
            <a href="search.php">Search book</a>
        </li>
        <li>
            <a href="books.php">List books</a>
        </li>
        <li>
            <a href="livres/index.php">Book reader</a>
        </li>
        <li>
            <a href="admin/admin.php">Bonus game</a>
        </li>
    </ul>
</div>
<div class="container bc-secondaire">
    <table width='80%' border=0>

        <tr bgcolor='#CCCCCC'>
            <td>Name</td>
            <td>Age</td>
            <td>Email</td>
            <!--		<td>Update</td>-->
        </tr>
        <?php
        //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array
        while($res = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>".$res['denomination']."</td>";
            echo "<td>".$res['age']."</td>";
            echo "<td>".$res['email']."</td>";
            //echo "<td><a href=\"profil.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
        }
        ?>
    </table>
</div>
</body>
</html>
