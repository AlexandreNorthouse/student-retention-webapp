<?php
    require_once( dirname(__FILE__, 3) . "\logic\Student\View_Courses_Methods.php");
?>

<html>
    <head>
        <title>Student - Drop Course</title>
        <link rel="stylesheet" href="StyleSheet_Sidebar.css">
        <link rel="stylesheet" href="StyleSheet_Student.css">
    </head>
    <body>
        <div class="sidebar">
            <a href="stu-chatbot.php">Use the Chatbot</a>
            <a href="stu-addCourse.php">Add a Class</a>
            <a class="active" href="stu-addCourse.php">Drop a Class</a><!--needs a different href-->
            <a class="bottom" href="user-logout.php">Logout</a>
        </div>

        <div class="content">
            <h2>Drop Course</h2>
            <form action="" method="post">
                <label for="courseNumber">Course Number: </label><br>
                <input type="number" name="courseNumber" required min=1 max=99999999999 value="
                    <?php if(!empty($_POST['courseNumber'])){ echo $_POST['courseNumber']; } else { echo ''; } ?>"/><br><br>
                <button type="submit" name="submit" value="✓">Submit</button>
                <br><br>
            </form>

            <?php
            // this prints the feedback array
            if (!empty($feedback["Feedback"])) {
                echo("<span class=\"". $feedback["Status"] . "\">");
                foreach($feedback["Feedback"] as $a) echo $a . "<br>";
                echo("</span>");
            }
            ?>
        </div>
    </body>
</html>