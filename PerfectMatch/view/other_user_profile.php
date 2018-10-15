<?php include"header4.php"; ?>
<?php include"navbar2.php";?>
<?php include"../model/member_db.php";?>


<?php
include_once("../model/database.php");
$conn = Database::getDB();
$query = mysqli_query($conn, "SELECT * FROM user_posts WHERE post_user_id = '{$_SESSION['show_userName']}'");
?>
<div id="profile_wrapper">
    <div id="profile_main">
        <h1 id="welcomemsgprofile">Welcome to my profile!</h1>
        <div id="postsDiv">
            
            <h3><?php echo $_SESSION['show_userName'];  ?>s Recent Activity</h3>
            <?php
            while ($rows = mysqli_fetch_assoc($query)) {
                ?>
            <br/>
                <p>Title: <strong><?php echo $rows['post_title']; ?></strong></p>
                <form action="../members/index.php" method="post">
                    <input type="hidden" name="action" value="user_thread_show"/>
                    <input type="hidden" name="postID" value="<?php echo $rows['user_post_id']; ?>"/>
                    <input type="submit" value="VIEW POST" class="search_results_link_to_profile" />
                </form>
                <em>Posted <?php echo MemberDB::time_stamp($rows['time_posted'])?>...</em>
                <br/>
                <?php
            }
            ?>
        </div>
        <div>
            <?php if(empty($_SESSION['profilePhoto']) === false){
                echo '<img src="',$_SESSION['profilePhoto'],'" alt="',$_SESSION['show_userName'],'\'s Profile Image" style="width: 15%; height: 10%;">';
                
            }
            ?>
        </div>
        <div id='userabout'>
            <h3>Interests</h3>
            <div id="interests_list">
                <ol>
                    <li><?php echo $_SESSION['show_userInterest1']; ?></li>
                    <br>
                    <li><?php echo $_SESSION['show_userInterest2']; ?></li>
                    <br>
                    <li><?php echo $_SESSION['show_userInterest3']; ?></li><br>
                    <li><?php echo $_SESSION['show_userInterest4']; ?></li><br>

                </ol>
            </div>
            <h3>Bio:</h3>
            <div id = "user_bio_text">

                <p><?php echo $_SESSION['userbio']; ?></p>
            </div>
            <br>
            <h3>Preferences</h3><br>
            <div id = "user_preferences">

                <p>Gender preference: <strong><?php echo $_SESSION['show_gender_pref']; ?></strong></p><br>
                <p>Most notable quality: <strong><?php echo  $_SESSION['show_quality']; ?></strong></p><br>
                <p>Could not live without: <strong><?php echo $_SESSION['show_live_without']; ?></strong></p><br>
                <p>Smokes: <strong><?php echo $_SESSION['show_smokes']; ?></strong></p><br>
                <p>Drinks: <strong><?php echo $_SESSION['show_drinks']; ?></strong></p><br>
                <p>Has Children: <strong><?php echo $_SESSION['show_has_children']; ?></strong></p><br>
                <p>Has Pets: <strong><?php echo $_SESSION['show_has_pets']; ?></strong></p>


            </div>
        </div>
    </div>
</div>
<?php include "footer.php" ?>
