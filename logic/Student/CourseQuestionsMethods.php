<?php
    require_once( dirname(__FILE__, 3) . "\logic\DatabaseMethods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\DefaultMethods.php" );

    class CourseQuestionsMethods {
        // main block of code for running the presentation layer
        public static function chatbot()
        {
            // no code needed.
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