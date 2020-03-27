<?php
    // this makes sure that all stored session values are kept
    session_start();

    // this includes the needed database and default methods
    require_once( dirname(__FILE__, 3) . "\logic\Database_Methods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Default_Methods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Student\View_Courses_Methods.php");
    require_once( dirname(__FILE__, 3) . "\presentation\PresentationMethods.php");

    DefaultMethods::checkLogin('Student');
    $classList = DefaultMethods::getEnrolledCourses("Professor Details");

    // this handles calling the logic function and its return array
    if (!empty($_POST)) {
        $inputArray = array(
            "Selected Course" => ($_POST['selectedCourse']),
            "Student ID" => ($_SESSION['userID'])
        );
        $feedback = ViewCoursesMethods::dropCourse($inputArray);
        $classList = DefaultMethods::getEnrolledCourses("Professor Details");
    } else {
        $feedback = array();
    }

    // this then loads the presentation layer
    require_once( dirname(__FILE__, 3) . "\presentation\Student\View_Courses.php");
?>