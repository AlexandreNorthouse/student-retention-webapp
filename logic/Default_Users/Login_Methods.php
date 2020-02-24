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
            // consider using "array_key_exists('key', $array)"
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


            // then redirects them to their proper home page
            LoginMethods::redirectHomepage($inputArray);


            // if the redirect managed to fail, it will send them an error.
            $error = array("Something went wrong in the redirection, please try again!");
            return DefaultMethods::generateReturnArray("Error", $error);
        }



        // Attempts to sign the user in, then sets the session variables with the temporary array.
        private static function attemptLogin(array $inputArray): array
        {
            $username = $inputArray["Username"];
            $password = $inputArray["Password"];
            $user = DatabaseMethods::attemptLogin($username, $password);

            // course check failure code
            if (empty($user)) {
                $errorArray = array("That password and username combination doesn't exist, please try again.");
                return DefaultMethods::generateReturnArray("Error", $errorArray);
            }

            // course check success code
            LoginMethods::setSessionVariables($user);
            return DefaultMethods::generateReturnArray();
        }

        // Sets the session variables to store the user values.
        private static function setSessionVariables(array $user)
        {
            $_SESSION["userID"]   = $user['ID'];
            $_SESSION["uniID"]    = $user['uniID'];
            $_SESSION["username"] = $user['username'];
            $_SESSION["fName"]    = $user['fname'];
            $_SESSION["lName"]    = $user['lname'];
            $_SESSION["isProf"]   = $user['isProf'];
        }

        // Redirects the browser to the student or professor landing pages.
        private static function redirectHomepage(array $inputArray)
        {
            if ($_SESSION['isProf'] == 1) {
                header("Location: ../Professor/View_Data.php");
                die();
            }
            if ($_SESSION['isProf'] == 0) {
                header("Location: ../Student/Chatbot.php");
                die();
            }
        }


    }

?>