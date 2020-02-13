<?php
	require_once( dirname(__FILE__, 3) . "\logic\Student\Add_Course_Methods.php");
?>

<html>
  <head>
	<title>Student - Add Course</title>
	<link rel="stylesheet" href="../StyleSheets/StyleSheet_Sidebar.css">
	<link rel="stylesheet" href="../StyleSheets/StyleSheet_Student.css">
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
		
		<?php
			if (!empty($feedback["Feedback"])) {
				echo("<span class=\"". $feedback["Status"] . "\">");
				foreach($feedback["Feedback"] as $a) echo $a . "<br>";
				echo("</span>");
			}
		?>
	</div>
  </body>
</html>