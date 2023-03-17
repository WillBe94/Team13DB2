<?php  
//Password talk to teammates how we want to do it
//Check session to make sure only student or parent can be here
//If parent do a query to see if the child belongs to the parents
require 'header.php';
if(!isset($_GET['user_id'])) {
    echo "This user does not exist";
    exit();
}
$setting_userid = htmlspecialchars($_GET["user_id"]);



$usersettings_query = "SELECT email,name,phone,grade FROM users
                       INNER JOIN students ON student_id = id
                       WHERE `id`='$setting_userid';";
$usersettings_result = mysqli_query($db, $usersettings_query); 

$setting_name = "";
$setting_email = "";
$setting_phone = "";
$setting_gradelevel = "";

while ($row = $usersettings_result->fetch_assoc()) {
    $setting_name = $row['name'];
    $setting_email = $row['email'];
    $setting_phone = $row['phone'];
    $setting_gradelevel = $row['grade'];
}
?>

</br>
<div>
    <form action="settings_script.php" method="post">
        Email<input value=<?php echo $setting_email; ?> type="email" name="email_text" id="user_email"
            placeholder="School email preferred" required /><br>
        Full Name<input value=<?php echo $setting_name; ?> type="text" name="name_text" id="user_real_name"
            placeholder="" required /><br>
        Phone Number<input value=<?php echo $setting_phone; ?> type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
            name="phone_number" id="user_phone_number" placeholder="" required /><br>
        Grade Level<input value=<?php echo $setting_gradelevel; ?> type="text" name="grade_level"
            placeholder="only required for students" id="student_grade_level"><br>
        </br>
        <input type="submit" value="Update" name="submit" />

    </form>
</div>

<?
require 'footer.php';
?>