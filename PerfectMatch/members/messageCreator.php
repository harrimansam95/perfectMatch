<?php include"header.php"; ?>
<?php include"navbar.php";?>

<div style="margin-top: 1%;padding: 1%;">
    <div style="margin-left: 25%;">
        <form action="index.php" method="post">
            <input type="hidden" name="action" value="send_message"/>
            <label>Title:&nbsp;&nbsp;</label><input type="text" name="messageTitle" />
            <br><br>
            <label>To:&nbsp;&nbsp;</label><input type="text" name="user_to" />
            <br><br>
            <textarea name="messageContent" rows="20" cols="92"></textarea>
            <br><br>
            <input type="submit" value="Send message"/>

        </form>
    </div>
</div>
<?php include "../view/footer.php" ?>