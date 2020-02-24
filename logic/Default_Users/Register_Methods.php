<?php
    // this makes sure that all stored session values are kept
    session_start();

    // this includes the needed database and default methods
    require_once( dirname(__FILE__, 3) . "\logic\Database_Methods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Default_Methods.php" );


    // this handles calling the logic function and its return array
    if (!empty($_POST)) {
        $feedback = RegisterMethods::register();
    } else {
        $feedback = array();
    }


    class RegisterMethods {

        // main function called by presentation layer
        public static function register(): array {
            // this sets the variables needed for this method.
            $feedback = array();
            $inputArray = array(
                "Username" => $_POST['username'],
                "University ID" => $_POST['uniID'],
                "Password" => $_POST['password'],
                "Password 2" => $_POST['password2'],
                "First Name" => $_POST['fName'],
                "Last Name" => $_POST['lName'],
                "Is Professor" => $_POST['createUser']
            );


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
            $error = array("Account successfully added! Return to the login page to login.");
            unset($_POST);
            return DefaultMethods::generateReturnArray("Success", $error);
        }


        // Logic for checking if a duplicate username already exists for the inputted university
        private static function duplicateUsernameCheck(array $inputArray): array
        {
            $username = $inputArray["Username"];
            $isProf = $inputArray["Is Professor"];

            // duplicate found
            if (DatabaseMethods::duplicateUsernameCheck($username, $isProf)) {
                $errorArray = array("That username already exists for that university!");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }

            // duplicate not found
            return DefaultMethods::generateReturnArray();
        }

        // Attempts to log the user in; sets $_SESSION variables on success, returns error array otherwise.
        private static function attemptUserInsertion(array $inputArray): array
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