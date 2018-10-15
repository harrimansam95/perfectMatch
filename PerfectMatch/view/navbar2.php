<?php include '../model/database.php'; ?>
<?php
session_start();
$conn = Database::getDB();
$query = mysqli_query($conn,"SELECT COUNT(user_to) FROM user_pms WHERE pm_read = 'FALSE' AND user_to = '{$_SESSION['username']}'");
$rows = mysqli_fetch_array($query);
?>

<ul>
    <li><a href="memberDash.php">Home</a></li>
    <li><a href="../members/index.php?action=logout">Logout</a></li>
    <li><a href="contact.php">Contact</a></li>
    <li><a href="../members/match/index.php">Match</a></li>
    <li><a href="profile.php">Profile</a></li>
    <li><a href="../members/privateMessages.php">Messages(<?php echo $rows[0]; ?>)</a></li>
    <form action="../members/index.php" method="post">
        <input type="hidden" name="action" value="userSearch"/>
        <input onkeydown = " if (event.keyCode == 13) { this.form.submit(); return false; }" type="text" id="searchbar" name="search" placeholder="Search..."  />
    </form>
</ul>   