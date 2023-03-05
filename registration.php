<?php
	session_start();
	
	$email=$_POST['email_text'];
		$_SESSION['email'] = $email; //store relevant data for login in the $_SESSION array
	$password_text=$_POST['password_text'];
		$_SESSION['password'] = $password_text;
	$name_text=$_POST['name_text'];
	$phone_number=$_POST['phone_number'];
	$user_type=$_POST['user_type'];
		$_SESSION['user_type'] = $user_type;
	if($user_type=="Student")
	{
		$grade_level = $_POST['grade_level'];
	}

	$no_dupe_query = "SELECT COUNT(id) FROM users WHERE $email=email;";
	$dupe_count = mysqli($no_dupe_query); //need to check that no users already exist with the provided email

	$insert_modification = "INSERT INTO users (id, email, password, name, phone) VALUES ($next_id, $email, $password_text, $name_text, $phone_number);";
	//insert the new user once we've determined no dupes exist
	
	if($dupe_count > 0)
	{
		mysqli($insert_modification);
		switch($user_type) //
		{
			case 'student':
				$insert_student_modification = "INSERT INTO students VALUES (id";
				header('Location: /login_form.php');
				break;
			case 'parent':
				header('Location: /choose_children.php');
				break;
			default :
				//HALT AND CATCH FIRE
				echo('<p>Error: neither student nor parent was selected in drop-down menu</p>');
		}
	}
	else
	{
		//HALT AND CATCH FIRE
		echo('<p>Error: an account using that email address already exists.</p>');
	}
?>