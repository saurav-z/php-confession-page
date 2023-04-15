<!-- PHP code for logout -->
<?php
session_start();
if (isset($_POST['logout'])) {
  unset($_SESSION['login_user']);
  unset($_SESSION['login_error']);
  unset($_SESSION['user_role']);
  session_destroy(); // destroy session

  header("location: ../login.php"); // redirect to login page
}
?>