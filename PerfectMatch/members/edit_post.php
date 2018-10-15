<?php include"header.php"; ?>
<?php include"navbar.php";?>

<h3 style="text-align: center;">Edit Post</h3>
<div style="margin: 0 auto; border: 1px solid black; padding: 1%; width: 50%;">

    <form action="index.php" method="post">
        <input type="hidden" name="action" value="edit_post"/>
        <input type="hidden" name="postID" value=""/>
        <label>Title:&nbsp;&nbsp;</label><input type="text" name="postTitle" value="<?php echo $_SESSION['post_title']; ?>"/>
        <br><br>
        <textarea name="postContent" rows="10" cols="93"><?php echo $_SESSION['post_content'] ?></textarea>
        <br><br>
        <input type="submit" value="Submit Post"/>

    </form>

</div>
<?php include "../view/footer.php" ?>
