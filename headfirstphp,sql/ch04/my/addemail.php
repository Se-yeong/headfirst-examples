<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Make Me Elvis - Add Email</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
 	<img src="blankface.jpg" width="161" height="350" alt="" style="float:right">

	<img name="elvislogo" src="elvislogo.gif" width="229" height="32" border="0" alt="Make Me Elvis">

	<?php
		$first_name = $_POST['firstname'];
		$last_name = $_POST['lastname'];
		$email = $_POST['email'];

		$dbc = mysqli_connect('localhost', 'root', 'glwlsl10', 'elvis_store')
			or die('Error connecting to MySQL server');

		$query = "insert into email_list (first_name, last_name, email) " .
			"values ('$first_name', '$last_name', '$email'); ";

		mysqli_query($dbc, $query) or die('Error querying database') ;

		echo '<p>'.'Customer added.'.'</p>';

		mysqli_close();

	?>

</body>
</html>
