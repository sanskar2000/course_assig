<?php

	if(isset($_POST['cancel']))
	{
		header("Location: index.php");
	}
	$nameErr="";
	$str="php123";
	$pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc', 
   'root', '');
	//$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if (isset($_POST['who']) && isset($_POST['pass']))
	{
		if(strlen($_POST['who'])<1 && strlen($_POST['who'])<1)
		{
			$nameErr = "User name and password are required";
		}
		else if(strpos($_POST['who'],"@")== false)
		{
			$nameErr = "Email must have an at-sign (@)";
		}
		else
		{
			$check=$_POST['pass'];
			if ($_POST['pass'] == $str)
			{
				header("Location: autos.php?name=".urlencode($_POST['who']));
				error_log("Login success ".$_POST['who']);
			}
			else
			{
				$nameErr ="Incorrect password";
				error_log("Login fail ".$_POST['who']." $check");

			}
		}

	}
?>


<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		.error{
			color: red;
		}
	</style>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<title>Chuck Severance's Login Page</title>
</head>
<body>
<div class="container">
<h1>Please Log In</h1>


<form method="post" >
	<div class="error"><?php echo "$nameErr" ?></div>
<label for="nam">User Name</label>
<input type="text" name="who" id="nam"><br/>
<label for="id_1723">Password</label>
<input type="text" name="pass" id="id_1723"><br/>
<input type="submit" value="Log In">
<input type="submit" name="cancel" value="Cancel">
</form>
<p>
For a password hint, view source and find a password hint
in the HTML comments.
<!-- Hint: The password is the three character name of the 
programming language used in this class (all lower case) 
followed by 123. -->
</p>
</div>
</body>
