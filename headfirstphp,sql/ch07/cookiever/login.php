<?php
	require_once ('connectvars.php');
	
	$error_msg ="";
	
	if (!isset($_COOKIE['user_id'])) {
		if (isset($_POST['submit'])) {
			
			$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
			
			$user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
			$user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));
			
			if(!empty($user_username) && !empty($user_password)) {
				$query = "SELECT user_id, username FROM mismatch_user WHERE username = '$user_username'
					AND password = SHA('$user_password')";
				$data = mysqli_query($dbc, $query);
				
				if (mysqli_num_rows($data) == 1) {
					$row = mysqli_fetch_array($data);
					setcookie('user_id', $row['user_id']);
					setcookie('username', $row['username']);
					$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
					header('Location: ' . $home_url);
				}
				else {
					$error_msg = 'Sorry, you must enter a valid username and password to login.';
				}
			}
			else {
				$error_msg = 'you must enter your username and password to log in.';
			}
			
		}
	}
?>

<html>
<head>
	<title>Mismatch - Log in</title>
	<link rel="stylesheet" href="style.css">	
</head>
<body>
	<h3>Mismatch - Log in</h3>
<?php
	if (empty($_COOKIE['user_id'])) {
		echo '<p class="error">' . $error_msg .'</p>';
?>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<fieldset>
				<legend>Log in</legend>
				<label for="username">Username:</label>
				<input type="text" id="username" name="username" 
					value="<?php if(!empty($user_username)) echo $user_username; ?>"><br>
				<label for="password">Password:</label>
				<input type="password" id="password" name="password"><br>
			</fieldset>
			<input type="submit" name="submit" value="Log In">
		</form>
<?php 
	}
	else{
		echo '<p class="login">You are logged in as ' . $_COOKIE['username'] .'.</p>';
	}
?>
</body>
</html>

