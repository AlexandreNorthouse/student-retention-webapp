<?php
    // this makes sure that all stored session values are kept
    session_start();

    // This includes the view created courses methods class.
    require_once( dirname(__FILE__, 3) . "\logic\Professor\ViewCreatedCoursesMethods.php");

    DefaultMethods::checkLogin('Professor');
    $classList = DefaultMethods::getEnrolledCourses();

    // this handles calling the logic function and its return array
    if (!empty($_POST)) {
        $inputArray = array(
            "Selected Course" => ($_POST['selectedCourse']),
            "Professor ID" => ($_SESSION['userID'])
        );
        $feedback = ViewCreatedCoursesMethods::deleteCourse($inputArray);
        $classList = DefaultMethods::getEnrolledCourses("Professor Details");
    }
    else {
        $feedback = array();
    }

    // this then loads the presentation layer and it's required method class.
    require_once( dirname(__FILE__, 3) . "\presentation\PresentationMethods.php");
    require_once( dirname(__FILE__, 3) . "\presentation\Professor\ViewCreatedCoursesPresentation.php");
?>