<?php
	$msg="";
	$success="";
	$pdo = new PDO('mysql:host=localhost;port=3306;dbname=misc', 
   'root', '');
	//$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if(isset($_POST['logout']))
	{
		header('Location: index.php');
	}
	if(isset($_GET['name']))
	{
		if(isset($_POST['make']) && ($_POST['year']) && ($_POST['mileage']))
		{
			if(!is_numeric($_POST['year']) && !is_numeric($_POST['mileage']))
			{
				$msg="Mileage and year must be numeric";
			}
			else if(strlen($_POST['make'])<1)
			{
				$msg="Make is required";
			}
			$stmt = $pdo->prepare('INSERT INTO autos
        (make, year, mileage) VALUES ( :mk, :yr, :mi)');
    $stmt->execute(array(
        ':mk' => $_POST['make'],
        ':yr' => $_POST['year'],
        ':mi' => $_POST['mileage']));
    	$success = 'Record inserted';
		}	
		$stmt = $pdo->query("SELECT make, year, mileage FROM autos");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	else
	die("Name parameter missing");
?>


<!DOCTYPE html>
<html>
<head>
<title>Dr. Chuck's Automobile Tracker</title>
<style type="text/css">
		.error{
			color: red;
		}
	</style>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

</head>
<body>
<div class="container">
<h1>Tracking Autos for <?php echo $_GET['name']?></h1>
<form method="post">
	<div class="error"><?php echo "$msg" ?></div>
	<div style="color: green"><?php echo "$success"?></div>
<p>Make:
<input type="text" name="make" size="60"/></p>
<p>Year:
<input type="text" name="year"/></p>
<p>Mileage:
<input type="text" name="mileage"/></p>
<input type="submit" value="Add">
<input type="submit" name="logout" value="Logout">
</form>

<h2>Automobiles</h2>
    <ul>

        <?php
        foreach ($rows as $row) {
            echo '<li>';
            echo htmlentities($row['make']) . ' ' . $row['year'] . ' / ' . $row['mileage'];
        };
        echo '</li><br/>';
        ?>
    </ul>
</div>
</body>
