<?php include "header.php" ?>
<?php include "admin_nav.php" ?>

<?php
include_once("../model/database.php");
$conn = Database::getDB();
$query = mysqli_query($conn, "SELECT * FROM user_questions WHERE question_answered = 'FALSE'");

?>

<div style="margin: 1%; border: 1px solid black; padding: 1%; width: 20%;">
    <h3>Queued Questions</h3>
    <?php
    if (!(isset($query))) {
        echo '<p>No current user queries</p>';
    } else {
        while ($rows = mysqli_fetch_assoc($query)) {
            ?>
            <div style="width: 90%; background-color: darkgray; border: 1px solid black; padding: 1%; ">
                <p>Username: <?php echo $rows['user_username']; ?></p>
                <p>Email: <?php echo $rows['user_email']; ?></p>
                <p>Question: <?php echo $rows['user_question']; ?></p>
                <form action="../members/index.php" method="post">
                    <input type="hidden" name="action" value="Post"/>
                    <input type="hidden" name="user_question_id" value="<?php echo $rows['questionID']; ?>"/>
                    <input type="submit" name="review" value="Review Question"/>
                </form>
            </div>
            <br/>
            <?php
        }
    }
    ?>
</div>
<?php include "../view/footer.php" ?>