<?php
    // this makes sure that all stored session values are kept
    session_start();

    // This includes the chatbot methods class.
    require_once( dirname(__FILE__, 3) . "\logic\Student\CourseQuestionsMethods.php");

    DefaultMethods::checkLogin("Student");
    $classList = DefaultMethods::getEnrolledCourses();

    // this handles calling the logic function and its return array
    if (!empty($_POST)) {
        $inputArray = array(
            "Selected Course" => ($_POST['selectedCourse'])
        );
        $questionList = CourseQuestionsMethods::attemptQuestionsPull($inputArray);

        $classList = DefaultMethods::getEnrolledCourses();
    }
    else {
        $feedback = array();
    }

    // this handles calling the logic function (which is currently useless)
    CourseQuestionsMethods::chatbot();

    // this then loads the presentation layer and it's required method class.
    require_once( dirname(__FILE__, 3) . "\presentation\PresentationMethods.php");
    require_once( dirname(__FILE__, 3) . "\presentation\Student\CourseQuestionsPresentation.php");
?>