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
	$username = $_SESSION['username'];
	
	// this is so the section object can be created
	$query = "SELECT Class.classID, Class.crseID, Class.sectNum, Class.crseName FROM Class, ClassUserRoster WHERE ClassUserRoster.classID=Class.classID AND ClassUserRoster.username='$username'";
	$sql = $conn->prepare($query);
	$sql->execute();
	$classList = $sql->fetchAll();
	
	
	// This handles the "Submit New Question" button being hit
	if (!empty($_POST) && !empty($_POST['submitData'])){
		$selectedClass = $_POST['dataClassID'];
		
		
		$query = "SELECT Question.quesID, Question.qtext, Question.atext FROM Question, ClassQuestions WHERE ClassQuestions.classID=$selectedClass";
		$sql = $conn->prepare($query);
		$sql->execute();
		$results = $sql->fetchAll();
	
	} else {
		$selectedClass = 0;
		$results = [];
	}
?>



<html>
  <head>
	<title>Professor - View Data</title>
	<link rel="stylesheet" href="StyleSheet_Sidebar.css">
	<link rel="stylesheet" href="StyleSheet_Professor.css">
  </head>
  
  
  <body>
  	<div class="sidebar">
	  <a class="active" href="prof-viewData.php">View Data</a>
	  <a href="prof-addData.php">Add Questions</a>
	  <a href="prof-createSyllabus.php">Create Syllabus</a>
	  <a href="prof-createCourse.php">Create a Course</a>
	  <a class="bottom" href="user-logout.php">Logout</a>
	</div>
	
	<div class="content">
		<h2>View Data</h2>
		
		
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
			
			<button type="submit" name="submitData" value="✓">View Course's Data</button>
			<br><br>
		</form>
		
	
	<?php
		if (!empty($results)) {
			echo '<p>Retrieved Data:</p>';
			echo '<table>';
			for ($i = 0; $i < count($results); $i+=2)
			{	
				echo '<tr>';
					echo '<th> Question Database Number</th>';
					echo '<th> Question Text </th>';
					echo '<th> Question Answer </th>';
				echo '</tr>';
				echo '<tr>';
					echo '<td>#' . $results[$i]['quesID'] . '</td>';
					echo '<td>' . $results[$i]['qtext'] . '</td>';
					echo '<td>' . $results[$i]['atext'] . '</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
	?>
		
		
	</div>
  </body>
</html>