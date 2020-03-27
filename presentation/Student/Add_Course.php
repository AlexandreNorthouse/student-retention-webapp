<html>
    <head>
        <title>Student - Add Course</title>
        <link rel="stylesheet" href="../../presentation/StyleSheets/StyleSheet_Sidebar.css">
        <link rel="stylesheet" href="../../presentation/StyleSheets/StyleSheet_Student.css">
    </head>
    <body>
        <div class="sidebar">
            <a href="Chatbot.php">Use the Chatbot</a>
            <a class="active" href="AddCourse.php">Enroll in a Course</a>
            <a href="ViewCourses.php">View Enrolled Courses</a>
            <a class="bottom" href="../../logic/Logout_User.php">Logout</a>
        </div>

        <div class="content">
            <div class="title">
                <h2>Add Course</h2>
            </div>

            <br>
            <br>

            <form action="" method="post">
                <div class="single_form">
                    <label for="selectedCourse">Course Number: </label><br>
                    <input type="number" name="selectedCourse" required min=1 max=99999999999
                           value="<?php echo(PresentationMethods::displayPostValue("selectedCourse")) ?>"/>
                    <br><br>
                    <button type="submit" name="submit" value="✓">Submit</button>
                </div>
            </form>

            <br>
            <?php if (!empty($feedback)) echo(PresentationMethods::displayFeedback($feedback)) ?>
            <br>
        </div>
    </body>
</html>