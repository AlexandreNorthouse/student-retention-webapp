<?php
    require_once( dirname(__FILE__, 3) . "\logic\DatabaseMethods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\DefaultMethods.php" );

    class RegisterMethods {

        // main function called by presentation layer
        public static function register($inputArray): array {
            // this sets the variables needed for this method.
            $feedback = array();


            // this formats the fields, returns false if at least 1 field is empty
            $feedback = DefaultMethods::formatFields($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // This is a quick password matching test to prevent wasting server resources
            if ($inputArray['Password'] != $inputArray['Password 2'])
                return DefaultMethods::generateReturnArray("Error", array("Your passwords didn't match!"));


            // this converts the username to lowercase and the password to a secure one
            $feedback = DefaultMethods::specialFormatting($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // Does a duplicate username check
            $feedback = RegisterMethods::duplicateUsernameCheck($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // Attempts to insert the user into the database
            $feedback = RegisterMethods::attemptUserInsertion($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // informs of the success and resets all the post variables
            $success = array("Account successfully added! Return to the login page to login.");
            unset($_POST);
            return DefaultMethods::generateReturnArray("Success", $success);
        }



        // Logic for checking if a duplicate username already exists for the inputted university
        public static function duplicateUsernameCheck(array $inputArray): array
        {
            $username = $inputArray["Username"];
            $uniID = $inputArray["uniID"];

            // duplicate found
            if (DatabaseMethods::duplicateUsernameCheck($username, $uniID)) {
                $errorArray = array("That username already exists for that university!");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }

            // duplicate not found
            return DefaultMethods::generateReturnArray();
        }

        // Attempts to insert the user into the database; empty array for success, error array for failure
        public static function attemptUserInsertion(array $inputArray): array
        {
            $username = $inputArray["Username"];
            $password = $inputArray["Password"];
            $uniID  = $inputArray["University ID"];
            $fName  = $inputArray["First Name"];
            $lName  = $inputArray["Last Name"];
            $isProf = $inputArray["Is Professor"];

            // Insertion failure code
            if (!DatabaseMethods::attemptUserInsertion($username, $password, $uniID, $fName, $lName, $isProf)) {
                $errorArray = array("Something went wrong with adding that account, " .
                    "please try again in a few moments or contact your system administrator.");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }

            // Insertion success code
            return DefaultMethods::generateReturnArray();
        }
    }
?>