<?php
    require_once( dirname(__FILE__, 3) . "\logic\Professor\Student_Enrollment_Methods.php");
?>

<html>
    <head>
        <title>Professor - Modify Student Enrollment</title>
        <link rel="stylesheet" href="../StyleSheets/StyleSheet_Sidebar.css">
        <link rel="stylesheet" href="../StyleSheets/StyleSheet_Professor.css">
    </head>
    <body>
        <div class="sidebar">
            <a href="View_Data.php">View Questions</a>
            <a href="Add_Data.php">Add Questions</a>
            <a href="Create_Syllabus.php">Create Syllabus</a>
            <a href="Create_Course.php">Create a Course</a>
            <a href="View_Courses.php">View Created Courses</a>
            <a class="active" href="Student_Enrollment.php">Modify Student Enrollment</a>
            <a class="bottom" href="../../logic/Logout_User.php">Logout</a>
        </div>

        <div class="content">
            <h2>Modify Student Enrollment</h2>

            <form action="" method="post">
                <label for="selectedCourse">Select Course: </label><br>
                <select name="selectedCourse">
                    <?php
                    // this shows the currently enrolled courses
                    if (!empty($classList)){
                        foreach($classList as $c){
                            echo ('<option value="' . $c['ID'] . '"');
                            // this is a variable instantiated in the required file
                            if (isset($_POST['selectedCourse']) && $_POST['selectedCourse'] == $c['ID']) {
                                echo (" selected ");
                            }
                            echo ('>' . $c['crseName'] . '</option>');
                        }
                    }
                    ?>
                </select>
                <br><br>

                <button type="submit" name="getEnrollment" value="✓">View Course's Enrollment</button>
                <br><br>


                <?php
                // this prints the feedback array
                if (!empty($feedback["Feedback"])) {
                    echo('<span class="'. $feedback["Outcome"] . '">');
                    foreach($feedback["Feedback"] as $a) echo $a . "<br>";
                    echo("</span>");
                    echo("<br>");
                }
                ?>


                <?php
                // this will print rows of courses: their name, professor, and the option to drop them.
                if (!empty($studentList[0])){
                    echo("<table><tr><th>Student Lasts Name:</th><th>Student First Name:</th><th>Remove Student:</th></tr>");
                    foreach($studentList as $f){
                        echo("<tr><td>" . $f['fname'] . "</td><td>" . $f['lname'] . "</td>");
                        echo("<td><button type='submit' name='selectedStudent' value='"
                            . $f['ID'] . "'> Drop Course</button></td></tr>");
                        echo("</div>");
                    }
                } else if (!empty($studentList["Outcome"])){
                    echo('<span class="'. $studentList["Outcome"] . '">');
                    foreach($studentList["Feedback"] as $a) echo $a . "<br>";
                    echo("</span>");
                    echo("<br>");
                }
                ?>
            </form>
        </div>
    </body>
</html>