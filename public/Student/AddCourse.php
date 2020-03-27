<?php
    // this makes sure that all stored session values are kept
    session_start();

    // This includes the add course methods class.
    require_once( dirname(__FILE__, 3) . "\logic\Student\AddCourseMethods.php");

    DefaultMethods::checkLogin('Student');

    // this handles calling the logic function and its return array
    if (!empty($_POST)) {
        $inputArray = array(
            "Course Number" => ($_POST['selectedCourse']),
            "Student ID"    => ($_SESSION['userID'])
        );
        $feedback = AddCourseMethods::addCourse($inputArray);
    }
    else {
        $feedback = array();
    }

    // this then loads the presentation layer and it's required method class.
    require_once( dirname(__FILE__, 3) . "\presentation\PresentationMethods.php");
    require_once( dirname(__FILE__, 3) . "\presentation\Student\AddCoursePresentation.php");
?>