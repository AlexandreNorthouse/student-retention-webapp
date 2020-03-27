<html>
    <head>
        <title>Professor - Add Data</title>
        <link rel="stylesheet" href="../../presentation/StyleSheets/StyleSheet_Sidebar.css">
        <link rel="stylesheet" href="../../presentation/StyleSheets/StyleSheet_Professor.css">
    </head>
    <body>
        <div class="sidebar">
            <a href="ViewData.php">View Questions</a>
            <a class="active" href="AddData.php">Add Questions</a>
            <a href="CreateSyllabus.php">Create Syllabus</a>
            <a href="CreateCourse.php">Create a Course</a>
            <a href="ViewCourses.php">View Created Courses</a>
            <a href="StudentEnrollment.php">Modify Student Enrollment</a>
            <a class="bottom" href="../../logic/Logout_User.php">Logout</a>
        </div>

        <div class="content">
            <div class="title">
                <h2>Add Question</h2>
            </div>

            <br>
            <br>

            <form action="" method="post">
                <div class="single_form">
                    <?php if (!empty($classList)) echo(PresentationMethods::displayCurrentEnrolledCourses($classList)); ?>
                    <br><br>

                    <label for="dataQuestion">Question: </label><br>
                    <textarea name="dataQuestion" required><?php
                        echo(PresentationMethods::displayPostValue("dataQuestion"))
                    ?></textarea>
                    <br><br>

                    <label for="dataAnswer">Answer: </label><br>
                    <textarea name="dataAnswer" required><?php
                        echo(PresentationMethods::displayPostValue("dataAnswer"))
                    ?></textarea>
                    <br><br>

                    <button type="submit" name="submitData" value="✓">Create New Question</button>
                </div>
            </form>
            <br>

            <br>
            <?php if (!empty($feedback)) echo(PresentationMethods::displayFeedback($feedback)) ?>
            <br>
        </div>
    </body>
</html>