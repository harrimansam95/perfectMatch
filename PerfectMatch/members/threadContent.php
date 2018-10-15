<?php include"header.php"; ?>
<?php include"navbar.php";?>

<?php
include_once("../model/database.php");
$conn = Database::getDB();
$query = mysqli_query($conn, "SELECT * FROM post_comments WHERE related_post = '{$_SESSION['user_post_id']}'");
$quer2 = mysqli_query($conn, "SELECT post_edited FROM user_posts WHERE user_post_id = '{$_SESSION['user_post_id']}'");
$edited = mysqli_fetch_assoc($quer2);
$edited = $edited['post_edited'];
?>
<div style="margin: 0  auto; margin-top: 1%;">
    <h1 style="text-align: center;"><?php echo $_SESSION['post_title']; ?></h1>
</div>
<div style="margin: 0  auto; margin-top: 1%; border: 1px solid black; padding: 1%; width: 50%;">

    <div style="background-color: darkslategray; padding: 1%; color: white;">
        <p>Original Poster: <strong><?php echo $_SESSION['user_post_username']; ?></strong></p>
    </div>

    <div style="background-color: darkgray; padding: 1%;">
        <p>><?php echo $_SESSION['post_content'] ?></p>
        <br>
        <br>
        <br>
        <br>
    </div>
    <br/>
    <?php if($edited == 'TRUE'){echo "<p style='float:right;'><em>Edited.</em></p>";}?>
    <?php if ($_SESSION['user_post_username'] == $_SESSION['username']) { ?>
    <form action="edit_post.php" method="post"><input type="submit" value="Edit Post"/></form>
    
    <?php } ?>
</div>
<h3 style="text-align: center;">Comments</h3>
<div style="margin: 0  auto; margin-top: 1%; border: 1px solid black; padding: 1%; width: 50%;">
    <form action="../members/index.php" method="post">
        <input type="hidden" name="action" value="user_comment_add"/>
        <input type="text" name="comment_content" placeholder="Enter in a comment..." style="width: 80%;"/>
        <input type="submit" value="Submit Comment" />
    </form>  
</div>
<div>
    <?php while ($rows = mysqli_fetch_assoc($query)) {
        ?>
        <div style="margin: 0  auto; margin-top: 1%; border: 1px solid black; padding: 1%; width: 50%;">
            <p><strong><?php echo $rows['user_username']; ?></strong></p>
            <p>><?php echo $rows['comment_content']; ?></p>
        </div>
    <?php }
    ?>
</div>
<a href="../view/memberDash.php"><p>MAKE A POST</p></a>
<?php include "../view/footer.php" ?>


