<?php
    require_once( dirname(__FILE__, 3) . "\logic\Professor\View_Data_Methods.php");
?>

<html>
  <head>
	<title>Professor - View Data</title>
      <link rel="stylesheet" href="../StyleSheets/StyleSheet_Sidebar.css">
      <link rel="stylesheet" href="../StyleSheets/StyleSheet_Professor.css">
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
            if (!empty($feedback)) {
                echo '<p>Retrieved Data:</p>';
                echo '<table>';
                    echo '<tr>';
                        echo '<th> Question Number</th>';
                        echo '<th> Question Text </th>';
                        echo '<th> Question Answer </th>';
                        echo '<th> Question Database Number</th>';
                    echo '</tr>';
                for ($i = 0; $i < count($feedback); $i++)
                {
                    echo '<tr>';
                        echo '<td>#' . ($i + 1) . '</td>';
                        echo '<td>' . $feedback[$i]['qtext'] . '</td>';
                        echo '<td>' . $feedback[$i]['atext'] . '</td>';
                        echo '<td>#' . $feedback[$i]['quesID'] . '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            }
        ?>
    </div>
  </body>
</html>