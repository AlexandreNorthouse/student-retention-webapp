<?php
    require_once( dirname(__FILE__, 3) . "\logic\Student\View_Courses_Methods.php");
?>

<html>
    <head>
        <title>Student - View Course</title>
        <link rel="stylesheet" href="../StyleSheets/StyleSheet_Sidebar.css">
        <link rel="stylesheet" href="../StyleSheets/StyleSheet_Student.css">
    </head>
    <body>
        <div class="sidebar">
            <a href="Chatbot.php">Use the Chatbot</a>
            <a href="Add_Course.php">Enroll in a Course</a>
            <a class="active" href="View_Courses.php">View Enrolled Courses</a>
            <a class="bottom" href="../../logic/Logout_User.php">Logout</a>
        </div>

        <div class="content">
            <h2>View Course</h2>

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
                    echo("<table><tr><th> Course Name:</th><th> Course Professor:</th><th>Drop Course:</th></tr>");
                    foreach($classList as $c){
                        echo("<tr><td>" . $c['crseName'] . "</td><td>" . $c['fname'] . " " . $c['lname'] . "</td>");
                        echo("<td><button type='submit' name='selectedCourse' value='"
                                . $c['ID'] . "'> Drop Course</button></td></tr>");
                        echo("</div>");
                    }
                }
                ?>
            </form>
        </div>
    </body>
</html>