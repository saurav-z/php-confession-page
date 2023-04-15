<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
    <?php
    // Check if user is logged in and is an Admin
    session_start();
    if (isset($_SESSION['login_user']) && $_SESSION['user_role'] == 'Admin') {
        // Connect to database
        include('db_connect.php');

        // Fetch users from database
        $query = "SELECT * FROM confess_users";
        $result = mysqli_query($conn, $query);

        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get values from form
            $username = $_POST['username'];
            $role = $_POST['role'];



            // Update user role in database
            $query = "UPDATE confess_users SET user_role='$role' WHERE username='$username'";
            $result = mysqli_query($conn, $query);
            if ($result) {
                echo '<p class="success">User role updated successfully!</p>';
            } else {
                echo '<p class="error">Error updating user role.</p>';
            }
        }




        $query = "SELECT * FROM confess_users";
        $result = mysqli_query($conn, $query);
        // Display form to select user and role
        if (mysqli_num_rows($result) > 0) {
            echo '<table class="users-table">';
            echo '<tr><th>Username</th><th>Role</th><th>Action</th></tr>';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['username'] . '</td>';
                echo '<td>';
                echo '<form method="POST">';
                echo '<input type="hidden" name="username" value="' . $row['username'] . '">';
                echo '<select name="role">';
                echo '<option value="None" ' . ($row['user_role'] == 'None' ? 'selected' : '') . '>None</option>';
                echo '<option value="Admin" ' . ($row['user_role'] == 'Admin' ? 'selected' : '') . '>Admin</option>';
                echo '<option value="User" ' . ($row['user_role'] == 'User' ? 'selected' : '') . '>User</option>';
                echo '</select>';
                echo '<td><input type="submit" value="Update"></td>';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</table>';

        } else {
            echo '<p class="error">No users found!</p>';
        }
    } else {
        echo '<p class="error">Access denied! Login with admin credientials</p>';
        echo "'<a href='../contents/login.php'>Login</a>'";
    }
    ?>
    </div>
</body>

</html>