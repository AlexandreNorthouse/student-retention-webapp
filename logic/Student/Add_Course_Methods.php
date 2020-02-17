<?php
    // this makes sure that all stored session values are kept
    session_start();

    // this includes the needed database and default methods
    require_once( dirname(__FILE__, 3) . "\logic\Database_Methods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Default_Methods.php" );


    // this handles calling the logic function and its return array
    if (!empty($_POST)) {
        $feedback = AddCourseMethods::addCourse();
    } else {
        $feedback = array();
    }


    class AddCourseMethods {

        // main function called by presentation layer
        public static function addCourse(): array {
            DefaultMethods::checkLogin('Student');

            
            // this sets the variables needed for this method.
            $feedback = array();
            $inputArray = array(
                "Course Number" => ($_POST['courseNumber'])
            );


            // this formats the fields, returns false if at least 1 field is empty
            $feedback = DefaultMethods::formatFields($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;
            

            // this checks to see if the course exists
            $feedback = AddCourseMethods::checkCourseExists($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;
            

            // this checks to make sure the student isn't already enrolled
            $feedback = AddCourseMethods::checkIfNotEnrolled($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;
            

            // this inserts the student course pair, and returns false if it fails
            $feedback = AddCourseMethods::attemptStudentInsertion($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;
            
            
            // if all went according to plan, it will return a success feedback
            $success = array("You're now successfully signed up for that course!");
            return DefaultMethods::generateReturnArray("Success", $success);
        }



        // this is the logic component for calling the database method of (roughly) the same name
        private static function checkCourseExists(array $inputArray): array {
            $courseNumber = $inputArray["Course Number"];

            // course check failure code
            if (!DatabaseMethods::checkCourseExists($courseNumber)) {
                $errorArray = array("It seems like that course number doesn't exist, please contact your professor with this error.");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }

            // course check success code
            return DefaultMethods::generateReturnArray();
        }

        // this is the logic component for calling the database method of (roughly) the same name
        private static function checkIfNotEnrolled(array $inputArray): array {
            $courseNumber = $inputArray["Course Number"];

            // course check failure code
            if (DatabaseMethods::checkEnrollment($courseNumber, $_SESSION["userID"])) {
                $errorArray = array("It seems like you're already enrolled in that course! Contact your professor and ask them to check.");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }
            
            // course check success code
            return DefaultMethods::generateReturnArray();
        }

        // this is the logic component for calling the database method of (roughly) the same name
        private static function attemptStudentInsertion(array $inputArray): array {
            $courseNumber = $inputArray["Course Number"];

            // course check failure code
            if (DatabaseMethods::attemptStudentInsertion($courseNumber, $_SESSION["userID"])) {
                $errorArray = array("It seems like something went wrong on our end, please try again in a couple of moments or contact your systems admin!");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }
            
            // course check success code
            return DefaultMethods::generateReturnArray();
        }

    }

?>