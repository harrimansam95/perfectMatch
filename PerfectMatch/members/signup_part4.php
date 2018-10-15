<?php include "header.php" ?>
<div id="interest_wrapper">
    <br/>
    <p style="text-align: center;">Upload a picture so people can see you!</p>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="profileImage"/>
        <fieldset class="segmentation">
                <label>Profile image:</label>
                <input type="file" name="userPhoto">
        </fieldset>              
        <input id="button2" type="submit" value="Next" />
    </form>
</div>
<?php include '../view/footer.php' ?>


