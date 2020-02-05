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
	
	// this is so the section object can be created
	$query = "SELECT Class.classID, Class.crseID, Class.sectNum, Class.crseName FROM Class, ClassUserRoster WHERE ClassUserRoster.classID=Class.classID AND ClassUserRoster.username='$username'";
	$sql = $conn->prepare($query);
	$sql->execute();
	$classList = $sql->fetchAll();
	
	
	// This handles the "Submit New Question" button being hit
	if (!empty($_POST) && !empty($_POST['submitData'])){
		$question = trim($_POST['dataQuestion']);
		$answer = trim($_POST['dataAnswer']);
		$selectedClass = intval($_POST['dataClassID']);
		
		
		// checks for empty fields first
		if (empty($question) || $question == "") {
			$error[] = "The Question field can't be empty!";
		}
		if (empty($answer) || $answer == "") {
			$error[] = "The Answer field can't be empty!";
		}
		
		// checks for no errors before then doing a duplicate question and answer check
		if (empty($error)) {
			$query = "SELECT * FROM Question, ClassQuestions WHERE 
						ClassQuestions.quesID=$selectedClass AND Question.qtext='$question'";
			$sql = $conn->prepare($query);
			$sql->execute();
			$copyCheck = $sql->fetchAll();
			
			if (!empty($copyCheck)){
				$error[] = "That question already exists for that class!";
			}
		}
		
		// does one final error check before finaly inserting the data into the database
		if (empty($error)) {
			// This creates the class in the class table
			$query = "INSERT INTO Question VALUES (NULL, '$question', '$answer')";
			$sql = $conn->prepare($query);
			$sql->execute();
			
			
			// This then gets that question's ID
			$query = "SELECT LAST_INSERT_ID()";
			$sql = $conn->prepare($query);
			$sql->execute();
			$questionCheck = $sql->fetchAll();
			$questionID = $questionCheck[0]['LAST_INSERT_ID()'];
			
			
			// This then inserts the relationship entry into ClassQuestions
			$query = "INSERT INTO ClassQuestions VALUES ($selectedClass, $questionID)";
			$sql = $conn->prepare($query);
			$sql->execute();
			
			
			// finally, there's a success statement given and all the values are cleared
			$success[] = "Question successfully added to that class!";
			$question  = "";
			$answer = "";
			$selectedClass = "";
		}
	} else {
		$selectedClass = 0;
		$results = [];
	}
?>



<html>
  <head>
	<title>Professor - Add Data</title>
	<link rel="stylesheet" href="StyleSheet_Sidebar.css">
	<link rel="stylesheet" href="StyleSheet_Professor.css">
  </head>
  
  
  <body>
  	<div class="sidebar">
	  <a href="prof-viewData.php">View Data</a>
	  <a class="active" href="prof-addData.php">Add Questions</a>
	  <a href="prof-createSyllabus.php">Create Syllabus</a>
	  <a href="prof-createCourse.php">Create a Course</a>
	  <a class="bottom" href="user-logout.php">Logout</a>
	</div>
	
	<div class="content">
		<h2>Add Question</h2>
		
		
		<form action="" method="post">
			<label for="dataClassID">Select Course: </label><br>
			<select name="dataClassID">
				<?php
					if (!empty($classList)){
						foreach($classList as $c){
							echo ('<option value="' . $c['classID'] . '"');
							if ($selectedClass == $c['classID']) {
								echo (" selected ");
							}
							echo ('>' . $c['crseName'] . '</option>');
						}
					}
				?>
			</select>
			<br><br>
			
			<label for="dataQuestion">Question: </label><br>
			<textarea name="dataQuestion" required value="<?php if(!empty($_POST['dataQuestion'])){ echo $question; } else { echo ''; } ?>"></textarea>
			<br><br>
			
			<label for="dataAnswer">Answer: </label><br>
			<textarea name="dataAnswer" required value="<?php if(!empty($_POST['dataAnswer'])){ echo $answer; } else { echo ''; } ?>"/></textarea>
			<br><br>
			
			<button type="submit" name="submitData" value="✓">Create New Question</button>
			<br><br>
		</form>
		
		<span class="error"><?php if(!empty($error)) foreach($error as $e) echo $e . "<br>"; ?></span>
		<span class="success"><?php if(!empty($success)) foreach($success as $s) echo $s . "<br>"; ?></span>
	</div>
  </body>
</html>