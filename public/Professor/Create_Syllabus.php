<?php
    require_once( dirname(__FILE__, 3) . "\logic\Professor\Create_Syllabus_Methods.php");
?>

<html>
  <head>
	<title>Professor - Create Syllabus</title>
      <link rel="stylesheet" href="../StyleSheets/StyleSheet_Sidebar.css">
      <link rel="stylesheet" href="../StyleSheets/StyleSheet_Professor.css">
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
							if ($_POST['dataClassID'] == $c['classID']) {
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

        <?php
        // this displays the feedback from the logic method
        if (!empty($feedback["Feedback"])) {
            echo("<span class=\"". $feedback["Outcome"] . "\">");
            foreach($feedback["Feedback"] as $a) echo $a . "<br>";
            echo("</span>");
        }
        ?>
    </div>
  </body>
</html>