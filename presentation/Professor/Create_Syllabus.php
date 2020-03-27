<html>
    <head>
        <title>Professor - Create Syllabus</title>
        <link rel="stylesheet" href="../../presentation/StyleSheets/StyleSheet_Sidebar.css">
        <link rel="stylesheet" href="../../presentation/StyleSheets/StyleSheet_Professor.css">
    </head>
    <body>
        <div class="sidebar">
            <a href="ViewData.php">View Questions</a>
            <a href="AddData.php">Add Questions</a>
            <a class="active" href="CreateSyllabus.php">Create Syllabus</a>
            <a href="CreateCourse.php">Create a Course</a>
            <a href="ViewCourses.php">View Created Courses</a>
            <a href="StudentEnrollment.php">Modify Student Enrollment</a>
            <a class="bottom" href="../../logic/Logout_User.php">Logout</a>
        </div>

        <div class="content">
            <div class="title">
            <h2>Create Syllabus</h2>
            </div>

            <br>
            <br>

            <form action="" method="post">
                <div class="select_course">
                    <?php if (!empty($classList)) echo(PresentationMethods::displayCurrentEnrolledCourses($classList)); ?>
                    <button type="submit" name="getSyllabus" value="✓">Get Course's Syllabus</button>
                </div>

                <br>
                <?php if (!empty($feedback)) echo(PresentationMethods::displayFeedback($feedback)) ?>
                <br>

                <div class="action_result">
                    <?php if (isset($syllabusArray)) echo PresentationMethods::displaySyllabusCreation($syllabusArray); ?>
                </div>
            </form>
        </div>
    </body>
</html>