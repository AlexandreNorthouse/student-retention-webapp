<html>
    <head>
        <title>Professor - Created Courses</title>
        <link rel="stylesheet" href="../../presentation/StyleSheets/StyleSheet_Sidebar.css">
        <link rel="stylesheet" href="../../presentation/StyleSheets/StyleSheet_Professor.css">
    </head>
    <body>
        <div class="sidebar">
            <a href="ViewData.php">View Questions</a>
            <a href="AddData.php">Add Questions</a>
            <a href="CreateSyllabus.php">Create Syllabus</a>
            <a href="CreateCourse.php">Create a Course</a>
            <a class="active" href="ViewCreatedCourses.php">View Created Courses</a>
            <a href="StudentEnrollment.php">Modify Student Enrollment</a>
            <a class="bottom" href="../../logic/LogoutUser.php">Logout</a>
        </div>

        <div class="content">
            <div class="title">
                <h2>Created Courses</h2>
            </div>

            <br>
            <?php if (!empty($feedback)) echo(PresentationMethods::displayFeedback($feedback)) ?>
            <br>

            <form action="" method="post">
                <div class="single_form">
                    <?php if (!empty($classList)) echo(PresentationMethods::displayCreatedCourses($classList)) ?>
                </div>
            </form>
        </div>
    </body>
</html>