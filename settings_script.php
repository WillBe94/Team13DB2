<?php
if(isset($_POST['submit'])) {
    session_start();
    include ("database_connect.php");
    
    $email = $_POST['email_text'];
    // $password_text = $_POST['password_text'];
    $name_text = $_POST['name_text'];
    $phone_number = $_POST['phone_number'];
    $grade_level = $_POST['grade_level'];
    $user_id = $_SESSION['user_id'];

    $sql = "UPDATE users SET email='$email', name='$name_text', phone='$phone_number' WHERE id='$user_id'";

    if (mysqli_query($db,$sql) === FALSE) {
        echo "Error updating record: " . $db->error;
    }

    $sql = "UPDATE students SET grade='$grade_level' WHERE student_id='$user_id'";
    
    if (mysqli_query($db,$sql) === TRUE) {
        header("Location: settings.php");
    } else {
        echo "Error updating record: " . $db->error;
    }
    
} else {
    echo "You can not come here without using a form.";
}
?>