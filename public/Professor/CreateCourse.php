<?php
    // this makes sure that all stored session values are kept
    session_start();

    // This includes the create course methods class.
    require_once( dirname(__FILE__, 3) . "\logic\Professor\CreateCourseMethods.php");

    DefaultMethods::checkLogin("Professor");

    // this handles calling the logic function and its return array
    if (!empty($_POST)) {
        $inputArray = array(
            "University ID" => ($_SESSION['uniID']),
            "Course Number" => ($_POST['courseNumber']),
            "Course Section" => ($_POST['courseSection']),
            "Course Name" => ($_POST['courseName']),
            "Professor ID" => ($_SESSION['userID'])
        );
        $feedback = CreateCourseMethods::createCourse($inputArray);
    } else {
        $feedback = array();
    }

    // this then loads the presentation layer and it's required method class.
    require_once( dirname(__FILE__, 3) . "\presentation\PresentationMethods.php");
    require_once( dirname(__FILE__, 3) . "\presentation\Professor\CreateCoursePresentation.php");
?>