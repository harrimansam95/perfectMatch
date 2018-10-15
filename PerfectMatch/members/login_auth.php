<?php include "../model/database.php" ?>
<?php session_start(); ?>
<?php

$db = Database::getDB();
//checks if the login is not empty
if (isset($_POST['Login'])) {
    //gets the entered username and password
    $username = $_POST['login_username'];
    $password = $_POST['login_password'];
    $password = sha1($username . $password);
    //cleans the username and password
    //querys the user where the username is = to the clean version of the usertable.
    $query = "SELECT * FROM useraccount WHERE username = '{$username}'";
    $select_user_query = mysqli_query($db, $query);

    if (!$select_user_query) {
        die("Query Failed" . mysqli_error($db));
    }
    while ($row = mysqli_fetch_array($select_user_query)) {

        $user_username = $row['username'];
        $user_password = $row['password'];
        $user_email = $row['email'];
        $user_account_type = $row['account_type'];
        $banner_msg = $row['banner_msg'];
        $displayName = $row['displayName'];
        $profilePhoto = $row['profile_photo'];
    }
    $query2 = "SELECT * FROM interests WHERE user_id = '{$username}'";
    $select_interests_query = mysqli_query($db, $query2);

    while ($row = mysqli_fetch_array($select_interests_query)) {



        $user_interest1 = $row['interest1'];
        $user_interest2 = $row['interest2'];
        $user_interest3 = $row['interest3'];
        $user_interest4 = $row['interest4'];
        $user_editbio = $row['user_bio'];
    }
    $query3 = "SELECT * FROM preferences WHERE userID = '{$username}'";
    $select_preferences_query = mysqli_query($db, $query3);

    while ($row = mysqli_fetch_array($select_preferences_query)) {



        $user_gender_pref = $row['gender_pref'];
        $user_quality = $row['quality'];
        $user_live_without = $row['live_without'];
        $user_smokes = $row['smokes'];
        $user_drinks = $row['drinks'];
        $user_has_children = $row['has_children'];
        $user_has_pets = $row['has_pets'];
    }
    if ($username !== $user_username || $password !== $user_password) {
       
        header("Location: ../errors/login_error.php");
    }
    if ($username == $user_username && $password == $user_password) {
        $_SESSION['logged_in'] = TRUE;
        $_SESSION['username'] = $user_username;
        $_SESSION['displayName'] = $displayName;
        $_SESSION['interest1'] = $user_interest1;
        $_SESSION['interest2'] = $user_interest2;
        $_SESSION['interest3'] = $user_interest3;
        $_SESSION['interest4'] = $user_interest4;
        $_SESSION['userbio'] = $user_editbio;
        $_SESSION['gender_pref'] = $user_gender_pref;
        $_SESSION['quality'] = $user_quality;
        $_SESSION['live_without'] = $user_live_without;
        $_SESSION['smokes'] = $user_smokes;
        $_SESSION['drinks'] = $user_drinks;
        $_SESSION['has_children'] = $user_has_children;
        $_SESSION['has_pets'] = $user_has_pets;
        $_SESSION['bannermsg'] = $banner_msg;
        $_SESSION['profilePhoto'] = $profilePhoto;
        if ($user_account_type == 'Member') {
            header("Location: ../view/memberDash.php");
        }
        if ($user_account_type == 'Admin') {
            header("Location: ../admin/admin_page.php");
        }
    }
}