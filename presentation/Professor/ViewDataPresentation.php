<html>
    <head>
        <title>Professor - View Data</title>
        <link rel="stylesheet" href="../../presentation/StyleSheets/StyleSheet_Sidebar.css">
        <link rel="stylesheet" href="../../presentation/StyleSheets/StyleSheet_Professor.css">
    </head>
    <body>
        <div class="sidebar">
            <a class="active" href="ViewData.php">View Questions</a>
            <a href="AddData.php">Add Questions</a>
            <a href="CreateSyllabus.php">Manage Syllabus</a>
            <a href="ViewCreatedCourses.php">Manage Courses</a>
            <a href="StudentEnrollment.php">Manage Student Enrollment</a>
            <a class="bottom" href="../../logic/LogoutUser.php">Logout</a>
        </div>

        <div class="content">
            <div class="title">
                <h2>View Data</h2>
            </div>

            <br>
            <br>

            <form action="" method="post">
                <div class="select_course">
                    <?php if(!empty($classList)) echo(PresentationMethods::displayCurrentEnrolledCourses($classList));?>
                    <button type="submit" name="submitData" value="✓">View Course's Questions</button>
                </div>

                <br>
                <?php if (!empty($feedback)) echo(PresentationMethods::displayFeedback($feedback)) ?>
                <br>

                <div class="action_result">
                    <?php if (isset($questionList)) echo(PresentationMethods::displayCreatedQuestions($questionList)); ?>
                </div>
            </form>
        </div>
    </body>
</html>