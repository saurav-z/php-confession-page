<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container-admin">
        <?php
        // Check if user is logged in and is an Admin
        session_start();
        if (isset($_SESSION['login_user']) && $_SESSION['user_role'] == 'Admin') {
            // Connect to database
            include('db_connect.php');

            // Check if a confession ID was submitted for deletion
            if (isset($_POST['delete_confession'])) {
                $confession_id = $_POST['delete_confession'];

                // Delete the confession from the database
                $delete_query = "DELETE FROM confess_confessions WHERE id='$confession_id'";
                $delete_result = mysqli_query($conn, $delete_query);

                if ($delete_result) {
                    echo '<p class="success">Confession deleted successfully!</p>';
                } else {
                    echo '<p class="error">Error deleting confession.</p>';
                }
            }

            // Fetch confessions from database
            $query = "SELECT * FROM confess_confessions";
            $result = mysqli_query($conn, $query);

            // Display table of confessions
            if (mysqli_num_rows($result) > 0) {
                echo '<table class="confessions-table">';
                echo '<tr><th>ID</th><th>Username</th><th>Confession</th><th>Media</th><th>Action</th></tr>';

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['confessions'] . '</td>';
                    echo '<td><img src="' . "../contents/images/" . $row['media_name'] . '"></td>';
                    echo '<td>';
                    echo '<form method="POST">';
                    echo '<input type="hidden" name="delete_confession" value="' . $row['id'] . '">';
                    echo '<input type="submit" value="Delete">';
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                echo '<p class="error">No confessions found!</p>';
            }
        } else {
            echo '<p class="error">Access denied! Login with admin credentials</p>';
            echo "'<a href='../contents/login.php'>Login</a>'";
        }
        ?>
    </div>
</body>

</html>