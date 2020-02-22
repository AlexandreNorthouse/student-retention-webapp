<?php
    // this makes sure that all stored session values are kept
    session_start();

    // this includes the needed database and default methods
    require_once( dirname(__FILE__, 3) . "\logic\Database_Methods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Default_Methods.php" );

    // this handles calling the logic function and its return array
    if (!empty($_POST)) {
        $feedback = CreateCourseMethods::createCourse();
    } else {
        $feedback = array();
    }


    class CreateCourseMethods {

        // main function called by presentation layer
        public static function createCourse(): array
        {
            DefaultMethods::checkLogin('Professor');


            // this sets the variables needed for this method.
            $feedback = array();
            $inputArray = array(
                "Course Number" => ($_POST['courseNumber']),
                "Course Section" => ($_POST['courseSection']),
                "Course Name" => ($_POST['courseName'])
            );


            // this formats the fields, returns false if at least 1 field is empty
            $feedback = DefaultMethods::formatFields($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // Does a duplicate course number - section check
            $feedback = CreateCourseMethods::duplicateCrseNumSectCheck($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // attempts to insert the course
            $feedback = CreateCourseMethods::attemptCourseInsertion($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // if all went according to plan, it will return a success feedback
            $success = array("The course was successfully added to the university!");
            return DefaultMethods::generateReturnArray("Success", $success);
        }



        // [description of what the method does]
        private static function duplicateCrseNumSectCheck(array $inputArray): array
        {
            // sets variables for more legible variable names
            $courseNumber = $inputArray['Course Number'];
            $courseSection = $inputArray['Course Section'];
            $universityID = $_SESSION['uniID'];

            // attempted insertion error code
            if (!DatabaseMethods::duplicateCrseNumSectCheck($courseNumber, $courseSection, $universityID)) {
                $errorArray = array("It seems that course number and section number already exists!");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }

            // attempted insertion success code
            return DefaultMethods::generateReturnArray();
        }

        // [description of what the method does]
        private static function attemptCourseInsertion(array $inputArray): array
        {
            // sets variables for more legible variable names
            $courseNumber = $inputArray['Course Number'];
            $courseSection = $inputArray['Course Section'];
            $courseName = $inputArray['Course Name'];
            $universityID = $_SESSION['uniID'];
            $professorID = $_SESSION['userID'];


            // attempted insertion error code
            if (!DatabaseMethods::attemptCourseInsertion($courseNumber, $courseSection, $courseName, $universityID, $professorID)) {
                $errorArray = array("It seems like something went wrong on our end, please try again in a couple of moments or contact your systems admin!");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }

            // attempted insertion success code
            return DefaultMethods::generateReturnArray();
        }

    }

?>