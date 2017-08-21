<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Make Me Elvis - Send Email</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
 	<img src="blankface.jpg" width="161" height="350" alt="" style="float:right">

	<img name="elvislogo" src="elvislogo.gif" width="229" height="32" border="0" alt="Make Me Elvis"> <br>

	<?php
		$from = 'zkzkzlzlzl43@naver.com';
		$subject = $_POST['subject'];
		$text = $_POST['elvismail'];
		$output_form = false;

		if(!empty($subject) && !empty($text)) {

			$dbc = mysqli_connect('localhost', 'root', 'glwlsl10', 'elvis_store')
				or die("Error connecting to MySQL server.");
			$query = "select * from email_list";
			$result = mysqli_query($dbc, $query) or die("Error querying database.");

			while( $row = mysqli_fetch_array($result) ){
				$first_name = $row['first_name'];
				$last_name = $row['last_name'];

				$msg = "Dear $first_name $last_name, \n $text";
				$to = $row['email'];
				mail($to, $subject, $msg, 'From:' . $from);

				echo "To: $to <br>Subject: $subject <br> $msg. <br>From: $from <br><br>";

			}

		}
		else {
			if(isset($_POST['submit'])) {
				if(empty($subject) && empty($text) ) echo "You forgot the email subject and body text.<br><br>";
				else if(empty($subject)) echo "You forgot the email subject.<br><br>";
				else if(empty($text)) echo "You forgot the email body text.<br><br>";
			}
			$output_form = true;

			if($output_form) {

			?>
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<label for="subject">Subject of email:</label><br>
		    	<input type="text" id="subject" name="subject" size="30" value="<?php echo $subject; ?>"><br>
				<label for="elvismail">Body of email:</label><br>
		    	<textarea id="elvismail", name="elvismail" rows="8" cols="40" value="<?php echo $text; ?>"></textarea><br>
		    	<input type="submit" id="submit" name="submit" value="Submit">
			</form>

			<?php

			}
		}

		mysqli_close($dbc);
	?>

</body>
</html>
