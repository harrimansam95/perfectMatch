<?php include "header.php" ?>
<div id="interest_wrapper">
    <form action="index.php" method="post"
          id="sign_up_form">
        <input type="hidden" name="action" value="add_user_interest"/>
        <fieldset class="segmentation"><legend>Your Preferences</legend>
            <label>You prefer: </label><select class="interests" name="preference" placeholder="Select One...">
                <option>Select</option>
                <option>Men</option>
                <option>Women</option>
                <option>Both</option>
            </select><br>
            <label>Your most notable quality is: </label><input class="interests" type="text" name="quality" value="" /><br>
            <label>You could not live without: </label><input class="interests" type="text" name="live_without" value="" /><br>
        </fieldset>
        <fieldset class="segmentation"><legend>Do you</legend>
            <label>Smoke: </label><select class="interests" name="smoke" placeholder="Select One...">
                <option>Select</option>
                <option>Rather not say</option>
                <option>Yes</option>
                <option>On occasion</option>
                <option>No</option>
                <option>Never</option>
                <option>Trying to quit</option>
            </select><br>
            <label>Drink: </label><select class="interests" name="drink" placeholder="Select One...">
                <option>Select</option>
                <option>Rather not say</option>
                <option>Yes</option>
                <option>On occasion</option>
                <option>No</option>
                <option>Never</option>
            </select><br>
            <label>Have Children: </label><select class="interests" name="has_children" placeholder="Select One...">
                <option>Select</option>
                <option>Rather not say</option>
                <option>Yes</option>
                <option>No</option>
                <option>No, but I want children</option>
                <option>No and I don't want children</option>
            </select><br>
            <label>Have Pets: </label><select class="interests" name="has_pets" placeholder="Select One...">
                <option>Select</option>
                <option>Rather not say</option>
                <option>Yes</option>
                <option>No</option>
                <option>No, but I want pets</option>
                <option>No and I don't want pets</option>
            </select><br>
        </fieldset>
        <input id = "button2" type="submit" value="Next" />
    </form>
</div>
<?php include '../view/footer.php' ?>
