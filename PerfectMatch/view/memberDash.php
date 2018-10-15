
<?php include"header4.php"; ?>
<?php include"navbar2.php";?>




<h3 style="text-align: center;">Create a post!</h3>
<div style="margin: 0 auto; border: 1px solid black; padding: 1%; width: 50%;">

    <form action="../members/index.php" method="post">
        <input type="hidden" name="action" value="add_post"/>
        <label>Title:&nbsp;&nbsp;</label><input type="text" name="postTitle"/>
        <br><br>
        <textarea name="postContent" rows="10" cols="93"></textarea>
        <br><br>
        <input type="submit" value="Submit Post"/>
        
    </form>

</div>
<?php include "footer.php" ?>
