<?php
    // this makes sure that all stored session values are kept
    session_start();

    // these include the database, default, page, and presentation classes
    require_once( dirname(__FILE__, 3) . "\logic\Database_Methods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Default_Methods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Professor\Add_Data_Methods.php");
    require_once( dirname(__FILE__, 3) . "\presentation\PresentationMethods.php");

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

    // this then loads the presentation layer
    require_once( dirname(__FILE__, 3) . "\presentation\Professor\Add_Data.php");
?>