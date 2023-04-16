<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confession - Home</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="containerc">
        <div class="confess">
            <h2>Confess Here</h2>
            <form method="post" action="action/confession_action.php" enctype="multipart/form-data">
                <label for="name">Name (Optional):</label>
                <input type="text" id="name" name="name">
                <label for="confession">Confession:</label>
                <textarea id="confession" name="confession" required style="resize:none;"></textarea>

                <label for="image">Image Confession (Optional):</label><br>
                <input type="file" id="image" name="image" value="Upload Image">
                <br><br><br><input type="submit" value="Submit Confession">

                <?php session_start();
                if (isset($_SESSION['confess_message'])) { ?>
                    <p>
                        <?php echo $_SESSION['confess_message']; ?>
                    </p>
                <?php } ?>

            </form>
        </div>
        <div class="live-confession">
            <h2>Live Confessions</h2>

            <!--Restrict this div to non-logged in users -->
            <div id="restricted-div" <?php
            if (isset($_SESSION['login_user'])) { ?>style="display:none" <?php } ?>>
                <!-- HTML code for login button -->
                <form method="post" action="login.php">
                    <input type="submit" name="login" value="Login">
                </form>
            </div>

            <div id="restricted-div" <?php if (!isset($_SESSION['login_user'])) { ?>style="display:none" <?php } ?>>

                <!-- HTML code for logout button -->
                <form method="post" action="action/logout_action.php">
                    <input type="submit" name="logout" value="Logout">
                </form>













                <div class="confessions-container">

                    <?php
                    include('../admin/db_connect.php');
                    // Retrieve and display the latest text confessions
                    $query = "SELECT * FROM confess_confessions ORDER BY id DESC LIMIT 10";
                    $result = mysqli_query($db, $query);

                    while ($row = mysqli_fetch_assoc($result)) {




                        echo "<div class='conf' style='border: 3px solid black; margin: 30px; padding:20px;'>";
                        echo "<p>" . $row['confessions'] . "</p>";
                        if (!empty($row['name'])) {
                            echo "<p>By: " . $row['name'] . "</p>";
                        }
                        if (empty($row['name'])) {
                            echo "<p>By: " . 'Anonymous' . "</p>";
                        }
                        if (!empty($row['media_name'])) {
                            echo '<img src="' . "images/" . $row['media_name'] . '" alt="Confession Media">';
                        }

                        // Display the comments for this confession
                        ?>
                        <button class="btn" onclick='toggleComments("<?php echo $row['id']; ?>")'>Comment</button>
                        <div id='comments_<?php echo $row['id']; ?>' style='display: none;'>
                            <!-- Comment section goes here -->
                            <?php
                            // Display the comments for this confession
                            $confession_id = $row['id'];
                            $query = "SELECT * FROM confess_comments WHERE confession_id = $confession_id ORDER BY id DESC";
                            $comment_result = mysqli_query($db, $query);

                            echo "<h3>Comments</h3>";
                            echo "<div class='comments-container'>";
                            while ($comment_row = mysqli_fetch_assoc($comment_result)) {
                                echo "<div class='comment'>";
                                echo "<p>" . $comment_row['comment'] . "</p>";
                                echo "<p>By: " . $comment_row['username'] . "</p>";
                                echo "</div>";
                            }
                            ?>
                            <button class="btn" onclick='toggleComments("<?php echo $row['id']; ?>")'>Hide comments</button>
                        </div>

                        <script>
                            function toggleComments(id) {
                                var commentsDiv = document.getElementById('comments_' + id);
                                if (commentsDiv.style.display === 'none') {
                                    commentsDiv.style.display = 'block';
                                } else {
                                    commentsDiv.style.display = 'none';
                                }
                            }
                        </script>
                        <?php

                        // Display the comment form for this confession
                        echo "<h4>Add Comment</h4>";
                        echo "<form method='post' action='action/comment_action.php'>";
                        echo "<input type='hidden' name='confession_id' value='$confession_id'>";
                        echo "<label for='username'>Name:</label>";
                        echo "<input type='text' id='comment_name' name='comment_name'>";
                        echo "<label for='comment'>Comment:</label>";
                        echo "<textarea id='comment' name='comment' required></textarea>";
                        echo "<input type='submit' name='submit_comment' value='Submit'>";
                        echo "</form>";

                        echo "</div>";
                        echo "</div>";
                    }
                    ?>


                </div>
            </div>
        </div>
</body>

</html>