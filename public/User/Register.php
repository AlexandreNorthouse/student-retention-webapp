<?php
	if (!empty($_SESSION)) {
		session_destroy();
	}
	include_once 'system-connect.php';
	$error = array();
	$success = array();
	
	if (!empty($_POST)) {
		// collects the fields
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$password2 = trim($_POST['password2']);
		$fName = trim($_POST['fname']);
		$lName = trim($_POST['lname']);
		$uniID = trim($_POST['uniid']);
		
		
		// checks for empty fields first
		if (empty($username) || $username == "") {
			$error[] = "Username field can't be empty!";
		}
		if (empty($uniID) || $uniID == "") {
			$error[] = "University ID Number field can't be empty!";
		}
		if (empty($fName) || $fName == "") {
			$error[] = "First Name field can't be empty!";
		}
		if (empty($lName) || $lName == "") {
			$error[] = "First Name field can't be empty!";
		}
		
		// then checks for empty password fields AND for non-matching password fields
		if ((empty($password) || $password == "") || (empty($password2) || $password2 == "")) {
			$error[] = "Password fields can't be empty!";
		} elseif ($password != $password2) {
			$error[] = "Password fields don't match!";
		} else {
			$password = sha1($password);
		}
		
		
		// checks for no errors before then doing a duplicate username check
		if (empty($error)) {
			if (!empty($_POST['createStudent'])) {
				$isProf = 0;
			} elseif (!empty($_POST['createProfessor'])) {
				$isProf = 1;
			}
			
			$query = "SELECT username FROM Users WHERE username='$username'";
			$sql = $conn->prepare($query);
			$sql->execute();
			$userList = $sql->fetchAll();
			if(!empty($userList)) {
				$error[] = "Username is already taken!";
			}
		}
		
		
		// once again checks for no errors before inserting the data into the database
		if (empty($error)) {
			$query = "INSERT INTO Users VALUES ('$username', '$password', '$fName', '$lName', $isProf)";
			$sql = $conn->prepare($query);
			$sql->execute();
			
			$query = "INSERT INTO UniversityUsersRoster VALUES ($uniID, '$username')";
			$sql = $conn->prepare($query);
			$sql->execute();
			
			// Gives a success message and then resets all the values!
			$success[] = "The database was successfully updated with your info!
								Please return to the login page to now login.";
			$username = "";
			$password = "";
			$password2 = "";
			$fName = "";
			$lName = "";
			$uniID = "";
		}
	}
?>



<html>
  <head>
	<title>SRS - Register User</title>
	<link rel="stylesheet" href="StyleSheet_User.css">
  </head>
  <body>
	<section class="login">
		<h1>Student Retention Service</h1>
		<h1>Register</h1>
		
		<form action="" method="post">
			<section class="fields">
				<label for="username">Username: </label>
				<input type="text" name="username" required value="<?php if(!empty($_POST['username'])){ echo $username; } else { echo ''; } ?>"/>
				<br>
				
				<label for="uniid">University ID Number: </label>
				<input type="number" name="uniid" required min=1 max=99999999999 value="<?php if(!empty($_POST['uniid'])){ echo $uniID; } else { echo ''; } ?>"/>
				<br>
				
				<label for="password">Password: </label>
				<input type="password" name="password" required />
				<br>
				
				<label for="password2">Re-enter Password: </label>
				<input type="password" name="password2" required />
				<br><br>
				
				<label for="fname">First Name: </label>
				<input type="text" name="fname" required value="<?php if(!empty($_POST['fname'])){ echo $fName; } else { echo ''; } ?>"/><br>
				
				<label for="lname">Last Name: </label>
				<input type="text" name="lname" required value="<?php if(!empty($_POST['lname'])){ echo $lName; } else { echo ''; } ?>"/><br>
			</section>
			
			<span class="error"><?php if(!empty($error)) foreach($error as $e) echo $e . "<br>"; ?></span>
			<span class="success"><?php if(!empty($success)) foreach($success as $s) echo $s . "<br>"; ?></span>
			<br><br>
			
			<section class="horizontalsection">
				<button type="submit" name="createStudent" value="✓">Create Student</button>
				<button type="submit" name="createProfessor" value="✓">Create Professor</button>
			</section>
		</form>
		
		<br>
		<div style="text-align: center;">
			<button style="position:relative" onclick="window.location.href = 'index.php';">Return to Login Page</button>
		</div>
	</section>
  </body>
</html>