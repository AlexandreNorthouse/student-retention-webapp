<?php
    require_once( dirname(__FILE__, 3) . "\logic\Professor\Add_Data_Methods.php");
?>

<html>
  <head>
	<title>Professor - Add Data</title>
      <link rel="stylesheet" href="../StyleSheets/StyleSheet_Sidebar.css">
      <link rel="stylesheet" href="../StyleSheets/StyleSheet_Professor.css">
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
                // this displays the enrolled courses in a dropdown menu
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
			
			<label for="dataQuestion">Question: </label><br>
			<textarea name="dataQuestion" required value="<?php if(!empty($_POST['dataQuestion'])){ echo $_POST['dataQuestion']; } else { echo ''; } ?>"></textarea>
			<br><br>
			
			<label for="dataAnswer">Answer: </label><br>
			<textarea name="dataAnswer" required value="<?php if(!empty($_POST['dataAnswer'])){ echo $_POST['dataAnswer']; } else { echo ''; } ?>"/></textarea>
			<br><br>
			
			<button type="submit" name="submitData" value="✓">Create New Question</button>
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