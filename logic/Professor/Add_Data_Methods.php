<?php
    // this makes sure that all stored session values are kept
    session_start();

    // this includes the needed database and default methods
    require_once( dirname(__FILE__, 3) . "\logic\Database_Methods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Default_Methods.php" );

    $classList = DefaultMethods::getEnrolledCourses();

    // this handles calling the logic function and its return array
    if (!empty($_POST)) {
        $feedback = AddDataMethods::addQuestion();
    } else {
        $feedback = array();
    }


    class AddDataMethods {

        // main function called by presentation layer
        public static function addQuestion(): array
        {
            DefaultMethods::checkLogin('Professor');


            // this sets the variables needed for this method.
            $feedback = array();
            $inputArray = array(
                "Selected Class" => ($_POST['dataClassID']),
                "Question" => ($_POST['dataQuestion']),
                "Answer" => ($_POST['dataAnswer'])
            );


            // this formats the fields, returns false if at least 1 field is empty
            $feedback = DefaultMethods::formatFields($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // this checks to see if the course already has that question and answer combo
            $feedback = AddDataMethods::duplicateQACheck($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // this inserts the question/answer into the database
            $feedback = AddDataMethods::attemptQAInsertion($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // if all went according to plan, it will return a success feedback
            $success = array("The question was successfully added to the course!");
            return DefaultMethods::generateReturnArray("Success", $success);
        }



        // [description of what the method does]
        private static function duplicateQACheck(array $inputArray): array
        {
            // sets variables for more legible variable names
            $question = $inputArray['Question'];
            $answer = $inputArray['Answer'];
            $selectedCourse = $inputArray['Selected Course'];


            // duplicate question check error code
            if (!DatabaseMethods::duplicateQACheck($question, $answer, $selectedCourse)) {
                $errorArray = array("It seems like that question / answer combo already exists, please contact your system admin with this error.");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }

            // duplicate question check success code
            return DefaultMethods::generateReturnArray();
        }

        // [description of what the method does]
        private static function attemptQAInsertion(array $inputArray): array
        {
            // sets variables for more legible variable names
            $question = $inputArray['Question'];
            $answer = $inputArray['Answer'];
            $selectedCourse = $inputArray['Selected Course'];

            // attempted insertion error code
            if (!DatabaseMethods::attemptQAInsertion($question, $answer, $selectedCourse)) {
                $errorArray = array("It seems like something went wrong on our end, please try again in a couple of moments or contact your systems admin!");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }

            // attempted insertion success code
            return DefaultMethods::generateReturnArray();
        }

    }

?>