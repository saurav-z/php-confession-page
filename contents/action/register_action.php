<?php
include('../../admin/db_connect.php');
session_start();
// Get input
$username = $_POST['username'];
$password = md5($_POST['password']);

// Check connection
if (!$db) {
    echo("Connection failed: " . mysqli_connect_error());
} else {
    $check = "SELECT * FROM confess_users WHERE username='$username'";
    $users = mysqli_query($db, $check);

    if (mysqli_num_rows($users) == 1) {
        $_SESSION['registration_error'] = "Username already taken. Please choose another username.";
    } else {
        $query = "INSERT INTO confess_users(username,password) VALUES('$username','$password')";
        if ($db->query($query) == true) {
            $_SESSION['registration_error'] = "User registered successfully. Wait for admin to activate your account.";
        } else {
            $_SESSION['registration_error'] = "Registration failed. Please try again.";
        }
    }

    header("Location:../register.php");
    exit();
}

mysqli_close($db);
?>
