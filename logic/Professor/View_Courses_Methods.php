<?php
    // this makes sure that all stored session values are kept
    session_start();

    // this includes the needed database and default methods
    require_once( dirname(__FILE__, 3) . "\logic\Database_Methods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Default_Methods.php" );

    DefaultMethods::checkLogin('Professor');
    $classList = DefaultMethods::getEnrolledCourses();

    // this handles calling the logic function and its return array
    if (!empty($_POST)) {
        $inputArray = array(
            "Selected Course" => ($_POST['selectedCourse']),
            "Professor ID" => ($_SESSION['userID'])
        );
        $feedback = ViewCoursesMethodsProf::deleteCourse($inputArray);
        $classList = DefaultMethods::getEnrolledCourses("Professor Details");
    } else {
        $feedback = array();
    }


    class ViewCoursesMethodsProf
    {
        // main function called by presentation layer
        public static function deleteCourse($inputArray): array {
            // this sets the variables needed for this method.
            $feedback = array();


            // attempts to delete the course from the database
            $feedback = ViewCoursesMethodsProf::attemptCourseDeletion($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // if all went according to plan, it will return a success feedback
            $success = array("Successfully deleted the course!");
            return DefaultMethods::generateReturnArray("Success", $success);
        }



        // this is the logic component for calling the database method of (roughly) the same name
        private static function attemptCourseDeletion(array $inputArray): array {
            $courseNumber = $inputArray["Selected Course"];

            // course withdraw failure code
            if (!DatabaseMethods::attemptCourseDeletion($courseNumber)) {
                $errorArray = array("It seems like there was an error deleting that course, "
                    . "please contact your system admin with this error.");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }

            // course withdraw success code
            return DefaultMethods::generateReturnArray();
        }

    }

?>