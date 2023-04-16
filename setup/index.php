<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Setup - Confession Page</title>
	<link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
	<div class="container">
		<div class="box">
			<h2>Confession Setup</h2>
<br>
			<form method="post" action="action.php">
				<label for="host">Database Host:</label>
				<input type="text" id="host" name="host" required><br><br>
				<label for="username">Database Username:</label>
				<input type="text" id="username" name="username" required><br><br>
				<label for="password">Database Password:</label>
				<input type="password" id="password" name="password"><br><br>
				<label for="dbname">Database Name:</label>
				<input type="text" id="dbname" name="dbname" required><br><br>

				<input type="submit" value="Run Setup">
			</form>
		</div>
	</div>

</body>

</html>