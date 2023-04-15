<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>DeerConfess - Register</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">

</head>

<body>
	<div class="container">
		<h2>Register</h2>
		<form method="POST" action="action/register_action.php">
			<?php session_start();
			if (isset($_SESSION['registration_error'])) { ?>
				<p class="error">
					<?php echo $_SESSION['registration_error']; ?>
				</p>
			<?php } ?>
			<label for="username">Username:</label>
			<input type="text" id="username" name="username" required>
			<label for="password">Password:</label>
			<input type="password" id="password" name="password" required>
			<input type="submit" value="Register">
			<a class="btn-secondary" style="float:right;margin-right:10px;" href="login.php">Already a member?</a>

		</form>
	</div>
</body>

</html>