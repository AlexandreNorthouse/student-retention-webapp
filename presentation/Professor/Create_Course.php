<html>
    <head>
        <title>Professor - Create Course</title>
        <link rel="stylesheet" href="../../presentation/StyleSheets/StyleSheet_Sidebar.css">
        <link rel="stylesheet" href="../../presentation/StyleSheets/StyleSheet_Professor.css">
    </head>
    <body>
        <div class="sidebar">
            <a href="ViewData.php">View Questions</a>
            <a href="AddData.php">Add Questions</a>
            <a href="CreateSyllabus.php">Create Syllabus</a>
            <a class="active" href="CreateCourse.php">Create a Course</a>
            <a href="ViewCourses.php">View Created Courses</a>
            <a href="StudentEnrollment.php">Modify Student Enrollment</a>
            <a class="bottom" href="../../logic/Logout_User.php">Logout</a>
        </div>

        <div class="content">
            <div class="title">
                <h2>Create a Course</h2>
            </div>

            <br>
            <br>

            <form action="" method="post">
                <div class="single_form">
                    <label for="courseNumber">New Course ID: </label><br>
                    <input type="text" name="courseNumber" placeholder="Ex: ''PSYC101''" required
                           value="<?php echo(PresentationMethods::displayPostValue("courseNumber")) ?>"/>
                    <br><br>

                    <label for="courseSection">New Course Section: </label><br>
                    <input type="number" name="courseSection" placeholder="Ex: ''1''" required min=1 max=255
                           value="<?php echo(PresentationMethods::displayPostValue("courseSection")) ?>"/>
                    <br><br>

                    <label for="courseName">New Course Name: </label><br>
                    <input type="text" name="courseName" placeholder="Ex: ''Intro to Psychology, Section 1''" required
                           value="<?php echo(PresentationMethods::displayPostValue("courseName")) ?>"/>
                    <br><br>

                    <button type="submit" name="submitClass" value="✓">Create New Course</button>
                </div>
            </form>

            <br>
            <?php if (!empty($feedback)) echo(PresentationMethods::displayFeedback($feedback)) ?>
            <br>
        </div>
    </body>
</html>