<?php
	session_start();
	
	//This makes sure that a professor is logged in
	if($_SESSION['isProf'] != 1 || empty($_SESSION)) {
		//This will send the user away if there's no student login info
		header('Location: index.php');
	}
	
	//This sets all the universal variables
	include_once 'system-connect.php';
	$error = array();
	$success = array();
	$username = $_SESSION['username'];
	$uniID = $_SESSION['uniID'];
	
	// This handles the "submit new class" button being hit
	if (!empty($_POST) && !empty($_POST['submitClass'])) {
		// collects the fields
		$classNum  = trim($_POST['newCourseNumber']);
		$classSec  = trim($_POST['newCourseSection']);
		$className = trim($_POST['newCourseName']);
		
		
		// checks for empty fields first
		if (empty($classNum) || $classNum == "") {
			$error[] = "The Class Number field can't be empty!";
		}
		if (empty($classSec) || $classSec == "") {
			$error[] = "The Class Section field can't be empty!";
		}
		if (empty($className) || $className == "") {
			$error[] = "The Class Name field can't be empty!";
		}
		
		
		// checks for no errors before then doing a duplicate classNum & classSec check
		if (empty($error)) {
			$query = "SELECT * FROM UniversityClassRoster, Class WHERE Class.crseID='$classNum' AND Class.sectNum=$classSec AND UniversityClassRoster.uniID=$uniID";
			$sql = $conn->prepare($query);
			$sql->execute();
			$classIDs = $sql->fetchAll();
			
			if (!empty($classIDs)) {
				$error = "That course and section combo already exists!";
			}
		}
		
		// does one final error check before finaly inserting the data into the database
		if (empty($error)) {
			// This creates the class in the class table
			$query = "INSERT INTO Class VALUES (NULL, '$classNum', $classSec, '$className')";
			$sql = $conn->prepare($query);
			$sql->execute();
			
			
			// this then collects the classID from Class
			$query = "SELECT LAST_INSERT_ID()";
			$sql = $conn->prepare($query);
			$sql->execute();
			$class = $sql->fetchAll();
			$classID = intval($class[0]['LAST_INSERT_ID()']);
			
			
			// then, it adds the appropriate relationship entities into the database
			$query = "INSERT INTO UniversityClassRoster VALUES($uniID, $classID)";
			$sql = $conn->prepare($query);
			$sql->execute();
			$query = "INSERT INTO ClassUserRoster VALUES($classID, '$username')";
			$sql = $conn->prepare($query);
			$sql->execute();
			
			
			// finally, there's a success statement given and all the values are cleared
			$success[] = "Class successfully created! Give your student the class number '$classID' so they can sign up for it!";
			$classNum  = "";
			$className = "";
			$classSec  = "";
		}
	}
?>


<html>
  <head>
	<title>Professor - Create Course</title>
	<link rel="stylesheet" href="StyleSheet_Sidebar.css">
	<link rel="stylesheet" href="StyleSheet_Professor.css">
  </head>
  
  
  <body>
  	<div class="sidebar">
	  <a href="prof-viewData.php">View Data</a>
	  <a href="prof-addData.php">Add Questions</a>
	  <a href="prof-createSyllabus.php">Create Syllabus</a>
	  <a class="active" href="prof-createCourse.php">Create a Course</a>
	  <a class="bottom" href="user-logout.php">Logout</a>
	</div>
	
	<div class="content">
		<h2>Create a Course</h2>
		
		<form action="" method="post">
			<label for="newCourseNumber">New Course ID: </label><br>
			<input type="text" name="newCourseNumber" placeholder="PSYC101" required value="<?php if(!empty($_POST['newCourseNumber'])){ echo $classNum; } else { echo ''; } ?>"/>
			<br><br>
			
			<label for="newCourseSection">New Course Section: </label><br>
			<input type="number" name="newCourseSection" placeholder="1" required min=1 max=255 value="<?php if(!empty($_POST['newCourseSection'])){ echo $classSec; } else { echo ''; } ?>"/>
			<br><br>
			
			<label for="newCourseName">New Course Name: </label><br>
			<input type="text" name="newCourseName" placeholder="Intro to Psychology" required value="<?php if(!empty($_POST['newCourseName'])){ echo $className; } else { echo ''; } ?>"/>
			<br><br>
			
			<button type="submit" name="submitClass" value="✓">Create New Course</button>
			<br><br>
		</form>
		
		<span class="error"><?php if(!empty($error)) foreach($error as $e) echo $e . "<br>"; ?></span>
		<span class="success"><?php if(!empty($success)) foreach($success as $s) echo $s . "<br>"; ?></span>
	</div>
  </body>
</html>