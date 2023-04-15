<?php
//Session
session_start(); // start session

include('../../admin/db_connect.php');

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission
    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    if (empty($username) || empty($password)) {
        $_SESSION['login_error'] = "Please enter a username and password.";
    } else {
        $query = "SELECT * FROM confess_users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);

        if (mysqli_num_rows($result) == 1) {
            if ($row['user_role'] == 'Admin') {
                $_SESSION['login_user'] = $username; // set session variable
                $_SESSION['user_role'] = 'Admin';
            } elseif ($row['user_role'] == 'User') {
                $_SESSION['login_user'] = $username; // set session variable
                $_SESSION['user_role'] = 'User';
            } elseif ($row['user_role'] == 'None') {
                $_SESSION['login_error'] = "Your account is not activated yet, wait for admin to activate your account.";
                header("Location: ../login.php");

                exit();
            }

            header("Location: ../index.php");
            exit();
        } else {
            $_SESSION['login_error'] = "Invalid username or password.";
            header("Location: ../login.php");
            exit();
        }
    }
}

mysqli_close($db);
?>