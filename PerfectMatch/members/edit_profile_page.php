<?php include"header.php"; ?>
<?php include"navbar.php";?>
<?php
include_once "../model/database.php";
$conn = Database::getDB();

$stmt = mysqli_query($conn, "SELECT password FROM useraccount WHERE username = '{$_SESSION['username']}'");
$stmt = mysqli_fetch_assoc($stmt);

?>

<div id="contactWrapper">
    
    <form action="index.php" method="post" class="edit_profile_form" enctype="multipart/form-data">
        <input type="hidden" name="action" value="update_profile"/>
        <p id="contactMsg"><strong>Edit Account</strong></p> 
        <label>Password: </label><input type="password" name="editpassword" value="<?php echo $stmt['password']; ?>" class="contactInfo"/>
        <label>Display Name: </label><input type="text" name="editDisplayName" class="contactInfo"/>
        <p id="contactMsg"><strong>Edit profile</strong></p>
        <label>Banner Message: </label><input type="text" name="usrCreWelcMsg" value="" class="contactInfo"/><br/>
        <label>Profile Photo: </label><input type="file" name="userPhoto" class="contactInfo" /><br/><br/>
        <label>Interest 1: </label><input type="text" name="editUsrInt1"  class="contactInfo"/><br/>
        <label>Interest 2: </label><input type="text" name="editUsrInt2" class="contactInfo"/><br/>
        <label>Interest 3: </label><input type="text" name="editUsrInt3"  class="contactInfo"/><br/>
        <label>Interest 4: </label><input type="text" name="editUsrInt4" class="contactInfo"/><br/>
        <label>Bio: </label><textarea name="editbio" rows="5" cols="40"></textarea><br/><br/>
        
        <input type="submit" value="Submit" id="contactSubmitButton" class="contactInfo"/>
    </form>
    <form action="index.php" method="post" class="edit_profile_form">
        <input type="hidden" name='action' value="delete_profile"/>
        <input type='hidden' name='deleteMe' value='<?php echo $_SESSION['username']; ?>'/>
        <input type="submit" value="Delete Account" name="deleteUserProfile" id="contactSubmitButton" class="contactInfo"/> 
    </form>
</div>

</body>
</html>
