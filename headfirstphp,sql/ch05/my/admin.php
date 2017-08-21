
<?php
	$username = 'rock';
	$password = 'roll';

	if(!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])
		|| ($_SERVER['PHP_AUTH_USER'] != $username) || ($_SERVER['PHP_AUTH_PW'] != $password)) {
		header('HTTP/1.1 401 Unautorized');
		header('WWW-Authenticate:Basic realm="Guitar Wars"');
		exit('<h2>Guitar Wars</h2>Sorry, you must enter a valid user name and password to access this page.');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Guitar Wars - High Scores Administration</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<h2>Guitar Wars - High Scores Administration </h2>
	<p>Below is a list of all Guitar Wars high scores. Used this page to remove scores as needed.</p>
  <hr>
<?php
	require_once('appvars.php');
	require_once('connectvars.php');

	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	$query = "select * from guitarwars order by score desc, date asc";
	$data = mysqli_query($dbc, $query);

	echo "<table>";
	while ($row = mysqli_fetch_array($data)) {
		echo '<tr class="scorerow"><td><strong>' . $row['name'] . '</strong></td>';
		echo "<td>" . $row['date'];
		echo "<td>" . $row['name'];
		echo '<td><a href="removescore.php?id='. $row['id'] . '&amp;
			date='. $row['date'] . '&amp;
			name='. $row['name'] . '&amp;
			score='. $row['score'] . '&amp;
			screenshot='. $row['screenshot'].
			'">remove</a></td></tr>';
		}


		echo "</table>";

		mysqli_close($dbc);
?>
</body>
</html>
