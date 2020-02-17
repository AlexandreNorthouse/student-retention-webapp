<?php
    // this makes sure that all stored session values are kept
    session_start();

    // this includes the needed database and default methods
    require_once( dirname(__FILE__, 3) . "\logic\Database_Methods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Default_Methods.php" );


    // this handles calling the logic function and its return array
    if (!empty($_POST)) {
        $feedback = LoginMethods::login();
    } else {
        $feedback = array();
    }


    class LoginMethods {

        // main function called by presentation layer
        public static function login(): array {
            // this sets the variables needed for this method.
            $feedback = array();
            $inputArray = array(
                "Username" => ($_POST['username']),
                "Password" => ($_POST['password'])
            );


            // this formats the fields, returns false if at least 1 field is empty
            $feedback = DefaultMethods::formatFields($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // this converts the username to lowercase and the password to a secure one
            $feedback = DefaultMethods::specialFormatting($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // attempts to login
            $feedback = LoginMethods::attemptLogin($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // sets session variables
            $feedback = LoginMethods::setSessionVariables($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // then redirects them to their proper home page
            $feedback = LoginMethods::redirectHomepage($inputArray);
            if (isset($feedback["Outcome"]))
                return $feedback;


            // if the redirect managed to fail, it will send them an error.
            $error = array("Something went wrong in the redirection, please try again!");
            return DefaultMethods::generateReturnArray("Success", $error);
        }



        // [description]
        private static function attemptLogin(array $inputArray): array
        {
            return array();
        }

        // [description]
        private static function setSessionVariables(array $inputArray): array
        {
            return array();
        }

        // [description]
        private static function redirectHomepage(array $inputArray): array
        {
            return array();
        }


    }

?>