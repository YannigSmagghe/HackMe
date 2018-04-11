<html>
<head>
	<title>Register</title>
</head>

<body>
<?php
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
        $hashed_password = crypt($password);
		$result = mysqli_query($mysqli, "INSERT INTO people(denomination,code_2_connexion) VALUES('$login','$hashed_password')");
		
		//display success message
		echo "<font color='green'>New Users added successfully.";
		echo "<br/><a href='index.php'>View Result</a>";
	}
?>
</body>
</html>
