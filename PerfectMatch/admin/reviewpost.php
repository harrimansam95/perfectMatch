<?php include "header.php" ?>
<?php include "admin_nav.php" ?>

<div align="center">
    <p>Username: <?php echo $_SESSION['review_post_username']; ?></p>
    <p>Email: <?php echo $_SESSION['review_post_email']; ?></p>
    <p>Question: <?php echo $_SESSION['review_post_question']; ?></p>
    <br/>
    <form action="../members/index.php" method="post">
        <input type="hidden" name="action" value="answerTicket"/>
        <input type="hidden" name="user_to" value="<?php echo $_SESSION['review_post_username']; ?>"/>
        <input type="text" name="messageContent"/>
        <input type="submit" value="Review"/>
    </form>
</div>
