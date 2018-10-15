<?php include"header.php"; ?>
<?php include"navbar.php";?>


<?php

if(empty($_SESSION['user_message_id'])){
    $_SESSION['user_message_id'] = "";
    
}
?>

<?php
$conn = Database::getDB();
$query = ("SELECT * FROM user_pms WHERE user_to = '{$_SESSION['username']}'");
$stmt = mysqli_query($conn, $query);
$stmt3 = mysqli_fetch_assoc($stmt);
$stmt2 = mysqli_query($conn, "SELECT * FROM pm_log WHERE main_pm = '{$_SESSION['user_message_id']}'");
$stmt4 = mysqli_query($conn, "SELECT * FROM user_pms WHERE user_from = '{$_SESSION['username']}'");
?>

<a href="messageCreator.php"><p style="margin-top: 1%; margin-left: 5%;">Compose a message</p></a>
<div style=" margin-left: 1%; margin-top: 1%; margin-bottom: 10%; border: 1px solid black; padding: 1%; width: 20%; float: left;">
    <h3> RECEIVED MESSAGES </h3>
    <?php
    foreach ($stmt as $value) {
        ?>
        <div style="border-top: 1px solid black; ">
            <p style="margin-top: 5%;">Title: <strong><?php echo $value['pm_title']; ?></strong></p>
            <p>From: <strong><?php echo $value['user_from']; ?></strong></p>
           
            <form action="index.php" method="post">
                <input type="hidden" name="action" value="user_messages_show"/>
                <input type="hidden" name="pmID" value="<?php echo $value['pm_id']; ?>"/>
                <input type="submit" value="VIEW MESSAGE" class="search_results_link_to_profile" />
            </form>
            <form action="index.php" method="post">
                <input type="hidden" name="action" value="delete_message"/>
                <input type="hidden" name="message_id" value="<?php echo $value['pm_id']; ?>"/>
                <input type="submit" value="DELETE MESSAGE" class="search_results_link_to_profile" />
            </form>
            <br/>
        </div>
    <?php } ?>
     <h3> SENT MESSAGES </h3>
    <?php
    foreach ($stmt4 as $value) {
        ?>
       
        <div style="border-top: 1px solid black; ">

            <p style="margin-top: 5%;">Title: <strong><?php echo $value['pm_title']; ?></strong></p>
            <p>To: <strong><?php echo $value['user_to']; ?></strong></p>

            <form action="../index.php" method="post">
                <input type="hidden" name="action" value="user_messages_show"/>
                <input type="hidden" name="pmID" value="<?php echo $value['pm_id']; ?>"/>
                <input type="submit" value="VIEW MESSAGE" class="search_results_link_to_profile" />
            </form>
            <form action="../index.php" method="post">
                <input type="hidden" name="action" value="delete_message"/>
                <input type="hidden" name="message_id" value="<?php echo $value['pm_id']; ?>"/>
                <input type="submit" value="DELETE MESSAGE" class="search_results_link_to_profile" />
            </form>
            <br/>
        </div>
    <?php } ?>
</div>

<div style="width: 60%; float: right; margin-right: 10%; padding: 1%;">
    <h3 style="text-align: center;"><?php
        if (empty($_SESSION['msg_title'])) {
            echo "No new messages";
        } else {
            echo $_SESSION['msg_title'];
        }
        ?></h3>
    <div style=" border: 1px solid black; padding: 1%; background-color: lightsteelblue;">
        <p><strong><?php
                if (empty($_SESSION['user_from'])) {
                    echo " ";
                } else {
                    echo $_SESSION['user_from'];
                }
                ?></strong></p>
        <p>> <?php
            if (empty($_SESSION['pm_content'])) {
                echo "";
            } else {
                echo $_SESSION['pm_content'];
            }
            ?></p>


    </div>

    <div>

        <?php
        foreach ($stmt2 as $value) {
            ?>

            <div style="background-color: lightsteelblue; margin: 0  auto; margin-top: 1%; border: 1px solid black; padding: 1%;">
                <p><strong><?php echo $value['user_from']; ?></strong></p>
                <p>><?php echo $value['reply'] ?></p>
            </div>

        <?php }
        ?>
    </div>
    <div style="margin-left: 8%; margin-top: 1%; ">
        <form action="index.php" method="post">
            <input type="hidden" name="action" value="replyToPm"/> 
            <input type="text" name="replyContent" style="width: 80%;"/>
            <input type="submit" value="Reply"/>
        </form>
    </div>
</div>
<?php
include '../view/footer.php';
?>