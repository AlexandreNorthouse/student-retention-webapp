<?php
    class LoginMethods {

        // main function called by presentation layer
        public static function login($inputArray): array {
            // this sets the variables needed for this method.
            $feedback = array();


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


            // then gets the string for the url to their proper home page
            $redirect = LoginMethods::getRedirectString($inputArray['isProf']);

            // redirect:
            if ($redirect != "Error")
                header($redirect);


            // if the redirect managed to fail, it will send them an error.
            $error = array("Something went wrong in the redirection, please try again!");
            return DefaultMethods::generateReturnArray("Error", $error);
        }



        // Attempts to sign the user in, then sets the session variables with the temporary array.
        public static function attemptLogin(array &$inputArray): array
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
            $inputArray['isProf'] = $user['isProf'];
            LoginMethods::setSessionVariables($user);
            return DefaultMethods::generateReturnArray();
        }

        // Sets the session variables to store the user values.
        public static function setSessionVariables(array $user)
        {
            $_SESSION["userID"]   = $user['ID'];
            $_SESSION["uniID"]    = $user['uniID'];
            $_SESSION["username"] = $user['username'];
            $_SESSION["fName"]    = $user['fname'];
            $_SESSION["lName"]    = $user['lname'];
            $_SESSION["isProf"]   = $user['isProf'];
        }

        // Redirects the browser to the student or professor landing pages.
        public static function getRedirectString(string $isProf): string
        {
            if ($isProf == 1) {
                return ("Location: ../Professor/ViewData.php");
            }
            if ($isProf == 0) {
                return("Location: ../Student/Chatbot.php");
            }
            return ("Error");
        }


    }

?>