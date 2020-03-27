<?php
    // this makes sure that all stored session values are kept
    session_start();

    // these include the database, default, page, and presentation classes
    require_once( dirname(__FILE__, 3) . "\logic\Database_Methods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Default_Methods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Professor\Create_Course_Methods.php");
    require_once( dirname(__FILE__, 3) . "\presentation\PresentationMethods.php");

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

    // this then loads the presentation layer
    require_once( dirname(__FILE__, 3) . "\presentation\Professor\Create_Course.php");
?>