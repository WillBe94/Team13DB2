<?php
//Make query check for if student belongs to parent
include ("database_connect.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "nice try";
    exit; //You're not supposed to be here
}
$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type'];
?>

<html>

<body>
    <p><?php echo "You are a $user_type"; ?><br> <a href="./logout.php">Logout</a></p>

    <div id=ribbon_menu>
        <a href=" ./enrolled.php">Current Enrollments</a> | <a href="./meeting.php">Meetings</a> | <a
            href="./readinggroup.php">Reading Groups</a> | <a href="./studymaterial.php">Study Material</a>
        <?php if($user_type == "parent") { ?> | <a href="./childrenchoose.php">My Children</a>
        <?php } ?>
        <?php if($user_type == "student" || $user_type == "parent") { ?>
        | <a href='http://localhost/settings.php?user_id=<?php echo $user_id; ?>&user_type=<?php echo $user_type; ?>'>My
            Settings</a> <?php } ?>
    </div>