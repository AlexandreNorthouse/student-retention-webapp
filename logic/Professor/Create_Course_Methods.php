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
                "University ID" => ($_SESSION['uniID']),
                "Course Number" => ($_POST['courseNumber']),
                "Course Section" => ($_POST['courseSection']),
                "Course Name" => ($_POST['courseName']),
                "Professor ID" => ($_SESSION['userID'])
            );


            // this formats the fields, returns false if at least 1 field is empty
            $feedback = DefaultMethods::formatFields($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // Does a duplicate course number - section check
            $feedback = CreateCourseMethods::duplicateCrseNumSectCheck($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;

            // this removes any "accidental" spaces included in the course id
            $inputArray['Course Number'] = str_replace(' ', '', $inputArray['Course Number']);

            // attempts to insert the course
            $feedback = CreateCourseMethods::attemptCourseInsertion($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // if all went according to plan, it will return a success feedback
            $success = array("The course was successfully added to the university! " .
                "It should now appear in your enrolled courses.");
            return DefaultMethods::generateReturnArray("Success", $success);
        }



        // Checks database for course number / section combo; returns empty array on success, error array otherwise.
        private static function duplicateCrseNumSectCheck(array $inputArray): array
        {
            // sets variables for more legible variable names
            $courseNumber   = $inputArray['Course Number'];
            $courseSection  = $inputArray['Course Section'];
            $universityID   = $inputArray['University ID'];

            // attempted insertion error code
            if (DatabaseMethods::duplicateCrseNumSectCheck($courseNumber, $courseSection, $universityID)) {
                $errorArray = array("It seems that course number and section number already exists!");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }

            // attempted insertion success code
            return DefaultMethods::generateReturnArray();
        }

        // Attempts Course Insertion and updating the relational table with the course id and user id
        private static function attemptCourseInsertion(array $inputArray): array
        {
            // sets variables for more legible variable names
            $courseNumber   = $inputArray['Course Number'];
            $courseSection  = $inputArray['Course Section'];
            $courseName     = $inputArray['Course Name'];
            $universityID   = $inputArray['University ID'];
            $professorID    = $inputArray['Professor ID'];


            // attempted insertion error code
            $courseID = DatabaseMethods::attemptCourseInsertion($courseNumber, $courseSection, $courseName, $universityID);
            if (empty($courseID)) {
                $errorArray = array("It seems like something went wrong on our end when" .
                    " creating the course, please try again in a couple of moments or contact your systems admin!");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }

            // now attempts to create professor and course ID relationship
            if (!DatabaseMethods::attemptCourseUserRelationshipInsertion($courseID, $professorID)) {
                $errorArray = array("It seems like something went wrong on our end when adding you to " .
                "the created course, please try again in a couple of moments or contact your systems admin!");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }


            // success code
            return DefaultMethods::generateReturnArray();
        }

    }

?>