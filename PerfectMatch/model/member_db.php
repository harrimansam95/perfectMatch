<?php

class MemberDB {

    public static function deleteMember($value) {
        $db = Database::getDB();
        
        $query = ("DELETE FROM useraccount WHERE username = '{$value}'");
        $statement = mysqli_query($db, $query);
    }

    public static function adminDeleteMember($value) {
        $db = Database::getDB();
        
        $query = ("DELETE FROM useraccount WHERE username = '{$value}'");
        $statement = mysqli_query($db, $query);
    }

    public static function addMember($member) {
        $conn = Database::getDB();

        $username = $member->getUsername();
        $displayName = $member->getDisplayName();
        $password = $member->getPassword();
        $Email = $member->getEmail();


        $query = ("INSERT INTO useraccount
                     (username, password, email, displayName)
                  VALUES
                     ('{$username}','{$password}','{$Email}','{$displayName}')");

        $stmt = mysqli_query($conn, $query);
    }

    public static function addInterest($interest) {

        $conn = Database::getDB();

        $preferences = $interest->getPreference();
        $quality = $interest->getQuality();
        $live_Without = $interest->getLiveWithout();
        $smokes = $interest->getSmokes();
        $drinks = $interest->getDrinks();
        $has_Children = $interest->getHasChildren();
        $has_Pets = $interest->getHasPets();

        $query = ("INSERT INTO preferences"
        . "(gender_pref, quality , live_without , smokes , drinks , has_children , has_pets , userID)"
        . "VALUES"
        . "('{$preferences}','{$quality}','{$live_Without}','{$smokes}','{$drinks}','{$has_Children}','{$has_Pets}','{$_SESSION['username']}')");

        $stmt = mysqli_query($conn, $query);
    }

    public static function addInterest2($interest2) {
        $conn = Database::getDB();

        $user_interest1 = $interest2->getInterest1();
        $user_interest2 = $interest2->getInterest2();
        $user_interest3 = $interest2->getInterest3();
        $user_interest4 = $interest2->getInterest4();
        $user_bio = $interest2->getUserBio();

         $query = ("INSERT INTO interests"
                 . "(interest1,interest2,interest3,interest4,user_bio,user_id)"
                 . "VALUES"
                 . "('{$user_interest1}','{$user_interest2}','{$user_interest3}','{$user_interest4}','{$user_bio}','{$_SESSION['username']}')");
        
        $stmt = mysqli_query($conn, $query);
    }
    public static function chanage_profile_image($user_id, $file_temp, $file_extn){
        $conn = Database::getDB();
        $user_id = $_SESSION['username'];
        $file_path = '../members/images/' . substr(md5(time()), 0, 10) . '.' . $file_extn;
        move_uploaded_file($file_temp, $file_path);
        mysqli_query($conn,"UPDATE useraccount SET profile_photo = '{$file_path}' WHERE username = '{$user_id}'");
        $_SESSION['profilePhoto'] = $file_path;
   
    }

    public static function userSearch($value) {

        $conn = Database::getDB();

        $query = ("SELECT * FROM interests WHERE user_id = ' {
            $value
        }'");
        $stmt = mysqli_query($conn, $query);
    }

    public static function addUserQuery($user_query_username, $user_query_email, $user_query_content) {

        $conn = Database::getDB();
        $query = ("INSERT INTO user_questions"
                . "(user_username, user_email, user_question)"
                . "VALUES"
                . "('$user_query_username','$user_query_email','$user_query_content')");
        $stmt = mysqli_query($conn, $query);
    }

    public static function reviewPost($userID) {
        $conn = Database::getDB();
        $query = ("SELECT * FROM user_questions WHERE questionID = '{$userID}'");
        $stmt = mysqli_query($conn, $query);
        $rows = mysqli_fetch_assoc($stmt);
        $_SESSION['review_post_username'] = $rows['user_username'];
        $_SESSION['review_post_email'] = $rows['user_email'];
        $_SESSION['review_post_question'] = $rows['user_question'];
    }

    public static function time_stamp($timestamp) {
        $current_time = time();
        $time_difference = $current_time - $timestamp;
        $seconds = $time_difference;
        $minutes = round($seconds / 60);           // value 60 is seconds  
        $hours = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec  
        $days = round($seconds / 86400);          //86400 = 24 * 60 * 60;  
        $weeks = round($seconds / 604800);          // 7*24*60*60;  
        $months = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60  
        $years = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60  
        if ($seconds <= 60) {
            return "Just Now";
        } else if ($minutes <= 60) {
            if ($minutes == 1) {
                return "one minute ago";
            } else {
                return "$minutes minutes ago";
            }
        } else if ($hours <= 24) {
            if ($hours == 1) {
                return "an hour ago";
            } else {
                return "$hours hrs ago";
            }
        } else if ($days <= 7) {
            if ($days == 1) {
                return "yesterday";
            } else {
                return "$days days ago";
            }
        } else if ($weeks <= 4.3) { //4.3 == 52/12  
            if ($weeks == 1) {
                return "a week ago";
            } else {
                return "$weeks weeks ago";
            }
        } else if ($months <= 12) {
            if ($months == 1) {
                return "a month ago";
            } else {
                return "$months months ago";
            }
        } else {
            if ($years == 1) {
                return "one year ago";
            } else {
                return "$years years ago";
            }
        }
    }
    
    public static function compare_interest($interest_array){
        
        $match = FALSE;
        $matchFound = array();
        $noMatch = "No matches found.";
       
       
        if(in_array($_SESSION['interest2'], $interest_array)){
            $match = TRUE;
            $matchFound = array($_SESSION['interest2']);
        }else{
            $match = FALSE;
        }
        if(in_array($_SESSION['interest3'], $interest_array)){
            $match = TRUE;
            $matchFound = array($_SESSION['interest3']);
        }else{
            $match = FALSE;
        }
        if(in_array($_SESSION['interest4'], $interest_array)){
            $match = TRUE;
            $matchFoun = array($_SESSION['interest4']);
        }else{
            $match = FALSE;
        }
        
        if(!empty($matchFound)){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }

}

?>