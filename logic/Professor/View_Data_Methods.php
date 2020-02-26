<?php
    // this makes sure that all stored session values are kept
    session_start();

    // this includes the needed database and default methods
    require_once( dirname(__FILE__, 3) . "\logic\Database_Methods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Default_Methods.php" );

    DefaultMethods::checkLogin("Professor");
    $classList = DefaultMethods::getEnrolledCourses();

    // this handles calling the logic function and its return array
    if (!empty($_POST)) {
        $inputArray = array(
            "Selected Course" => ($_POST['courseID'])
        );
        $feedback = ViewDataMethods::viewData($inputArray);
    } else {
        $feedback = array();
    }


    class ViewDataMethods {

        // main function called by presentation layer
        public static function viewData($inputArray): array
        {
            // this sets the variables needed for this method.
            $feedback = array();


            // this formats the fields, returns false if at least 1 field is empty
            $feedback = DefaultMethods::formatFields($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // attempts to get all the questions related to the course selected
            $feedback = ViewDataMethods::attemptQuestionsPull($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // if all went according to plan, it will return a success feedback
            return $feedback;
        }



        // Attempts to pull a courses' questions; returns array of questions on success, error array otherwise.
        public static function attemptQuestionsPull(array $inputArray): array
        {
            // sets variables for more legible variable names
            $courseID = $inputArray['Selected Course'];
            $questionsArray = DatabaseMethods::attemptQuestionsPull($courseID);

            // attempted insertion error code
            if (empty($questionsArray)) {
                $errorArray = array("It seems that course doesn't have any questions!");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }

            // attempted insertion success code
            return $questionsArray;
        }

    }

?>