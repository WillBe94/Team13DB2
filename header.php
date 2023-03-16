<?php
	session_start();
	if(!isset($_SESSION['user_id']))
	{
		exit; //You're not supposed to be here
	}
	$user_id = $_SESSION['user_id'];
	$user_type = $_SESSION['user_type'];
?>

<html>
	<body>
		<div id="settings_button">
			<button onclick="location.href='http://localhost/settings.php'" type="button">Settings</button>
		</div>
		<div id=ribbon_menu>
			<a href="./enrolled">Current Enrollments</a> | <a href="./reading_groups">Reading Groups</a>
		</div>