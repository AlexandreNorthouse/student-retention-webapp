<?php
    // this makes sure that all stored session values are kept
    session_start();

    // this includes the needed database and default methods
    require_once( dirname(__FILE__, 3) . "\logic\Database_Methods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Default_Methods.php" );

    $classList = DefaultMethods::getEnrolledCourses();

    // this handles calling the logic function and its return array
    if (!empty($_POST)) {
        $feedback = ViewDataMethods::viewData();
    } else {
        $feedback = array();
    }


    class ViewDataMethods {

        // main function called by presentation layer
        public static function viewData(): array
        {
            DefaultMethods::checkLogin('Professor');


            // this sets the variables needed for this method.
            $feedback = array();
            $inputArray = array(
                "Selected Course" => ($_POST['dataClassID'])
            );


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



        // [description of what the method does]
        private static function attemptQuestionsPull(array $inputArray): array
        {
            // sets variables for more legible variable names
            $courseNumber = $inputArray['Selected Course'];
            $questionsArray = DatabaseMethods::attemptQuestionsPull($courseNumber);

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