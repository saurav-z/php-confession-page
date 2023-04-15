<?php
include('../../admin/db_connect.php');

$confession = $_POST['confession'];
$name = $_POST['name'];

if (!$db) {
    echo ("Connection failed: " . mysqli_connect_error());
} else {
    if ($_FILES['image']['name']) {
        $img_name = 'IMG_' . uniqid() . '.jpg';
        $target_dir = "../images/";
        $target_file = $target_dir . $img_name;
        $tempName = $_FILES['image']['tmp_name'];
        move_uploaded_file($tempName, $target_file);
    } else {
        $img_name = '';
    }
    $query = "INSERT INTO confess_confessions (name, confessions, media_name) VALUES ('$name', '$confession', '$img_name')";
    if (mysqli_query($db, $query)) {
        echo "Confession Posted Successfully<br>";
    } else {
        echo "Error Posting Confession. Please try again<br>";
    }
}
mysqli_close($db);
header("Location: ../index.php");
exit();
?>