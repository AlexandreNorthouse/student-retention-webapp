<?php
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