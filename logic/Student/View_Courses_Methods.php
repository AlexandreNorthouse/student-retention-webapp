<?php
    // this makes sure that all stored session values are kept
    session_start();

    // this includes the needed database and default methods
    require_once( dirname(__FILE__, 3) . "\logic\Database_Methods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Default_Methods.php" );


    // this handles calling the logic function and its return array
    if (!empty($_POST)) {
        $feedback = ViewCoursesMethods::addCourse();
    } else {
        $feedback = array();
    }


    class ViewCoursesMethods {

        // main function called by presentation layer
        public static function addCourse(): array {
            //DefaultMethods::checkLogin('Student');


            // this sets the variables needed for this method.
            $feedback = array();
            $inputArray = array(
                "Course Number" => ($_POST['courseNumber'])
            );


            // attempts to withdraw the student from the class
            $feedback = ViewCoursesMethods::attemptCourseWithdrawl($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // if all went according to plan, it will return a success feedback
            $success = array("Successfully withdrew from the course!");
            return DefaultMethods::generateReturnArray("Success", $success);
        }



        // this is the logic component for calling the database method of (roughly) the same name
        private static function attemptCourseWithdrawl(array $inputArray): array {
            $courseNumber = $inputArray["Course Number"];

            // course check failure code
            if (!DatabaseMethods::checkCourseExists($courseNumber)) {
                $errorArray = array("It seems like that course number doesn't exist, please contact your professor with this error.");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }

            // course check success code
            return DefaultMethods::generateReturnArray();
        }

    }

?>