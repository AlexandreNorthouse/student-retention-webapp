<?php
	if (!empty($_SESSION)) {
		session_destroy();
	}
	session_start();
	include_once 'system-connect.php';
	$error = array();
	
	if (!empty($_POST)) {
		// collects the fieldsvjvjv
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		
		
		// checks for empty fields first
		if (empty($username) || $username == "") {
			$error[] = "Username field can't be empty!";
		}
		if (empty($password) || $password == "") {
			$error[] = "Password field can't be empty!";
		}
		
		
		// checks for no errors before then doing a duplicate username check
		if (empty($error)) {
			$query = "SELECT * FROM Users WHERE username='$username'";
			$sql = $conn->prepare($query);
			$sql->execute();
			$user = $sql->fetchAll();
			
			if (empty($user)){
				$error[] = "Username doesn't exist!";
			}
			
			
			if(!empty($user)) {
				// handles the code for an actually existing user
				if($user[0]['password'] == sha1($password)) {
					// sets the session variable to contain their id and first name
					$_SESSION['username'] = $user[0]['username'];
					$_SESSION['fName'] = $user[0]['fname'];
					$_SESSION['lName'] = $user[0]['lname'];
					$_SESSION['isProf'] = intval($user[0]['isProf']);
					
					// then sets their uniID
					$query = "SELECT uniID FROM UniversityUsersRoster WHERE username='$username'";
					$sql = $conn->prepare($query);
					$sql->execute();
					$uniID = $sql->fetchAll();
					$_SESSION['uniID'] = intval($uniID[0]['uniID']);
					var_dump($_SESSION['uniID']);
					
					
					// then redirects them to their proper home page
					if ($_SESSION['isProf'] == 0){
						header('Location: stu-chatbot.php');
					} else if ($_SESSION['isProf'] == 1){
						header('Location: prof-viewData.php');
					} else {
						$error[] = "There is an error with your account.";
					}
				} else {
					$error[] = "Username and password do not match";
				}
			}
		}
	}
?>



<html>
  <head>
	<title>SRS - Login</title>
	<link rel="stylesheet" href="StyleSheet_User.css">
  </head>
  <body>
	<section class="login">
		<h1>Student Retention Service</h1>
		<h1>Login</h1>
		
		<form action="" method="post">
			<section class="fields">
				<label for="username">Username: </label>
				<input type="text" name="username" required value="<?php if(!empty($_POST['username'])){ echo $username; } else { echo ''; } ?>"/><br><br>
				<label for="password">Password: </label>
				<input type="password" name="password" required />
			</section>
			<br><br>
			
			<button type="submit" name="LoginButton" value="✓">Login</button>
			<br><br>
		</form>
		
		<span class="error"><?php if(!empty($error)) foreach($error as $e) echo $e . "<br>"; ?></span>
		<br><br>
		<div style="text-align: center;">
			<button style="position:relative" onclick="window.location.href = 'user-register.php';">Register a New User</button>
		</div>
	</section>
  </body>
</html>














