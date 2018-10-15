<?php

session_start();
require('../model/database.php');
require('../model/member_db.php');
require('../model/member.php');
require('../model/interests.php');
require('../model/interest2.php');





$action = filter_input(INPUT_POST, 'action');
$action2 = filter_input(INPUT_GET, 'action');



if ($action == 'delete_profile') {

    $member_id = filter_input(INPUT_POST, 'deleteMe');
    MemberDB::deleteMember($member_id);

    session_destroy();     // Clean up the session ID
    header("Location: ../view/login.php");
}
if ($action == 'admin_delete') {

    $member_id = filter_input(INPUT_POST, 'deleteMe');
    MemberDB::deleteMember($member_id);
    header("Location: ../admin/admin_member_delete.php");
}
if ($action == 'add_user') {
    $username = filter_input(INPUT_POST, 'username');
    $displayName = filter_input(INPUT_POST, 'displayName');
    $password = filter_input(INPUT_POST, 'password');
    $email = filter_input(INPUT_POST, 'email');
    $email2 = filter_input(INPUT_POST, 'email2');
    $password = sha1($username . $password);
    if ($email == $email2) {
        if ($username == NULL || $password == NULL || $email == NULL || $email2 == NULL || $displayName == NULL) {
            $error = "<p>Please go back and fill out all the information needed.</p>";
            header("Location: signup.php");
        } else {
            $member = new Member($username, $password, $email, $displayName);
            MemberDB::addMember($member);
            $_SESSION['username'] = $username;

            header("Location: signup_part4.php");
        }
    } else {
        header("Location: ../errors/email_add_error.php");
    }
}
if ($action == 'add_user_interest') {
    $preference = filter_input(INPUT_POST, 'preference');
    $quality = filter_input(INPUT_POST, 'quality');
    $live_without = filter_input(INPUT_POST, 'live_without');
    $smoke = filter_input(INPUT_POST, 'smoke');
    $drink = filter_input(INPUT_POST, 'drink');
    $has_children = filter_input(INPUT_POST, 'has_children');
    $has_pets = filter_input(INPUT_POST, 'has_pets');

    $interest = new Interests($preference, $quality, $live_without, $smoke, $drink, $has_children, $has_pets);
    MemberDB::addInterest($interest);
    header("Location: signup_part3.php");
}
if ($action == 'add_user_interest2') {
    $interest_1 = filter_input(INPUT_POST, 'interest_1');
    $interest_2 = filter_input(INPUT_POST, 'interest_2');
    $interest_3 = filter_input(INPUT_POST, 'interest_3');
    $interest_4 = filter_input(INPUT_POST, 'interest_4');
    $user_bio = filter_input(INPUT_POST, 'user_bio');

    $interest2 = new Interest2($interest_1, $interest_2, $interest_3, $interest_4, $user_bio);
    MemberDB::addInterest2($interest2);
    header("Location: redirector.php");
}
if ($action == 'profileImage') {
    if (isset($_FILES['userPhoto']) === true) {
        if (empty($_FILES['userPhoto']['name']) === true) {
            header("Location: signup_part4.php");
        } else {
            $allowed = array('jpg', 'jpeg', 'gif', 'png');
            $file_name = $_FILES['userPhoto']['name'];
            $file_extn = strtolower(end(explode('.', $file_name)));
            $file_temp = $_FILES['userPhoto']['tmp_name'];

            if (in_array($file_extn, $allowed) === true) {
                MemberDB::chanage_profile_image($user_id, $file_temp, $file_extn);
                header("Location: signup_part2.php");
            } else {
                echo "Incorrect file type, allowed: ";
                echo implode(', ', $allowed);
            }
        }
    }
}
if ($action == 'update_profile') {
    $conn = Database::getDB();

    if (!empty($_POST['usrCreWelcMsg'])) {
        $_SESSION['bannermsg'] = $usrMsg = $_POST['usrCreWelcMsg'];
    }
    if (!empty($_POST['editUsrInt1'])) {
        $_SESSION['interest1'] = $_POST['editUsrInt1'];
    }
    if (!empty($_POST['editUsrInt2'])) {
        $_SESSION['interest2'] = $_POST['editUsrInt2'];
    }
    if (!empty($_POST['editUsrInt3'])) {
        $_SESSION['interest3'] = $_POST['editUsrInt3'];
    }
    if (!empty($_POST['editUsrInt4'])) {
        $_SESSION['interest4'] = $_POST['editUsrInt4'];
    }
    if (!empty($_POST['editbio'])) {
        $_SESSION['userbio'] = $_POST['editbio'];
    }
    if (isset($_POST['editpassword']) & !empty($_POST['editpassword'])) {
        $password = $_POST['editpassword'];
        $password = sha1($_SESSION['username'] . $password);
    }
    if (!empty($_POST['editDisplayName'])) {
        $displayName = $_POST['editDisplayName'];
    }

    if (isset($_FILES['userPhoto']) === true) {
        if (empty($_FILES['userPhoto']['name']) === true) {
            header("Location: signup_part4.php");
        } else {
            $allowed = array('jpg', 'jpeg', 'gif', 'png');
            $file_name = $_FILES['userPhoto']['name'];
            $file_extn = strtolower(end(explode('.', $file_name)));
            $file_temp = $_FILES['userPhoto']['tmp_name'];

            if (in_array($file_extn, $allowed) === true) {
                MemberDB::chanage_profile_image($user_id, $file_temp, $file_extn);
                header("Location: signup_part2.php");
            } else {
                echo "Incorrect file type, allowed: ";
                echo implode(', ', $allowed);
            }
        }
    }
    $query = "UPDATE interests
            SET interest1 = '{$_SESSION['interest1']}',interest2 = '{$_SESSION['interest2']}',interest3 = '{$_SESSION['interest3']}',
            interest4 = '{$_SESSION['interest4']}',user_bio = '{$_SESSION['userbio']}'
            WHERE user_id = '{$_SESSION['username']}'";
    $stmt = mysqli_query($conn, $query);
    $stmt = mysqli_query($conn, "UPDATE useraccount SET password = '{$password}', banner_msg = '{$_SESSION['bannermsg']}', displayName = '{$displayName}' WHERE username = '{$_SESSION['username']}'");
    header("Location: ../view/profile.php");
}
if ($action2 == "logout") {
    session_destroy();
    header("Location: ../view/login.php");
}

