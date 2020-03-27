<?php
    // this makes sure that all stored session values are kept
    session_start();

    // This includes the add data methods class.
    require_once( dirname(__FILE__, 3) . "\logic\Professor\AddDataMethods.php");

    DefaultMethods::checkLogin("Professor");
    $classList = DefaultMethods::getEnrolledCourses();


    // this handles calling the logic function and its return array
    if (!empty($_POST)) {
        $inputArray = array(
            "Selected Course" => ($_POST['selectedCourse']),
            "Question"       => ($_POST['dataQuestion']),
            "Answer"         => ($_POST['dataAnswer'])
        );
        $feedback = AddDataMethods::addQuestion($inputArray);
    } else {
        $feedback = array();
    }

    // this then loads the presentation layer and it's required method class.
    require_once( dirname(__FILE__, 3) . "\presentation\PresentationMethods.php");
    require_once( dirname(__FILE__, 3) . "\presentation\Professor\AddDataPresentation.php");
?>