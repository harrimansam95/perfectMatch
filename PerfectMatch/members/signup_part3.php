<?php include "header.php" ?>
<div id="interest_wrapper">
    <form action="index.php" method="post"
          id="sign_up_form">
        <input type="hidden" name="action" value="add_user_interest2"/>
        <fieldset class="segmentation"><legend>Your Interests</legend>
            <label>Interest 1:</label><input type="text" class="interests" name="interest_1"/><br/>
            <label>Interest 2:</label><input type="text" class="interests" name="interest_2"/><br/>
            <label>Interest 3:</label><input type="text" class="interests" name="interest_3"/><br/>
            <label>Interest 4:</label><input type="text" class="interests" name="interest_4"/><br/><br/><br/><br/>
            <label>Write a quick bio:&nbsp;</label><textarea name="user_bio" rows="5" cols="27">
            </textarea>
        </fieldset>
        <input id = "button2" type="submit" value="Next" />
    </form>
</div>
<?php include '../view/footer.php' ?>