if ($action == 'userSearch') {

    $user_input = filter_input(INPUT_POST, 'search');
    $_SESSION['userSearch'] = $user_input;
    header("Location: searchResults.php");
}
if ($action == 'user_profile_show') {
    $conn = Database::getDB();
    $query = "SELECT * FROM interests WHERE user_id = '{$_SESSION['userSearch']}'";
    $select_interests_query2 = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($select_interests_query2)) {



        $_SESSION['show_userName'] = $row['user_id'];
        $_SESSION['show_userInterest1'] = $row['interest1'];
        $_SESSION['show_userInterest2'] = $row['interest2'];
        $_SESSION['show_userInterest3'] = $row['interest3'];
        $_SESSION['show_userInterest4'] = $row['interest4'];
    }
    $query2 = "SELECT * FROM preferences WHERE userID = '{$_SESSION['userSearch']}'";
    $select_interests_query3 = mysqli_query($conn, $query2);

    while ($rows = mysqli_fetch_array($select_interests_query3)) {




        $_SESSION['show_gender_pref'] = $rows['gender_pref'];
        $_SESSION['show_quality'] = $rows['quality'];
        $_SESSION['show_live_without'] = $rows['live_without'];
        $_SESSION['show_smokes'] = $rows['smokes'];
        $_SESSION['show_drinks'] = $rows['drinks'];
        $_SESSION['show_has_children'] = $rows['has_children'];
        $_SESSION['show_has_pets'] = $rows['has_pets'];
    }

    header('Location: ../view/other_user_profile.php');
}
if ($action == 'user_queries') {

    $user_query_username = filter_input(INPUT_POST, 'username');
    $user_query_email = filter_input(INPUT_POST, 'email');
    $user_query_content = filter_input(INPUT_POST, 'question');

    $query = ("SELECT email FROM useraccount WHERE username = '{$user_query_username}'");


    MemberDB::addUserQuery($user_query_username, $user_query_email, $user_query_content);

    header('Location: ../view/contact.php');
}
if ($action == 'Post') {
    $userID = filter_input(INPUT_POST, 'user_question_id');
    $_SESSION['ticket_id'] = $userID;
    MemberDB::reviewPost($userID);
    header("Location: ../admin/reviewpost.php");
}
if ($action == 'user_thread_show') {
    $post_id = filter_input(INPUT_POST, 'postID');
    $_SESSION['user_post_id'] = $post_id;
    $conn = Database::getDB();
    $query = mysqli_query($conn, "SELECT * FROM user_posts WHERE user_post_id = '{$post_id}'");


    while ($rows = mysqli_fetch_array($query)) {
        $_SESSION['post_title'] = $rows['post_title'];
        $_SESSION['post_content'] = $rows['post_content'];
        $_SESSION['user_post_username'] = $rows['post_user_id'];
    }

    header("Location: threadContent.php");
}
if ($action == 'add_post') {
    $conn = Database::getDB();
    $user_post_id = $_SESSION['username'];
    $post_content = filter_input(INPUT_POST, 'postContent');
    $post_title = filter_input(INPUT_POST, 'postTitle');
    $time = time();
    $query = ("INSERT INTO user_posts"
            . "(post_user_id,post_content,post_title,time_posted)"
            . "VALUES"
            . "('{$user_post_id}','{$post_content}','{$post_title}','{$time}')");
    $stmt = mysqli_query($conn, $query);
    header("Location: ../view/memberDash.php");
}
if ($action == 'user_comment_add') {
    $conn = Database::getDB();

    $comment_content = filter_input(INPUT_POST, 'comment_content');

    $query = ("INSERT INTO post_comments (user_username,comment_content, related_post) VALUES ('{$_SESSION['username']}','$comment_content','{$_SESSION['user_post_id']}')");
    $stmt = mysqli_query($conn, $query);
    header("Location: ../members/threadContent.php");
}
if ($action == 'user_messages_show') {
    $msg_id = filter_input(INPUT_POST, 'pmID');
    $_SESSION['user_message_id'] = $msg_id;

    $conn = Database::getDB();
    $query = mysqli_query($conn, "SELECT * FROM user_pms WHERE pm_id = '{$msg_id}'");


    while ($rows = mysqli_fetch_array($query)) {
        $_SESSION['msg_title'] = $rows['pm_title'];
        $_SESSION['pm_content'] = $rows['pm_content'];
        $_SESSION['user_from'] = $rows['user_from'];
        $_SESSION['user_to'] = $rows['user_to'];
    }
    $stmt2 = mysqli_query($conn, "UPDATE user_pms SET pm_read = 'TRUE' WHERE pm_id = '{$msg_id}'");
    header("Location: ../members/privateMessages.php");
}
if ($action == 'send_message') {
    $conn = Database::getDB();
    $user_from = $_SESSION['username'];
    $message_content = filter_input(INPUT_POST, 'messageContent');
    $message_title = filter_input(INPUT_POST, 'messageTitle');
    $user_to = filter_input(INPUT_POST, 'user_to');
    $query = ("INSERT INTO user_pms"
            . "(user_to,user_from,pm_title,pm_content)"
            . "VALUES"
            . "('{$user_to}','{$user_from}','{$message_title}','{$message_content}')");
    $stmt = mysqli_query($conn, $query);
    header("Location: ../view/memberDash.php");
}
if ($action == 'answerTicket') {

    $conn = Database::getDB();
    $user_from = "admin";
    $message_content = filter_input(INPUT_POST, 'messageContent');
    $message_title = "Ticket Answered.";
    $user_to = filter_input(INPUT_POST, 'user_to');
    $query = ("INSERT INTO user_pms"
            . "(user_to, user_from, pm_title, pm_content)"
            . "VALUES"
            . "('{$user_to}','{$user_from}','{$message_title}','{$message_content}')");
    $stmt = mysqli_query($conn, $query);
    $stmt2 = mysqli_query($conn, "UPDATE user_questions SET question_answered = 'TRUE' WHERE questionID = '{$_SESSION['ticket_id']}'");
    header("Location: ../admin/admin_page.php");
}
if ($action == 'delete_message') {

    $conn = Database::getDB();
    $pm_id = filter_input(INPUT_POST, 'message_id');
    unset($_SESSION['user_from']);
    unset($_SESSION['msg_title']);
    unset($_SESSION['pm_content']);
    $query = mysqli_query($conn, "DELETE FROM pm_log WHERE main_pm = '{$pm_id}'");
    $query = mysqli_query($conn, "DELETE FROM user_pms WHERE pm_id = '{$pm_id}'");
    header("Location: privateMessages.php");
}
if ($action == 'replyToPm') {
    $conn = Database::getDB();
    $reply = filter_input(INPUT_POST, 'replyContent');



    $query = mysqli_query($conn, "INSERT INTO pm_log "
            . "(reply,user_to,user_from,main_pm) "
            . "VALUES "
            . "('{$reply}','{$_SESSION['user_from']}','{$_SESSION['username']}', '{$_SESSION['user_message_id']}')");
    $query2 = mysqli_query($conn, "UPDATE user_pms SET pm_read = 'FALSE' WHERE pm_id = '{$msg_id}'");
    header("Location: privateMessages.php");
}
if ($action == 'update_user_type') {
    $conn = Database::getDB();
    $change_user_type = filter_input(INPUT_POST, 'change_user_type');
    $username_get = filter_input(INPUT_POST, 'username_get');

    $query = mysqli_query($conn, "UPDATE useraccount SET account_type = '{$change_user_type}' WHERE username = '{$username_get}'");
    header('Location: ../admin/admin_member_update.php');
}
if ($action == 'edit_post') {
    $conn = Database::getDB();

    $_SESSION['post_content'] = filter_input(INPUT_POST, 'postContent');
    $_SESSION['post_title'] = filter_input(INPUT_POST, 'postTitle');

    $query = ("UPDATE user_posts SET post_content = '{$_SESSION['post_content']}', post_title = '{$_SESSION['post_title']}', post_edited = 'TRUE'"
            . "WHERE user_post_id = '{$_SESSION['user_post_id']}'");
    $stmt = mysqli_query($conn, $query);
    header("Location: threadContent.php");
}
if ($action2 == 'match') {
    $conn = Database::getDB();
    $stmt = mysqli_query($conn, "INSERT INTO match_users"
            . "(user_username)"
            . "VALUES"
            . "('{$_SESSION['username']}')");


    $query2 = mysqli_query($conn, "SELECT user_username FROM match_users WHERE user_username != '{$_SESSION['username']}'");
    $query4 = mysqli_fetch_assoc($query2);
    $query = mysqli_query($conn, "SELECT interest1,interest2,interest3,interest4 FROM interests WHERE user_id != '{$_SESSION['username']}' AND user_id = '{$query4['match_id']}'");
    foreach ($query as $value) {
        $interest_array = array($value);
    }
    if (in_array($_SESSION['interest1'], $interest_array)) {
        $match = TRUE;
        $matchFound = array($_SESSION['interest1']);
    } else {
        $match = FALSE;
    }
    if (in_array($_SESSION['interest2'], $interest_array)) {
        $match = TRUE;
        $matchFound = array($_SESSION['interest2']);
    } else {
        $match = FALSE;
    }
    if (in_array($_SESSION['interest3'], $interest_array)) {
        $match = TRUE;
        $matchFound = array($_SESSION['interest3']);
    } else {
        $match = FALSE;
    }
    if (in_array($_SESSION['interest4'], $interest_array)) {
        $match = TRUE;
        $matchFound = array($_SESSION['interest4']);
    } else {
        $match = FALSE;
    }

    if ($match == TRUE) {
        $_SESSION['Matched_Interest'] = $match;
        $query3 = mysqli_query($conn, "SELECT useraccount.username FROM useraccount,match WHERE useraccount.username != '{$_SESSION['username']}' AND useraccount.username IN match.username AND '{$_SESSION['Matched_Interest']}' IN (SELECT interest1, interest2, interest3, interest4 FROM interests)");
        $stmt = mysqli_fetch_assoc($query3);
        $_SESSION['other_user'] = $stmt['useraccount.username'];
        $_SESSION['matched'] = TRUE;
        header("Location: success.php");
    } else {
        $_SESSION['matched'] = FALSE;
        header("Location: nomatch.php");
    }
}
?>