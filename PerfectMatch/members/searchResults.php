<?php include"header.php"; ?>
<?php include"navbar.php";?>

<?php
include_once("../model/database.php");
$conn = Database::getDB();
$query = mysqli_query($conn, "SELECT * FROM interests WHERE user_id = '{$_SESSION['userSearch']}'");

?>
<?php while ($rows = mysqli_fetch_assoc($query)) { ?>
    <h3>Result(s) for your search on: '<?php echo $_SESSION['userSearch']; ?>'</h3>
    <div style='width:15%;  padding: 1%; line-height: 40px; margin-top: 2%;'>
        <h3>Users:</h3>
        <div style='padding: 1%; border: 1px solid black;'>
            <p>Username: <?php echo $_SESSION['userSearch']?></p>
            <p><strong>Interest 1:</strong> <?php echo $rows['interest1']; ?></p>
            <p><strong>Interest 2:</strong> <?php echo $rows['interest2']; ?></p>
            <p><strong>Interest 3:</strong> <?php echo $rows['interest3']; ?></p>
            <p><strong>Interest 4:</strong> <?php echo $rows['interest4']; ?></p>
            <form action="index.php" method="post">
                <input type="hidden" name="action" value="user_profile_show"/>
                <input type="submit" value="Link to <?php echo $rows['user_id'];?>s profile" class="search_results_link_to_profile" />
            </form>
        </div>
    </div>
<?php } ?>
