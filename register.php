<?php
	//$message = "";
	$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];//document root variable is assigned to $_SERVER
	if(isset($_POST['submit']))
	{ //check if form was submitted
		$email = $_POST['emailText']; //get input text from POST array
		$password = $_POST['passwordText']; //get password text from POST array
		$name = $_POST['nameText'];
		$phone = $_POST['phoneNumber'];
		$db = new mysqli('localhost', 'root', '', 'db2');
		if (mysqli_connect_errno())
		{
			echo '<p> Error: Could not establish connection to database</p>';
			exit;
		}

		$highest_id_query = "SELECT MAX(id) FROM users;";
		$highest_id_stmt = $db->prepare($highest_id_query);
		$highest_id_stmt->execute();
		$highest_id_stmt->store_result();
		$id_result = $highest_id_stmt->get_result();
		while ($row = $id_result->fetch_assoc())
		{
			$last_id = $row['id'];
		}

		if($last_id == null)
		{
			echo "Error, max ID in table is null";
			exit;
		}
		else
		{
			$next_id = $last_id + 1;
		}
		
		{
			/*
			$insert_modification = "INSERT INTO users (id, email, password, name, phone) VALUES ($next_id, $email, $password, $name, $phone)";
			$insert_modification_stmt = $db->prepare($insert_modification);
			$insert_modification_stmt->execute();
			
			//$message = "Registration Successful!";


			/*
			$outputstring = $username."\t".$password."\n";

			// open file for appending
			$doc_root = $_SERVER['DOCUMENT_ROOT'];
			$fp = fopen("$doc_root/userData.txt", 'a');
			flock($fp, LOCK_EX);

			if (!$fp) 
			{
				echo "<p><strong> Your registration could not be processed at this time.  Please try again later.</strong></p></body>";
				exit;
			}
			fwrite($fp, $outputstring, strlen($outputstring));
			flock($fp, LOCK_UN);
			fclose($fp);
			*/
		}

	}
?>

<html>
	<head>
		<title>Greendale registration</title>
	</head>

	<body>
		<h1>Greendale online portal registration</h1>

		<form action="register_script.php" method="post">
			Email<input type="email" name="email_text" id="user_email" placeholder="School email preferred" required/><br>
			Password<input type="password" name="password_text" id="user_password" placeholder="******" required/><br>
			Full Name<input type="text" name="name_text" id="user_real_name" placeholder="" required/><br>
			Phone Number<input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="phone_number" id="user_phone_number" placeholder="" required/><br>
			Grade Level<input type="text" name="grade_level" placeholder="only required for students" id="student_grade_level"><br>
			<select name="user_type" id="drop_down_menu">
				<option value="student">Student</option>
				<option value="parent">Parent</option>
			</select><br>
			<input type="submit" value="Register" name="submit"/>
			<button onclick="location.href='http://localhost/login.html'" type="button">Return to login</button>
		</form>
		<!--<?php// echo $message; ?>-->
	</body>
</html>
