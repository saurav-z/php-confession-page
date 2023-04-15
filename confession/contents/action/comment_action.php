<?php
// Connect to the database
include('../../admin/db_connect.php');

// Check if the comment form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

   
    // Get the input from the comment form
    $confession_id = $_POST['confession_id'];
    $username = $_POST['comment_name'];
    $comment = $_POST['comment'];

    // Insert the comment into the database
    $query = "INSERT INTO confess_comments (confession_id, username, comment) VALUES ('$confession_id', '$username', '$comment')";
    $result = mysqli_query($db, $query);


    // Redirect back to the confession page
    header("Location: ../index.php?id=$confession_id");
    exit();
}
?>