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
        <th>Delete</th>
    </t>
    <?php
    while ($rows = mysqli_fetch_assoc($query)) {
        ?>

        <tr>
            <td><strong><?php echo $rows['username']; ?></strong></td>
            <td><?php echo $rows['password']; ?></td>
            <td><?php echo $rows['email']; ?></td>
            <td>
                <form action='../members/index.php' method='post'>
                    <input type='hidden' name='action' value='admin_delete'/>
                    <input type='hidden' name='deleteMe' value='<?php echo $rows['username']; ?>'/>
                    <input type="submit" value="Delete" name="deleteUser"/>
                </form>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
<?php include "../view/footer.php" ?>