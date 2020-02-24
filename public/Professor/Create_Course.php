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
            <a href="View_Data.php">View Data</a>
            <a href="Add_Data.php">Add Questions</a>
            <a href="Create_Syllabus.php">Create Syllabus</a>
            <a class="active" href="Create_Course.php">Create a Course</a>
            <a class="bottom" href="../../logic/Logout_User.php">Logout</a>
        </div>

        <div class="content">
            <h2>Create a Course</h2>

            <form action="" method="post">
                <label for="courseNumber">New Course ID: </label><br>
                <input type="text" name="courseNumber" placeholder="PSYC101" required
                    value="<?php if(!empty($_POST['courseNumber'])){echo $_POST['courseNumber'];} else {echo '';}?>"/>
                <br><br>

                <label for="courseSection">New Course Section: </label><br>
                <input type="number" name="courseSection" placeholder="1" required min=1 max=255
                    value="<?php if(!empty($_POST['courseSection'])){echo $_POST['courseSection'];} else {echo '';}?>"/>
                <br><br>

                <label for="courseName">New Course Name: </label><br>
                <input type="text" name="courseName" placeholder="Intro to Psychology, Section 1" required
                    value="<?php if(!empty($_POST['courseName'])){echo $_POST['courseName'];} else {echo '';}?>"/>
                <br><br>

                <button type="submit" name="submitClass" value="✓">Create New Course</button>
            </form>
            <br><br>

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