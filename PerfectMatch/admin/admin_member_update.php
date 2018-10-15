<?php include "header.php" ?>
<?php include "admin_nav.php" ?>
<?php
include_once("../model/database.php");
$conn = Database::getDB();
$query = mysqli_query($conn, "SELECT * FROM useraccount");
?>
<table align='center' border='1px' style='width:80%; line-height: 40px; margin-top: 2%;'>
    <tr>
        <th colspan="4">User Information</th>
    </tr>
    <t>
        <th>Username</th>
        <th>Password</th>
        <th>Email</th>
        <th>Account Type</th>
    </t>
    <?php
    while ($rows = mysqli_fetch_assoc($query)) {
        ?>

        <tr>
            <td align='center'><strong><?php echo $rows['username']; ?></strong></td>
            <td align='center'><?php echo $rows['password']; ?></td>
            <td align='center'><?php echo $rows['email']; ?></td>
            <td align='center'>
                <form action="../members/index.php" method="post">
                    <input type="hidden" name="action" value="update_user_type"/>
                    <input type="hidden" name="username_get" value="<?php echo $rows['username']?>"/>
                    <select name="change_user_type" onchange="this.form.submit()">
                        
                        <?php if($rows['account_type'] == 'Member'){?>
                        <option>Member</option>
                        <option>Admin</option>
                        <?php }?>
                        <?php if($rows['account_type'] == 'Admin'){?>
                        <option>Admin</option>
                        <option>Member</option>
                        
                        <?php }?>
                    </select>
                    <noscript><input type="submit"/></noscript>
                </form>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
<?php include "../view/footer.php" ?>
