<html>
    <head>
        <title>Student - View Course Questions</title>
        <link rel="stylesheet" href="../../presentation/StyleSheets/StyleSheet_Sidebar.css">
        <link rel="stylesheet" href="../../presentation/StyleSheets/StyleSheet_Student.css">
    </head>
    <body>
        <div class="sidebar">
            <a class="active" href="CourseQuestions.php">View Course Questions</a>
            <a href="ViewEnrolledCourses.php">Manage Enrolled Courses</a>
            <a class="bottom" href="../../logic/LogoutUser.php">Logout</a>
        </div>

        <div class="content">
            <div class="title">
                <h2>View Course Questions</h2>
            </div>

            <br>
            <br>

            <form action="" method="post">
                <div class="single_form">
                    <?php if(!empty($classList)) echo(PresentationMethods::displayEnrolledCoursesTable($classList));?>
                </div>

                <br>
                <?php if (!empty($feedback)) echo(PresentationMethods::displayFeedback($feedback)) ?>
                <br>
            </form>

            <div class="action_result">
                <?php if (isset($questionList)) echo(PresentationMethods::displayEnrolledQuestions($questionList)); ?>
            </div>
        </div>
    </body>
</html>