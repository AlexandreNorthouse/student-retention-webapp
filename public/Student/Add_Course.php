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
            <a href="Chatbot.php">Use the Chatbot</a>
            <a class="active" href="Add_Course.php">Enroll in a Course</a>
            <a href="View_Courses.php">View Enrolled Courses</a>
            <a class="bottom" href="../../logic/Logout_User.php">Logout</a>
        </div>

        <div class="content">
            <h2>Add Course</h2>
            <form action="" method="post">
                <label for="courseNumber">Course Number: </label><br>
                <input type="number" name="courseNumber" required min=1 max=99999999999 value="
                    <?php if(!empty($_POST['courseNumber'])){ echo $_POST['courseNumber']; } else { echo ''; } ?>"/>
                <br><br>

                <button type="submit" name="submit" value="✓">Submit</button>
                <br><br>
            </form>

            <?php
            // this prints the feedback array
            if (!empty($feedback["Feedback"])) {
                echo("<span class=\"". $feedback["Outcome"] . "\">");
                foreach($feedback["Feedback"] as $a) echo $a . "<br>";
                echo("</span>");
            }
            ?>
        </div>
    </body>
</html>