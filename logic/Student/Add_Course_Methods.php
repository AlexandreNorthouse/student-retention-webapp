<?php
    // this makes sure that all stored session values are kept
    session_start();

    // this includes the needed database and default methods
    require_once( dirname(__FILE__, 3) . "\logic\Database_Methods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Default_Methods.php" );

    DefaultMethods::checkLogin('Student');

    // this handles calling the logic function and its return array
    if (!empty($_POST)) {
        $inputArray = array(
            "Course Number" => ($_POST['courseNumber']),
            "Student ID"    => ($_SESSION['userID'])
        );
        $feedback = AddCourseMethods::addCourse($inputArray);
    } else {
        $feedback = array();
    }


    class AddCourseMethods {

        // main function called by presentation layer
        public static function addCourse($inputArray): array
        {
            // this sets the variables needed for this method.
            $feedback = array();


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
            $feedback = AddCourseMethods::attemptStudentEnrollment($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;
            
            
            // if all went according to plan, it will return a success feedback
            $success = array("You're now successfully signed up for that course!");
            return DefaultMethods::generateReturnArray("Success", $success);
        }



        // Checks the database for a provided course ID; returns empty array if it exists, error array otherwise
        public static function checkCourseExists(array $inputArray): array {
            $courseNumber = $inputArray["Course Number"];

            // course check failure code
            if (!DatabaseMethods::checkCourseExists($courseNumber)) {
                $errorArray = array("It seems like that course number doesn't exist, please contact your " .
                    "professor with this error.");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }

            // course check success code
            return DefaultMethods::generateReturnArray();
        }

        // Checks database for user / course combo; returns empty array if already enrolled, error array otherwise.
        public static function checkIfNotEnrolled(array $inputArray): array {
            $courseNumber = $inputArray["Course Number"];
            $studentID    = $inputArray["Student ID"];

            // course check failure code
            if (DatabaseMethods::checkEnrollment($courseNumber, $studentID)) {
                $errorArray = array("It seems like you're already enrolled in that course! " .
                    "Contact your professor and ask them to check.");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }
            
            // course check success code
            return DefaultMethods::generateReturnArray();
        }

        // Attempts to insert row into coursesusersroster; returns empty array if already enrolled, error array otherwise
        public static function attemptStudentEnrollment(array $inputArray): array {
            $courseNumber = $inputArray["Course Number"];
            $studentID    = $inputArray["Student ID"];

            // course check failure code
            if (!DatabaseMethods::attemptStudentInsertion($courseNumber, $studentID)) {
                $errorArray = array("It seems like something went wrong on our end, please try again in a couple of moments or contact your systems admin!");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }
            
            // course check success code
            return DefaultMethods::generateReturnArray();
        }

    }

?>