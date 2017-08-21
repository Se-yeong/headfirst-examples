<!DOCTYPE html>
<html>
<head>
	<title>test</title>
</head>
<body>
	<?php
		$from = 'zkzkzlzlzl43@naver.com';
		$subject = $_POST['subject'];
		$text = $_POST['elvismail'];

		$dbc = mysqli_connect('localhost', 'root', 'glwlsl10', 'elvis_store')
			or die("Error connecting to MySQL server.");
		$query = "select * from email_list";
		$result = mysqli_query($dbc, $query) or die("Error querying database.");

		while( $row = mysqli_fetch_array($result); ){
			$first_name = $row['first_name'];
			$last_name = $row['last_name'];

			$msg = "Dear $first_name $last_name, \n $text";
			$to = $row['email'];
			//mail($to, $subject, $msg, $msg, 'From:' . $from);

			echo "To: $to <br>Subject: $subject <br> $msg. <br>From: $from");

		}


		mysqli_close();
	?>
</body>
</html>
