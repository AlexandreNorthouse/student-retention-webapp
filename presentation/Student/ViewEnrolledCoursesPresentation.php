<html>
    <head>
        <title>Student - Manage Courses</title>
        <link rel="stylesheet" href="../../presentation/StyleSheets/StyleSheet_Sidebar.css">
        <link rel="stylesheet" href="../../presentation/StyleSheets/StyleSheet_Student.css">
    </head>
    <body>
        <div class="sidebar">
            <a href="CourseQuestions.php">View Course Questions</a>
            <a class="active" href="ViewEnrolledCourses.php">Manage Enrolled Courses</a>
            <a class="bottom" href="../../logic/LogoutUser.php">Logout</a>
        </div>

        <div class="content">
            <div class="title">
                <h2>Manage Courses</h2>
            </div>

            <br>
            <?php if (!empty($feedback)) echo(PresentationMethods::displayFeedback($feedback)) ?>
            <br>

            <form action="" method="post">
                <div class="single_form">
                    <div><h3>Add a Course:</h3></div>
                    <label for="enrollCourse">Course Number: </label><br>
                    <input type="number" name="enrollCourse" required min=1 max=99999999999
                           value="<?php echo(PresentationMethods::displayPostValue("enrollCourse")) ?>"/>
                    <br><br>
                    <button type="submit" name="enrollInCourse" value="✓">Submit</button>
                </div>
            </form>

            <form action="" method="post">
                <div class="action_result">
                    <?php if (!empty($classList)) echo(PresentationMethods::displayEnrolledCourses($classList)) ?>
                </div>
            </form>
        </div>
    </body>
</html>