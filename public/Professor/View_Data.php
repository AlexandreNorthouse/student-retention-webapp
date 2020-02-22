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
            <a class="active" href="View_Data.php">View Data</a>
            <a href="Add_Data.php">Add Questions</a>
            <a href="Create_Syllabus.php">Create Syllabus</a>
            <a href="Create_Course.php">Create a Course</a>
            <a class="bottom" href="../Logout_User.php">Logout</a>
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
                                echo ('<option value="' . $c['classID'] . '"');
                                // this is a variable instantiated in the required file
                                if ($_POST['courseID'] == $c['classID']) {
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
            </form>

            <?php
            // this prints out all the received questions in a table
                if (!empty($feedback)) {
                    echo '<p>Retrieved Data:</p>';
                    echo '<table>';
                        echo '<tr>';
                            echo '<th> Question Number</th>';
                            echo '<th> Question Text </th>';
                            echo '<th> Question Answer </th>';
                            echo '<th> Question Database Number</th>';
                        echo '</tr>';
                    for ($i = 0; $i < count($feedback); $i++) {
                        echo '<tr>';
                            echo '<td>#' . ($i + 1) . '</td>';
                            echo '<td>' . $feedback[$i]['qtext'] . '</td>';
                            echo '<td>' . $feedback[$i]['atext'] . '</td>';
                            echo '<td>#' . $feedback[$i]['quesID'] . '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                }
            ?>
        </div>
    </body>
</html>