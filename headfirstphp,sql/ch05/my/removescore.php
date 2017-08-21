<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Guitar Wars - Remove Your High Score</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<h2>Guitar Wars - Remove a high score </h2>
	<?php
		require_once('appvars.php');
		require_once('connectvars.php');

		if (isset($_GET['id']) && isset($_GET['date'])  && isset($_GET['name'])  && isset($_GET['score'])
			 && isset($_GET['screenshot']) ) {

			$id = $_GET['id'];
			$date = $_GET['date'];
			$name = $_GET['name'];
			$score = $_GET['score'];
			$screenshot = $_GET['screenshot'];
		}
		else if (isset($_POST['id']) && isset($_POST['name'])  && isset($_POST['score']) ) {
			$id = $_POST['id'];
			$name = $_POST['name'];
			$score = $_POST['score'];
		}
		else {
			echo '<p class="error">Sorry, no high score was specified for removal.</p>';
		}

		if (isset($_POST['submit'])){
			if ($_POST['confirm'] == 'Yes'){
				@unlink(GW_UPLOADPATH . $screenshot);
				$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

				$query = "DELETE FROM guitarwars WHERE id = $id ";
				mysqli_query($dbc, $query);

				mysqli_close($dbc);

				echo "<p>The high score of $score for $name was successfully removed.";
			}
			else echo '<p class = "error">The high score was not removed.</p>';
		}
		else if (isset($id) && isset($date)  && isset($name)  && isset($score)
			 && isset($screenshot)) {
			echo '<p>Are you sure you want to delete the following high score?</p>

			<p><strong>Name: '. $name . '</strong></p>
			<p><strong>Date: '. $date . '</strong></p>
			<p><strong>Score: '. $score . '</strong></p>
			<form method="post" action="removescore.php">
				<input type="radio" name="confirm" value="Yes"> Yes
				<input type="radio" name="confirm" value="No" checked="checked"> No <br>
				<input type="submit" name="submit" value="Submit">
				<input type="hidden" name="id" value="'. $id . '">
				<input type="hidden" name="name" value="'. $name . '">
				<input type="hidden" name="score" value="'. $score . '">
			</form>';
		}

		echo '<p><a href="admin.php">&lt;&lt; Back to admin page</a></p>';
	?>

</body>
</html>
