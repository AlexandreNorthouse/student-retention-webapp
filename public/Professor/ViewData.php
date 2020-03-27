<?php
    // this makes sure that all stored session values are kept
    session_start();

    // This includes the view data methods class.
    require_once( dirname(__FILE__, 3) . "\logic\Professor\ViewDataMethods.php");

    DefaultMethods::checkLogin("Professor");
    $classList = DefaultMethods::getEnrolledCourses();

    // this handles calling the logic function and its return array
    if (!empty($_POST['submitData']) || !empty($_POST['editQuestion'])) {
        $inputArray = array(
            "Selected Course" => ($_POST['selectedCourse'])
        );
        $questionList = ViewDataMethods::viewData($inputArray);


    }
    else if (!empty($_POST['submitUpdate'])) {
        $inputArray = array(
            "Selected Course"   => ($_POST['selectedCourse']),
            "Selected Question" => ($_POST['submitUpdate']),
            "Update Question" => ($_POST['updateQuestion']),
            "Update Answer" => ($_POST['updateAnswer'])
        );
        $feedback = ViewDataMethods::updateData($inputArray);
        $questionList = ViewDataMethods::viewData($inputArray);


    }
    else if (!empty($_POST['deleteQuestion'])) {
        $inputArray = array(
            "Selected Course"   => ($_POST['selectedCourse']),
            "Selected Question" => ($_POST['deleteQuestion'])
        );
        $feedback = ViewDataMethods::attemptDataDelete($inputArray);
        $questionList = ViewDataMethods::viewData($inputArray);


    }
    else {
        $feedback = array();
        $questionList = array();
    }

    // this then loads the presentation layer and it's required method class.
    require_once( dirname(__FILE__, 3) . "\presentation\PresentationMethods.php");
    require_once( dirname(__FILE__, 3) . "\presentation\Professor\ViewDataPresentation.php");
?>