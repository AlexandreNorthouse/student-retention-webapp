<?php
	session_start();
	
	//This makes sure that a student is logged in
	if($_SESSION['isProf'] != 0 || empty($_SESSION)) {
		//This will send the user away if there's no student login info
		header('Location: index.php');
	}
	
	//This sets the required universal variables
	include_once 'system-connect.php';
	$error = array();
	$success = array();
	$username = $_SESSION['username'];
	
	if (!empty($_POST)) {
		// collects the fields
		$courseNum = trim($_POST['courseNumber']);
		
		
		// checks for an empty field first
		if (empty($courseNum) || $courseNum == "") {
			$error[] = "The Course Number field can't be empty!";
		} else {
			// then checks to make sure the class exists
			$query = "SELECT classID FROM Class WHERE classID=$courseNum";
			$sql = $conn->prepare($query);
			$sql->execute();
			$class = $sql->fetchAll();
			if (empty($class)) {
				$error[] = "That class code doesn't exist!";
			}
		}
		
		
		// checks for no errors before then doing a duplicate class ID non-existant class check
		if (empty($error)) {
			$query = "SELECT * FROM ClassUserRoster WHERE classID=$courseNum AND username='$username'";
			$sql = $conn->prepare($query);
			$sql->execute();
			$classStudList = $sql->fetchAll();
			
			if (!empty($classStudList)) {
				$error[] = "You're already signed up for that class!";
			}
		}
		
		
		// does one final error check before finaly inserting the data into the database
		if (empty($error)) {
			$query = "INSERT INTO ClassUserRoster VALUES ($courseNum, '$username')";
			$sql = $conn->prepare($query);
			$sql->execute();
			
			$success[] = "You're now successfully signed up for that class!";
		}
	}
?>



<html>
  <head>
	<title>Student - Add Course</title>
	<link rel="stylesheet" href="StyleSheet_Sidebar.css">
	<link rel="stylesheet" href="StyleSheet_Student.css">
  </head>
  <body>
	<div class="sidebar">
	  <a href="stu-chatbot.php">Use the Chatbot</a>
	  <a class="active" href="stu-addCourse.php">Add a Class</a>
	  <a class="bottom" href="user-logout.php">Logout</a>
	</div>
	
	<div class="content">
		<h2>Add Course</h2>
		<form action="" method="post">
			<label for="courseNumber">Course Number: </label><br>
			<input type="number" name="courseNumber" required min=1 max=99999999999 value="<?php if(!empty($_POST['courseNum'])){ echo $classNum; } else { echo ''; } ?>"/><br><br>
			<button type="submit" name="submit" value="✓">Submit</button>
			<br><br>
		</form>
		
		<span class="error"><?php if(!empty($error)) foreach($error as $e) echo $e . "<br>"; ?></span>
		<span class="success"><?php if(!empty($success)) foreach($success as $s) echo $s . "<br>"; ?></span>
	</div>
  </body>
</html>