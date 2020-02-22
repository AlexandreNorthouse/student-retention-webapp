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
            <a href="View_Data.php">View Data</a>
            <a href="Add_Data.php">Add Questions</a>
            <a class="active" href="Create_Syllabus.php">Create Syllabus</a>
            <a href="Create_Course.php">Create a Course</a>
            <a class="bottom" href="../Logout_User.php">Logout</a>
        </div>

        <div class="content">
            <h2>Create Syllabus</h2>

            <form action="" method="post">
                <label for="courseID">Select Course: </label><br>
                <select name="courseID">
                    <?php
                    // this displays the currently enrolled classes
                        if (!empty($classList)){
                            foreach($classList as $c){
                                echo ('<option value="' . $c['classID'] . '"');
                                if ($_POST['courseID'] == $c['classID']) {
                                    echo (" selected ");
                                }
                                echo ('>' . $c['crseName'] . '</option>');
                            }
                        }
                    ?>
                </select>
                <br><br>

                <label for="courseTitle">Course Title: </label><br>
                <textarea name="courseTitle" required value="
                    <?php if(!empty($_POST['courseTitle'])){ echo $_POST['courseTitle']; } else { echo ''; } ?>">
                </textarea>
                <br><br>

                <label for="contactInfo">Contact Information: </label><br>
                <textarea name="contactInfo" required value="
                    <?php if(!empty($_POST['contactInfo'])){ echo $_POST['contactInfo']; } else { echo ''; } ?>">
                </textarea>
                <br><br>

                <label for="officeHours">Office Hours Policy: </label><br>
                <textarea name="officeHours" required value="
                    <?php if(!empty($_POST['officeHours'])){ echo $_POST['officeHours']; } else { echo ''; } ?>">
                </textarea>
                <br><br>

                <label for="courseDes">Course Description: </label><br>
                <textarea name="courseDes" required value="
                    <?php if(!empty($_POST['courseDes'])){ echo $_POST['courseDes']; } else { echo ''; } ?>">
                </textarea>
                <br><br>

                <label for="courseGoals">Course Goals: </label><br>
                <textarea name="courseGoals" required value="
                    <?php if(!empty($_POST['courseGoals'])){ echo $_POST['courseGoals']; } else { echo ''; } ?>">
                </textarea>
                <br><br>

                <label for="reqMaterials">Required Materials: </label><br>
                <textarea name="reqMaterials" required value="
                    <?php if(!empty($_POST['reqMaterials'])){ echo $_POST['reqMaterials']; } else { echo ''; } ?>">
                </textarea>
                <br><br>

                <label for="gradingPolicy">Grading Policy: </label><br>
                <textarea name="gradingPolicy" required value="
                    <?php if(!empty($_POST['gradingPolicy'])){ echo $_POST['gradingPolicy']; } else { echo ''; } ?>">
                </textarea>
                <br><br>

                <label for="attenPolicy">Attendance Policy: </label><br>
                <textarea name="attenPolicy" required value="
                    <?php if(!empty($_POST['attenPolicy'])){ echo $_POST['attenPolicy']; } else { echo ''; } ?>">
                </textarea>
                <br><br>

                <label for="uniPolicies">University Policies: </label><br>
                <textarea name="uniPolicies" required value="
                    <?php if(!empty($_POST['uniPolicies'])){ echo $_POST['uniPolicies']; } else { echo ''; } ?>">
                </textarea>
                <br><br>

                <label for="stuResources">Student Resources: </label><br>
                <textarea name="stuResources" required value="
                    <?php if(!empty($_POST['stuResources'])){ echo $_POST['stuResources']; } else { echo ''; } ?>">
                </textarea>
                <br><br>
                <br>

                <button type="submit" name="submitData" value="✓">Create Syllabus</button>
                <br><br>
            </form>

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