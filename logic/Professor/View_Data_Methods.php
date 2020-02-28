<?php
    // this makes sure that all stored session values are kept
    session_start();

    // this includes the needed database and default methods
    require_once( dirname(__FILE__, 3) . "\logic\Database_Methods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Default_Methods.php" );

    DefaultMethods::checkLogin("Professor");
    $classList = DefaultMethods::getEnrolledCourses();

    // this handles calling the logic function and its return array
    if (!empty($_POST['submitData']) || !empty($_POST['editQuestion'])) {
        $inputArray = array(
            "Selected Course" => ($_POST['courseID'])
        );
        $questionList = ViewDataMethods::viewData($inputArray);


    }
    else if (!empty($_POST['submitUpdate'])) {
        $inputArray = array(
            "Selected Course"   => ($_POST['courseID']),
            "Selected Question" => ($_POST['submitUpdate']),
            "Update Question" => ($_POST['updateQuestion']),
            "Update Answer" => ($_POST['updateAnswer'])
        );
        $feedback = ViewDataMethods::updateData($inputArray);
        $questionList = ViewDataMethods::viewData($inputArray);


    }
    else if (!empty($_POST['deleteQuestion'])) {
        $inputArray = array(
            "Selected Course"   => ($_POST['courseID']),
            "Selected Question" => ($_POST['deleteQuestion'])
        );
        $feedback = ViewDataMethods::attemptDataDelete($inputArray);
        $questionList = ViewDataMethods::viewData($inputArray);


    }
    else {
        $feedback = array();
        $questionList = array();
    }


    class ViewDataMethods {

        public static function viewData($inputArray): array
        {
            // this sets the variables needed for this method.
            $feedback = array();


            // this formats the fields, returns false if at least 1 field is empty
            $feedback = DefaultMethods::formatFields($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // attempts to get all the questions related to the course selected
            $feedback = ViewDataMethods::attemptQuestionsPull($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // if all went according to plan, it will return an array of questions
            return $feedback;
        }

        public static function updateData($inputArray): array
        {
            // this sets the variables needed for this method.
            $feedback = array();


            // this formats the fields, returns false if at least 1 field is empty
            $feedback = DefaultMethods::formatFields($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // attempts to get all the questions related to the course selected
            $feedback = ViewDataMethods::attemptDataUpdate($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // if all went according to plan, it will return a success feedback
            $successArray = array("Question successfully updated!");
            return DefaultMethods::generateReturnArray("Success", $successArray);
        }



        // Attempts to pull a courses' questions; returns array of questions on success, error array otherwise.
        public static function attemptQuestionsPull(array $inputArray): array
        {
            // sets variables for more legible variable names
            $courseID = $inputArray['Selected Course'];
            $questionsArray = DatabaseMethods::attemptQuestionsPull($courseID);

            // attempted insertion error code
            if (empty($questionsArray)) {
                $errorArray = array("It seems that course doesn't have any questions!");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }

            // attempted insertion success code
            return $questionsArray;
        }

        // Attempts to update a question; returns blank array on success, error array otherwise.
        public static function attemptDataUpdate(array $inputArray): array
        {
            // sets variables for more legible variable names
            $quesID   = $inputArray['Selected Question'];
            $updateQText = $inputArray['Update Question'];
            $updateAText = $inputArray['Update Answer'];

            // attempted insertion error code
            if (!DatabaseMethods::attemptQuestionUpdate($quesID, $updateAText, $updateQText)) {
                $errorArray = array("Something went wrong updating the question, contact your system admin"
                    . " for help!");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }

            // attempted insertion success code
            return DefaultMethods::generateReturnArray();
        }

        // Attempts to update a question; returns success array on success, error array otherwise.
        public static function attemptDataDelete(array $inputArray): array
        {
            // sets variables for more legible variable names
            $quesID   = $inputArray['Selected Question'];

            // attempted insertion error code
            if (!DatabaseMethods::attemptQuestionDelete($quesID)) {
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