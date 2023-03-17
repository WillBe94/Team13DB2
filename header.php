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



$children_array = [];
if($user_type == "parent") {
    //This will be the query to check if the child belongs to the parent

   // array_push($children_array, "apple");
}
?>

<html>

<body>
    <p><?php echo "You are a $user_type"; ?> <a href="./logout.php">Logout</a></p>

    <div id=ribbon_menu>
        <a href=" ./enrolled.php">Current Enrollments</a> | <a href="./reading_groups.php">Reading Groups</a>
        <?php if($user_type == "parent") { ?> | <a href="./childrenchoose.php">My Children</a>
        <?php } ?>
        <?php if($user_type == "student") { ?>
        | <a href='http://localhost/settings.php?user_id=<?php echo $user_id; ?>'">Settings</a> <?php } ?>
    </div>