<?php
include('../admin/db_connect.php');

									//run the query

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $username = $_POST['username'];
    $password =  md5($_POST['password']);

    // Prepare the SQL statement to insert the user
    $insert = $conn->prepare("INSERT INTO confess_users (username, password, user_role) VALUES (?, ?, 'Admin')");
    $insert->bind_param("ss", $username, $password);
    $insert->execute();
    $insert->close();
    $conn->close();

    // Display a success message
    echo "<p>User added to database.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup - Admin account</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
    <div class="container">
        <div class="box">
            <h2>Confession Setup</h2>

            <form method="post">
                <label for="username">Admin Username:</label>
                <input type="text" id="username" name="username" required><br><br>
                <label for="password">Admin Password:</label>
                <input type="password" id="password" name="password"><br><br>
                <input type="submit" value="Run Setup">
            </form>
        </div>
    </div>

</body>

</html>