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
	
	// This handles the "submit new class" button being hit
	if (!empty($_POST) && !empty($_POST['submitData'])) {
		// collects the fields
		$selectedClass = intval($_POST['dataClassID']);
		$ct = trim($_POST['dataCourseTitle']);
		$ci = trim($_POST['dataContactInformation']);
		$ohp = trim($_POST['dataOfficeHoursPolicy']);
		$cd = trim($_POST['dataCourseDescription']);
		$cg = trim($_POST['dataCourseGoals']);
		$rm = trim($_POST['dataRequiredMaterials']);
		$g = trim($_POST['dataGrading']);
		$a = trim($_POST['dataAttendance']);
		$up = trim($_POST['dataUniversityPolicies']);
		$sr = trim($_POST['dataStudentResources']);
		
		// this inserts the data into the database
		$query = "INSERT INTO Syllabus VALUES (NULL, '$ct', '$ci', '$ohp', '$cd', '$cg', '$rm',
					'$g', '$a', '$up', '$sr')";
		$sql = $conn->prepare($query);
		$sql->execute();
			
			
		// this then collects the syllabusID from Syllabus
		$query = "SELECT LAST_INSERT_ID()";
		$sql = $conn->prepare($query);
		$sql->execute();
		$class = $sql->fetchAll();
		$syllabusID = intval($class[0]['LAST_INSERT_ID()']);
			
			
		// then, it adds the appropriate relationship entities into the database
		$query = "INSERT INTO ClassSyllabus VALUES($selectedClass, $syllabusID)";
		$sql = $conn->prepare($query);
		$sql->execute();
			
			
		// finally, there's a success statement given and all the values are cleared
		$success[] = "The syllabus was successfully uploaded!";
		$selectedClass = 0;
		$classNum  = "";
		$className = "";
		$classSec  = "";
	} else {
		$selectedClass = 0;
	}
?>



<html>
  <head>
	<title>Professor - Create Syllabus</title>
	<link rel="stylesheet" href="StyleSheet_Sidebar.css">
	<link rel="stylesheet" href="StyleSheet_Professor.css">
  </head>
  
  
  <body>
  	<div class="sidebar">
	  <a href="prof-viewData.php">View Data</a>
	  <a href="prof-addData.php">Add Questions</a>
	  <a class="active" href="prof-createSyllabus.php">Create Syllabus</a>
	  <a href="prof-createCourse.php">Create a Course</a>
	  <a class="bottom" href="user-logout.php">Logout</a>
	</div>
	
	<div class="content">
		<h2>Create Syllabus</h2>
		
		
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
			
			<label for="dataCourseTitle">Course Title: </label><br>
			<textarea name="dataCourseTitle" required value="<?php if(!empty($_POST['dataCourseTitle'])){ echo $courseTitle; } else { echo ''; } ?>"></textarea>
			<br><br>
			
			<label for="dataContactInformation">Contact Information: </label><br>
			<textarea name="dataContactInformation" required value="<?php if(!empty($_POST['dataContactInformation'])){ echo $contactInfo; } else { echo ''; } ?>"></textarea>
			<br><br>
			
			<label for="dataOfficeHoursPolicy">Office Hours Policy: </label><br>
			<textarea name="dataOfficeHoursPolicy" required value="<?php if(!empty($_POST['dataOfficeHoursPolicy'])){ echo $contactInfo; } else { echo ''; } ?>"></textarea>
			<br><br>
			
			<label for="dataCourseDescription">Course Description: </label><br>
			<textarea name="dataCourseDescription" required value="<?php if(!empty($_POST['dataCourseDescription'])){ echo $courseDescription; } else { echo ''; } ?>"></textarea>
			<br><br>
			
			<label for="dataCourseGoals">Course Goals: </label><br>
			<textarea name="dataCourseGoals" required value="<?php if(!empty($_POST['dataCourseGoals'])){ echo $courseGoals; } else { echo ''; } ?>"></textarea>
			<br><br>
			
			<label for="dataRequiredMaterials">Required Materials: </label><br>
			<textarea name="dataRequiredMaterials" required value="<?php if(!empty($_POST['dataRequiredMaterials'])){ echo $reqMaterials; } else { echo ''; } ?>"></textarea>
			<br><br>
			
			<label for="dataGrading">Grading Policy: </label><br>
			<textarea name="dataGrading" required value="<?php if(!empty($_POST['dataGrading'])){ echo $gradingpolicy; } else { echo ''; } ?>"></textarea>
			<br><br>
			
			<label for="dataAttendance">Attendance Policy: </label><br>
			<textarea name="dataAttendance" required value="<?php if(!empty($_POST['dataAttendance'])){ echo $attendance; } else { echo ''; } ?>"></textarea>
			<br><br>
			
			<label for="dataUniversityPolicies">University Policies: </label><br>
			<textarea name="dataUniversityPolicies" required value="<?php if(!empty($_POST['dataUniversityPolicies'])){ echo $universityPolicies; } else { echo ''; } ?>"></textarea>
			<br><br>
			
			<label for="dataStudentResources">Student Resources: </label><br>
			<textarea name="dataStudentResources" required value="<?php if(!empty($_POST['dataStudentResources'])){ echo $studentResources; } else { echo ''; } ?>"></textarea>
			<br><br>
			<br>
			
			<button type="submit" name="submitData" value="✓">Create Syllabus</button>
			<br><br>
		</form>
		
		<span class="error"><?php if(!empty($error)) foreach($error as $e) echo $e . "<br>"; ?></span>
		<span class="success"><?php if(!empty($success)) foreach($success as $s) echo $s . "<br>"; ?></span>
	</div>
  </body>
</html>