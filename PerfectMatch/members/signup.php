<?php include "header.php" ?>

<div id="interest_wrapper">
    <br/>
    <p style="text-align: center;">Please make sure all information is filled out correctly.</p>
    <form action="./index.php" method="post" id="sign_up_form">
        <input type="hidden" name="action" value="add_user"/>
        <fieldset class="segmentation">
            <legend>Account information</legend>
            <label>Username: </label><input class="interests" type="text" name="username"/>
            <label>Display Name: </label><input class="interests" type="text" name="displayName"/>
            <label>Password: </label><input class="interests" type="password" name="password"/>
            <label>Email: </label><input class="interests" type="email" name="email"/>
            <label>Re-type Email: </label><input class="interests" type="email" name="email2"/>
            <br>                  
        </fieldset>
        <input id = "button2" type="submit" value="Submit" />
    </form>
</div>
<?php include '../view/footer.php' ?>
