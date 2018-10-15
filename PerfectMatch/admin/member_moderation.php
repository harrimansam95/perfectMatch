<?php include "header.php" ?>
<?php include "admin_nav.php" ?>

<div align="center" style=" border: 1px solid black; background-color: darkgray; height: 340px;">
    <div style="padding: 1%; margin: 1%; " >
        <h3>User Account Actions</h3>
        <a href="admin_member_update.php"><input type="button" value="Update" /></a>
        <a href="admin_member_delete.php"><input type="button" value="Delete" /></a>
        <a href="admin_view_members.php"><input type="button" value="View" /></a>
        <a href="../view/memberDash.php"><input type="button" value="View As Member"/></a>
    </div>

</div>
<?php include "../view/footer.php" ?>
