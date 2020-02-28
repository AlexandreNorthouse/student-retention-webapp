<?php
    require_once( dirname(__FILE__, 3) . "\logic\Professor\View_Data_Methods.php");
?>

<html>
    <head>
        <title>Professor - View Data</title>
        <link rel="stylesheet" href="../StyleSheets/StyleSheet_Sidebar.css">
        <link rel="stylesheet" href="../StyleSheets/StyleSheet_Professor.css">
    </head>
    <body>
        <div class="sidebar">
            <a class="active" href="View_Data.php">View Questions</a>
            <a href="Add_Data.php">Add Questions</a>
            <a href="Create_Syllabus.php">Create Syllabus</a>
            <a href="Create_Course.php">Create a Course</a>
            <a href="View_Courses.php">View Created Courses</a>
            <a href="Student_Enrollment.php">Modify Student Enrollment</a>
            <a class="bottom" href="../../logic/Logout_User.php">Logout</a>
        </div>

        <div class="content">
            <h2>View Data</h2>

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

                <button type="submit" name="submitData" value="✓">View Course's Data</button>
                <br><br>


                <?php
                // this prints the feedback array
                if (isset($feedback["Feedback"]) && !empty($feedback["Feedback"])) {
                    echo('<span class="'. $feedback["Outcome"] . '">');
                    foreach($feedback["Feedback"] as $a) echo $a . "<br>";
                    echo("</span>");
                    echo("<br>");
                }
                ?>


                <?php
                // this prints out all the received questions in a table if they exist, otherwise displays the error code
                if (!empty($questionList[0])) {
                    echo '<p>Retrieved Questions:</p>';
                    echo '<table><tr><th>Question Number</th><th>Question Text</th><th>Question Answer</th>';
                    echo '<th>Edit Question</th><th>Delete Question</th></tr>';
                    for ($i = 0; $i < count($questionList); $i++) {
                        if (isset($_POST["editQuestion"]) && $_POST["editQuestion"] == $questionList[$i]['ID']) {
                            echo '<tr><td>#' . ($i + 1) . '</td>';
                            echo '<td><textarea name="updateQuestion" required>' . $questionList[$i]['qtext'] . '</textarea></td>';
                            echo '<td><textarea name="updateAnswer" required>' . $questionList[$i]['atext'] . '</textarea></td>';
                            echo "<td><button type='submit' name='submitUpdate' value='"
                                . $questionList[$i]['ID'] . "'>Submit Edit</button></td>";
                            echo "<td><button type='submit' name='deleteQuestion' value='"
                                . $questionList[$i]['ID'] . "'>Delete Question</button></td>";
                            echo '</tr>';
                        } else {
                            echo '<tr><td>#' . ($i + 1) . '</td>';
                            echo '<td>' . $questionList[$i]['qtext'] . '</td>';
                            echo '<td>' . $questionList[$i]['atext'] . '</td>';
                            echo "<td><button type='submit' name='editQuestion' value='"
                                . $questionList[$i]['ID'] . "'>Edit Question</button></td>";
                            echo "<td><button type='submit' name='deleteQuestion' value='"
                                . $questionList[$i]['ID'] . "'>Delete Question</button></td>";
                            echo '</tr>';
                        }
                    }
                    echo '</table>';
                } else if (!empty($questionList['Outcome'])){
                    echo("<span class=\"". $questionList["Outcome"] . "\">");
                    foreach($questionList["Feedback"] as $a) echo $a . "<br>";
                    echo("</span>");
                }
                ?>
            </form>
        </div>
    </body>
</html>