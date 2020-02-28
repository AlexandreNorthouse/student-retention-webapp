<?php
    require_once( dirname(__FILE__, 3) . "\logic\Professor\Add_Data_Methods.php");
?>

<html>
    <head>
        <title>Professor - Add Data</title>
        <link rel="stylesheet" href="../StyleSheets/StyleSheet_Sidebar.css">
        <link rel="stylesheet" href="../StyleSheets/StyleSheet_Professor.css">
    </head>
    <body>
        <div class="sidebar">
            <a href="View_Data.php">View Questions</a>
            <a class="active" href="Add_Data.php">Add Questions</a>
            <a href="Create_Syllabus.php">Create Syllabus</a>
            <a href="Create_Course.php">Create a Course</a>
            <a href="View_Courses.php">View Created Courses</a>
            <a href="Student_Enrollment.php">Modify Student Enrollment</a>
            <a class="bottom" href="../../logic/Logout_User.php">Logout</a>
        </div>

        <div class="content">
            <h2>Add Question</h2>
            <form action="" method="post">
                <label for="courseID">Select Course: </label><br>
                <select name="courseID">
                    <?php
                    // this shows the currently enrolled courses
                    if (!empty($classList)){
                        foreach($classList as $c){
                            echo ('<option value="' . $c['ID'] . '"');
                            // this is a variable instantiated in the required file
                            if (isset($_POST['courseID']) && $_POST['courseID'] == $c['ID']) {
                                echo (" selected ");
                            }
                            echo ('>' . $c['crseName'] . '</option>');
                        }
                    }
                    ?>
                </select>
                <br><br>

                <label for="dataQuestion">Question: </label><br>
                <textarea name="dataQuestion" required><?php
                    if(!empty($_POST['dataQuestion'])){ echo $_POST['dataQuestion'];} else {echo '';}
                ?></textarea>
                <br><br>

                <label for="dataAnswer">Answer: </label><br>
                <textarea name="dataAnswer" required?<?php
                    if(!empty($_POST['dataAnswer'])){ echo $_POST['dataAnswer'];} else {echo '';} ?>
                "></textarea>
                <br><br>

                <button type="submit" name="submitData" value="✓">Create New Question</button>
            </form>
            <br><br>

            <?php
            // this displays the feedback from the logic method
            if (!empty($feedback["Feedback"])) {
                echo("<span class=\"". $feedback["Outcome"] . "\">");
                foreach($feedback["Feedback"] as $a) echo $a . "<br>";
                echo("</span>");
            }
            ?>
        </div>
    </body>
</html>