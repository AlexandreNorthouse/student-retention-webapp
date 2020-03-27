<?php
    // this makes sure that all stored session values are kept
    session_start();

    // these include the database, default, page, and presentation classes
    require_once( dirname(__FILE__, 3) . "\logic\Database_Methods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Default_Methods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Student\Add_Course_Methods.php");
    require_once( dirname(__FILE__, 3) . "\presentation\PresentationMethods.php");

    DefaultMethods::checkLogin('Student');

    // this handles calling the logic function and its return array
    if (!empty($_POST)) {
        $inputArray = array(
            "Course Number" => ($_POST['selectedCourse']),
            "Student ID"    => ($_SESSION['userID'])
        );
        $feedback = AddCourseMethods::addCourse($inputArray);
    } else {
        $feedback = array();
    }

    // this then loads the presentation layer
    require_once( dirname(__FILE__, 3) . "\presentation\Student\Add_Course.php");
?>