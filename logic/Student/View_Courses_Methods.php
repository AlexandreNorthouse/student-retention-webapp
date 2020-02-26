<?php
    // this makes sure that all stored session values are kept
    session_start();

    // this includes the needed database and default methods
    require_once( dirname(__FILE__, 3) . "\logic\Database_Methods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Default_Methods.php" );

    DefaultMethods::checkLogin('Student');
    $classList = DefaultMethods::getEnrolledCourses("Professor Details");

    // this handles calling the logic function and its return array
    if (!empty($_POST)) {
        $inputArray = array(
            "Selected Course" => ($_POST['selectedCourse']),
            "Student ID" => ($_SESSION['userID'])
        );
        $feedback = ViewCoursesMethods::dropCourse($inputArray);
        $classList = DefaultMethods::getEnrolledCourses("Professor Details");
    } else {
        $feedback = array();
    }


    class ViewCoursesMethods
    {
        // main function called by presentation layer
        public static function dropCourse($inputArray): array {
            // this sets the variables needed for this method.
            $feedback = array();


            // attempts to withdraw the student from the class
            $feedback = ViewCoursesMethods::attemptCourseWithdraw($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // if all went according to plan, it will return a success feedback
            $success = array("Successfully withdrew from the course!");
            return DefaultMethods::generateReturnArray("Success", $success);
        }



        // this is the logic component for calling the database method of (roughly) the same name
        private static function attemptCourseWithdraw(array $inputArray): array {
            $courseNumber = $inputArray["Selected Course"];
            $studentID = $inputArray["Student ID"];

            // course withdraw failure code
            if (!DatabaseMethods::attemptCourseWithdraw($courseNumber, $studentID)) {
                $errorArray = array("It seems like there was an error removing you from that course, "
                    . "please contact your professor with this error.");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }

            // course withdraw success code
            return DefaultMethods::generateReturnArray();
        }

    }

?>