<?php
    // this makes sure that all stored session values are kept
    session_start();

    // these include the database, default, page, and presentation classes
    require_once( dirname(__FILE__, 3) . "\logic\Database_Methods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Default_Methods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Professor\View_Data_Methods.php");
    require_once( dirname(__FILE__, 3) . "\presentation\PresentationMethods.php");

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

    // this then loads the presentation layer
    require_once( dirname(__FILE__, 3) . "\presentation\Professor\View_Data.php");
?>