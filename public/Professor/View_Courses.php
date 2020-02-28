<?php
require_once( dirname(__FILE__, 3) . "\logic\Professor\View_Courses_Methods.php");
?>

<html>
    <head>
        <title>Professor - Created Courses</title>
        <link rel="stylesheet" href="../StyleSheets/StyleSheet_Sidebar.css">
        <link rel="stylesheet" href="../StyleSheets/StyleSheet_Professor.css">
    </head>
    <body>
        <div class="sidebar">
            <a href="View_Data.php">View Questions</a>
            <a href="Add_Data.php">Add Questions</a>
            <a href="Create_Syllabus.php">Create Syllabus</a>
            <a href="Create_Course.php">Create a Course</a>
            <a class="active" href="View_Courses.php">View Created Courses</a>
            <a href="Student_Enrollment.php">Modify Student Enrollment</a>
            <a class="bottom" href="../../logic/Logout_User.php">Logout</a>
        </div>

        <div class="content">
            <h2>Created Courses</h2>

            <?php
            // this prints the feedback array
            if (!empty($feedback["Feedback"])) {
                echo('<span class="'. $feedback["Outcome"] . '">');
                foreach($feedback["Feedback"] as $a) echo $a . "<br>";
                echo("</span>");
                echo("<br>");
            }
            ?>

            <form action="" method="post">
                <?php
                // this will print rows of courses: their name, professor, and the option to drop them.
                if (!empty($classList)){
                    echo("<table><tr><th>Course Name:</th><th>Course ID:</th><th>Delete Course:</th></tr>");
                    foreach($classList as $c){
                        echo("<tr><td>" . $c['crseName'] . "</td><td>" . $c['ID'] . "</td>");
                        echo("<td><button type='submit' name='selectedCourse' value='"
                            . $c['ID'] . "'>Delete Course</button></td></tr>");
                        echo("</div>");
                    }
                }
                ?>
            </form>
        </div>
    </body>
</html>