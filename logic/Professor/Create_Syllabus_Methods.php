<?php
    // this makes sure that all stored session values are kept
    session_start();

    // this includes the needed database and default methods
    require_once( dirname(__FILE__, 3) . "\logic\Database_Methods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Default_Methods.php" );

    $classList = DefaultMethods::getEnrolledCourses();

    // this handles calling the logic function and its return array
    if (!empty($_POST)) {
        $feedback = CreateSyllabusMethods::createSyllabus();
    } else {
        $feedback = array();
    }


    class CreateSyllabusMethods {

        // main function called by presentation layer
        public static function createSyllabus(): array
        {
            DefaultMethods::checkLogin('Professor');


            // this sets the variables needed for this method.
            $feedback = array();
            $inputArray = array(
                "Course ID" => $_POST['dataClassID'],
                "Course Title" => $_POST['dataCourseTitle'],
                "Contact Information" => $_POST['dataContactInformation'],
                "Office Hours Policy" => $_POST['dataOfficeHoursPolicy'],
                "Course Description" => $_POST['dataCourseDescription'],
                "Course Goals" => $_POST['dataCourseGoals'],
                "Required Materials" => $_POST['dataRequiredMaterials'],
                "Grading" => $_POST['dataGrading'],
                "Attendance" => $_POST['dataAttendance'],
                "University Policies" => $_POST['dataUniversityPolicies'],
                "Student Resources" => $_POST['dataStudentResources']
            );


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


            // if all went according to plan, it will return a success feedback
            $success = array("The syllabus was successfully added to the course!");
            return DefaultMethods::generateReturnArray("Success", $success);
        }



        // [description of what the method does]
        private static function checkSyllabusExists(array $inputArray): array
        {
            // sets variables for more legible variable names
            $courseID = $inputArray['Course ID'];

            // attempted insertion error code
            if (!DatabaseMethods::checkSyllabusExists($courseID)) {
                $errorArray = array("It seems like a syllabus already exists for this course!");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }

            // attempted insertion success code
            return DefaultMethods::generateReturnArray();
        }

        // [description of what the method does]
        private static function attemptSyllabusInsertion(array $inputArray): array
        {
            // sets variables for more legible variable names
            $courseID = $inputArray['Course ID'];
            $courseTitle = $inputArray['Course Title'];
            $contactInfo = $inputArray['Contact Information'];
            $officeHours = $inputArray['Office Hours Policy'];
            $courseDesc = $inputArray['Course Description'];
            $courseGoals = $inputArray['Course Goals'];
            $reqMaterials = $inputArray['Required Materials'];
            $grading = $inputArray['Grading'];
            $attendance = $inputArray['Attendance'];
            $uniPolicies = $inputArray['University Policies'];
            $stuResources = $inputArray['Student Resources'];

            // attempted insertion error code
            if (!DatabaseMethods::attemptSyllabusInsertion($courseID, $courseTitle, $contactInfo, $officeHours,
                    $courseDesc, $courseGoals, $reqMaterials, $grading, $attendance, $uniPolicies, $stuResources)) {
                $errorArray = array("It seems like something went wrong on our end, please try again in a couple of 
                                        moments or contact your systems admin!");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }

            // attempted insertion success code
            return DefaultMethods::generateReturnArray();
        }
    }

?>