<?php
    require_once( dirname(__FILE__, 3) . "\logic\Professor\Create_Syllabus_Methods.php");
?>

<html>
    <head>
        <title>Professor - Create Syllabus</title>
        <link rel="stylesheet" href="../StyleSheets/StyleSheet_Sidebar.css">
        <link rel="stylesheet" href="../StyleSheets/StyleSheet_Professor.css">
    </head>
    <body>
        <div class="sidebar">
            <a href="View_Data.php">View Questions</a>
            <a href="Add_Data.php">Add Questions</a>
            <a class="active" href="Create_Syllabus.php">Create Syllabus</a>
            <a href="Create_Course.php">Create a Course</a>
            <a href="View_Courses.php">View Created Courses</a>
            <a href="Student_Enrollment.php">Modify Student Enrollment</a>
            <a class="bottom" href="../../logic/Logout_User.php">Logout</a>
        </div>

        <div class="content">
            <h2>Create Syllabus</h2>

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

                <button type="submit" name="getSyllabus" value="✓">Get Course's Syllabus</button>


                <br><br>
                <?php
                // this displays the feedback from the logic method
                if (!empty($feedback["Feedback"])) {
                    echo("<span class=\"". $feedback["Outcome"] . "\">");
                    foreach($feedback["Feedback"] as $a) echo $a . "<br>";
                    echo("</span>");
                }
                ?>
                <br>

                <?php
                if (isset($syllabusArray)) {
                    echo ('<label for="courseTitle">Course Title: </label><br><textarea name="courseTitle" required>');
                    if(isset($syllabusArray['courseTitle']) && !empty($syllabusArray['courseTitle'])){ echo $syllabusArray['courseTitle']; } else { echo ''; }
                    echo ('</textarea><br><br>');


                    echo ('<label for="contactInfo">Contact Information: </label><br><textarea name="contactInfo" required>');
                    if(isset($syllabusArray['contactInformation']) && !empty($syllabusArray['contactInformation'])){ echo $syllabusArray['contactInformation']; } else { echo ''; }
                    echo ('</textarea><br><br>');


                    echo ('<label for="officeHours">Office Hours Policy: </label><br><textarea name="officeHours" required>');
                    if(isset($syllabusArray['officeHoursPolicy']) && !empty($syllabusArray['officeHoursPolicy'])){ echo $syllabusArray['officeHoursPolicy']; } else { echo ''; }
                    echo ('</textarea><br><br>');


                    echo ('<label for="courseDes">Course Description: </label><br><textarea name="courseDes" required>');
                    if(isset($syllabusArray['courseDescription']) && !empty($syllabusArray['courseDescription'])){ echo $syllabusArray['courseDescription']; } else { echo ''; }
                    echo ('</textarea><br><br>');


                    echo ('<label for="courseGoals">Course Goals: </label><br><textarea name="courseGoals" required>');
                    if(isset($syllabusArray['courseGoals']) && !empty($syllabusArray['courseGoals'])){ echo $syllabusArray['courseGoals']; } else { echo ''; }
                    echo ('</textarea><br><br>');


                    echo ('<label for="reqMaterials">Required Materials: </label><br><textarea name="reqMaterials" required>');
                    if(isset($syllabusArray['requiredMaterials']) && !empty($syllabusArray['requiredMaterials'])){ echo $syllabusArray['requiredMaterials']; } else { echo ''; }
                    echo ('</textarea><br><br>');


                    echo ('<label for="gradingPolicy">Grading Policy: </label><br><textarea name="gradingPolicy" required>');
                    if(isset($syllabusArray['gradingPolicy']) && !empty($syllabusArray['gradingPolicy'])){ echo $syllabusArray['gradingPolicy']; } else { echo ''; }
                    echo ('</textarea><br><br>');


                    echo ('<label for="attenPolicy">Attendance Policy: </label><br><textarea name="attenPolicy" required>');
                    if(isset($syllabusArray['attendancePolicy']) && !empty($syllabusArray['attendancePolicy'])){ echo $syllabusArray['attendancePolicy']; } else { echo ''; }
                    echo ('</textarea><br><br>');


                    echo ('<label for="uniPolicies">University Policies: </label><br><textarea name="uniPolicies" required>');
                    if(isset($syllabusArray['universityPolicy']) && !empty($syllabusArray['universityPolicy'])){ echo $syllabusArray['universityPolicy']; } else { echo ''; }
                    echo ('</textarea><br><br>');


                    echo ('<label for="stuResources">Student Resources: </label><br><textarea name="stuResources" required>');
                    if(isset($syllabusArray['studentResources']) && !empty($syllabusArray['studentResources'])){ echo $syllabusArray['studentResources']; } else { echo ''; }
                    echo ('</textarea><br><br>');

                    if (isset($syllabusArray['courseTitle'])){
                        echo('<button type="submit" name="updateSyllabus" value="✓">Update Syllabus</button><br><br>');
                        echo('<button type="submit" name="deleteSyllabus" value="✓">Delete Syllabus</button><br><br>');
                    } else {
                        echo('<button type="submit" name="submitSyllabus" value="✓">Create Syllabus</button><br><br>');
                    }
                }
                ?>

            </form>
        </div>
    </body>
</html>