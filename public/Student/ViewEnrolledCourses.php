<?php
    // this makes sure that all stored session values are kept
    session_start();

    // This includes the view enrolled courses methods class.
    require_once( dirname(__FILE__, 3) . "\logic\Student\ViewEnrolledCoursesMethods.php");

    DefaultMethods::checkLogin('Student');
    $classList = DefaultMethods::getEnrolledCourses("Professor Details");

    // this handles calling the logic function and its return array
    if (!empty($_POST)) {
        $inputArray = array(
            "Selected Course" => ($_POST['selectedCourse']),
            "Student ID" => ($_SESSION['userID'])
        );
        $feedback = ViewEnrolledCoursesMethods::dropCourse($inputArray);
        $classList = DefaultMethods::getEnrolledCourses("Professor Details");
    }
    else {
        $feedback = array();
    }

    // this then loads the presentation layer and it's required method class.
    require_once( dirname(__FILE__, 3) . "\presentation\PresentationMethods.php");
    require_once( dirname(__FILE__, 3) . "\presentation\Student\ViewEnrolledCoursesPresentation.php");
?>