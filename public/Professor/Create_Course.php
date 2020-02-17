<?php
    require_once( dirname(__FILE__, 3) . "\logic\Professor\Create_Course_Methods.php");
?>

<html>
  <head>
	<title>Professor - Create Course</title>
      <link rel="stylesheet" href="../StyleSheets/StyleSheet_Sidebar.css">
      <link rel="stylesheet" href="../StyleSheets/StyleSheet_Professor.css">
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