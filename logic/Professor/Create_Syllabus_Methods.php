<?php
    class CreateSyllabusMethods {

        // main function called by presentation layer
        public static function createSyllabus(array $inputArray): array
        {
            // this sets the variables needed for this method.
            $feedback = array();


            // this formats the fields, returns false if at least 1 field is empty
            $feedback = DefaultMethods::formatFields($inputArray);
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

        public static function updateSyllabus(array $inputArray): array
        {
            // this sets the variables needed for this method.
            $feedback = array();


            // this formats the fields, returns false if at least 1 field is empty
            $feedback = DefaultMethods::formatFields($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // attempts to get all the questions related to the course selected
            $feedback = CreateSyllabusMethods::attemptSyllabusUpdate($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // if all went according to plan, it will return a success feedback
            $successArray = array("Syllabus successfully updated!");
            return DefaultMethods::generateReturnArray("Success", $successArray);
        }



        // Attempts to get a syllabus; returns content array for success, empty array otherwise.
        public static function getSyllabus(array $inputArray):array
        {
            // sets variables for more legible variable names
            $courseID   = $inputArray['Course ID'];
            return DatabaseMethods::checkSyllabusExists($courseID);
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

        // Attempts to update a question; returns blank array on success, error array otherwise.
        public static function attemptSyllabusUpdate(array $inputArray): array
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
            if (!DatabaseMethods::attemptSyllabusUpdate($courseID, $title, $contactInfo, $officeHours,
                $description, $goals, $materials, $grading, $attendance, $uniPolicies, $resources)) {
                $errorArray = array("It seems like something went wrong while updating the syllabus, please "
                    . "try again in a couple of moments or contact your systems admin!");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }

            // attempted insertion success code
            return DefaultMethods::generateReturnArray();
        }

        // Attempts to update a question; returns success array on success, error array otherwise.
        public static function attemptSyllabusDelete(array $inputArray): array
        {
            // sets variables for more legible variable names
            $courseID   = $inputArray['Course ID'];

            // attempted insertion error code
            if (!DatabaseMethods::attemptSyllabusDeletion($courseID)) {
                $errorArray = array("Something went wrong updating the question, contact your system admin"
                    . " for help!");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }

            // attempted insertion success code
            $successArray = array("Question successfully deleted!");
            return DefaultMethods::generateReturnArray("Success", $successArray);
        }

    }

?>