<?php
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

    <div id="settings_button">
        <a href="./logout.php">Logout</a>
    </div>
    <div id="settings_button">
        <button onclick="location.href='http://localhost/settings.php'" type="button">Settings</button>
    </div>

    <div id=ribbon_menu>
        <a href="./enrolled.php">Current Enrollments</a> | <a href="./reading_groups.php">Reading Groups</a>
    </div>