<?php
    // this makes sure that all stored session values are kept
    session_start();

    // this includes the needed database and default methods
    require_once( dirname(__FILE__, 3) . "\logic\Database_Methods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Default_Methods.php" );

    DefaultMethods::checkLogin("Professor");
    $classList = DefaultMethods::getEnrolledCourses();

    // this handles calling the logic function and its return array
    if (!empty($_POST)) {
        $inputArray = array(
            "Course ID"           => $_POST['courseID'],
            "Course Title"        => $_POST['courseTitle'],
            "Contact Information" => $_POST['contactInfo'],
            "Office Hours"        => $_POST['officeHours'],
            "Course Description"  => $_POST['courseDes'],
            "Course Goals"        => $_POST['courseGoals'],
            "Required Materials"  => $_POST['reqMaterials'],
            "Grading Policy"      => $_POST['gradingPolicy'],
            "Attendance Policy"   => $_POST['attenPolicy'],
            "University Policies" => $_POST['uniPolicies'],
            "Student Resources"   => $_POST['stuResources']
        );
        $feedback = CreateSyllabusMethods::createSyllabus($inputArray);
    } else {
        $feedback = array();
    }


    class CreateSyllabusMethods {

        // main function called by presentation layer
        public static function createSyllabus($inputArray): array
        {
            // this sets the variables needed for this method.
            $feedback = array();


            // this formats the fields, returns false if at least 1 field is empty
            $feedback = DefaultMethods::formatFields($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // Checks to see if a syllabus already exists for the selected course
            $feedback = CreateSyllabusMethods::checkSyllabusExists($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // attempts to insert the course
            $feedback = CreateSyllabusMethods::attemptSyllabusInsertion($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // if all went according to plan, it will return a success feedback and unset $_POST
            unset($_POST);
            $success = array("The syllabus was successfully added to the course!");
            return DefaultMethods::generateReturnArray("Success", $success);
        }



        // Checks database for a syllabus with that course ID; returns empty array if it exists, error array otherwise.
        public static function checkSyllabusExists(array $inputArray): array
        {
            // sets variables for more legible variable names
            $courseID = $inputArray['Course ID'];

            // attempted insertion error code
            if (DatabaseMethods::checkSyllabusExists($courseID)) {
                $errorArray = array("It seems like a syllabus already exists for this course!");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }

            // attempted insertion success code
            return DefaultMethods::generateReturnArray();
        }

        // Attempts to insert row into syllabi; returns empty array for success, error array otherwise
        public static function attemptSyllabusInsertion(array $inputArray): array
        {
            // sets variables for more legible variable names
            $courseID     = $inputArray['Course ID'];
            $title        = $inputArray['Course Title'];
            $contactInfo  = $inputArray['Contact Information'];
            $officeHours  = $inputArray['Office Hours'];
            $description  = $inputArray['Course Description'];
            $goals        = $inputArray['Course Goals'];
            $materials    = $inputArray['Required Materials'];
            $grading      = $inputArray['Grading Policy'];
            $attendance   = $inputArray['Attendance Policy'];
            $uniPolicies  = $inputArray['University Policies'];
            $resources    = $inputArray['Student Resources'];

            // attempted insertion error code
            if (!DatabaseMethods::attemptSyllabusInsertion($courseID, $title, $contactInfo, $officeHours,
                    $description, $goals, $materials, $grading, $attendance, $uniPolicies, $resources)) {
                $errorArray = array("It seems like something went wrong on our end, please try again in a couple of 
                                        moments or contact your systems admin!");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }

            // attempted insertion success code
            return DefaultMethods::generateReturnArray();
        }
    }

?>