<?php
    require_once( dirname(__FILE__, 3) . "\logic\DatabaseMethods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\DefaultMethods.php" );

    class StudentEnrollmentMethods
    {
        // main function called by presentation layer
        public static function removeStudent($inputArray): array {
            // this sets the variables needed for this method.
            $feedback = array();


            // attempts to withdraw the student from the class
            $feedback = StudentEnrollmentMethods::attemptStudentRemoval($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // if all went according to plan, it will return a success feedback
            $success = array("Successfully withdrew student from the course!");
            return DefaultMethods::generateReturnArray("Success", $success);
        }



        // this is the logic component for calling the database method of (roughly) the same name
        private static function attemptStudentRemoval(array $inputArray): array {
            $courseNumber = $inputArray["Selected Course"];
            $studentID = $inputArray["Selected Student"];

            // course withdraw failure code
            if (!DatabaseMethods::attemptStudentRemoval($courseNumber, $studentID)) {
                $errorArray = array("It seems like there was an error removing you from that course, "
                    . "please contact your professor with this error.");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }

            // course withdraw success code
            return DefaultMethods::generateReturnArray();
        }

        // this is the logic component for calling the database method of (roughly) the same name
        public static function getStudents(array $inputArray): array {
            $courseNumber = $inputArray["Selected Course"];
            $studentList = DatabaseMethods::getStudents($courseNumber);

            // course withdraw failure code
            if (empty($studentList)) {
                $errorArray = array("It seems like there aren't any students in that course, "
                    . "please contact your system admin if you believe this to be an error.");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }

            // course withdraw success code
            return $studentList;
        }
    }
?>