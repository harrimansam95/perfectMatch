<?php include"header4.php"; ?>
<?php include"navbar2.php";?>


<div id="contactWrapper">
    <p id="contactMsg">For queries please submit the information below and your query will be sent to the moderation team. (Once your query has been viewed await contact from a moderator.)</p>
    <form action="../members/index.php" method="post">
        <input type="hidden" name="action" value="user_queries"/>
        <label>Username: </label><input type="text" name="username" value="" class="contactInfo"/><br/>
        <label>Email: </label><input type="email" name="email" value="" class="contactInfo"/><br/>
        <label>Question: </label><textarea name="question" rows="5" cols="46">
        </textarea><br/>
        <input type="submit" value="Submit" id="contactSubmitButton"/>
    </form>
</div>
<?php include "footer.php" ?>