<?php
    // this makes sure that all stored session values are kept
    session_start();

    // this includes the needed database and default methods
    require_once( dirname(__FILE__, 3) . "\logic\Database_Methods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Default_Methods.php" );


    // this handles calling the logic function and its return array
    if (!empty($_POST)) {
        $feedback = Register_Methods::register();
    } else {
        $feedback = array();
    }


    class Register_Methods {

        // main function called by presentation layer
        public static function register(): array {
            // this sets the variables needed for this method.
            $feedback = array();
            $inputArray = array(
                "Username" => $_POST['username'],
                "Password 1" => $_POST['password'],
                "Password 2" => $_POST['password2'],
                "First Name" => $_POST['fName'],
                "Last Name" => $_POST['lName'],
                "University ID" => $_POST['uniID']
            );


            // this formats the fields, returns false if at least 1 field is empty
            $feedback = DefaultMethods::formatFields($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // this converts the username to lowercase and the password to a secure one
            $feedback = DefaultMethods::specialFormatting($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // Does a duplicate username check
            $feedback = Register_Methods::duplicateUsernameCheck($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // Attempts to insert the user into the database
            $feedback = Register_Methods::attemptUserInsertion($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // if the redirect managed to fail, it will send them an error.
            $error = array("Something went wrong in the redirection, please try again!");
            return DefaultMethods::generateReturnArray("Success", $error);
        }


        // [description]
        private static function duplicateUsernameCheck(array $inputArray): array
        {
            return array();
        }

        // [description]
        private static function attemptUserInsertion(array $inputArray): array
        {
            return array();
        }


    }

?>