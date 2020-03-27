<html>
    <head>
        <title>Student - View Course</title>
        <link rel="stylesheet" href="../../presentation/StyleSheets/StyleSheet_Sidebar.css">
        <link rel="stylesheet" href="../../presentation/StyleSheets/StyleSheet_Student.css">
    </head>
    <body>
        <div class="sidebar">
            <a href="Chatbot.php">Use the Chatbot</a>
            <a href="AddCourse.php">Enroll in a Course</a>
            <a class="active" href="ViewEnrolledCourses.php">View Enrolled Courses</a>
            <a class="bottom" href="../../logic/LogoutUser.php">Logout</a>
        </div>

        <div class="content">
            <div class="title">
                <h2>View Course</h2>
            </div>

            <br>
            <?php if (!empty($feedback)) echo(PresentationMethods::displayFeedback($feedback)) ?>
            <br>

            <form action="" method="post">
                <div class="single_form">
                    <?php if (!empty($classList)) echo(PresentationMethods::displayEnrolledCourses($classList)) ?>
                </div>
            </form>
        </div>
    </body>
</html>