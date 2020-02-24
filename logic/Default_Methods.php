<?php

	class DefaultMethods {

		// This will check the login of the current user, using the $_SESSION variable
		public static function checkLogin(string $userType)
        {
			// makes sure the crucial variable is set before continuing
			if (isset($_SESSION['isProf'])){
				
				// student login check
				if ($userType == "Student" && $_SESSION['isProf'] != FALSE) {
					require_once("Logout_User.php");
				}

				// professor login check
				if ($userType == "Professor" && $_SESSION['isProf'] != TRUE) {
                    require_once("Logout_User.php");
				}
			} else {
                require_once("Logout_User.php");
			}
		}


		// This will format all the given fields in a dictionary array
		public static function formatFields(array &$inputArray): array
        {
			$errors = array();

			foreach ($inputArray as $inputName => &$value) {
				$value = trim($value);
				if (empty($value) || $value == "") {
					$errors[] = "The $inputName field can't be empty!";
				}
			}

			if (!empty($errors))
				return DefaultMethods::generateReturnArray("Error", $errors);

			return DefaultMethods::generateReturnArray();
		}


        // This is specifically for formatting all the usernames and passwords thrown its way
        public static function specialFormatting(array &$inputArray): array
        {
            $errors = array();

            if (isset($inputArray['Username'])) {
                $inputArray['Username'] = strtolower($inputArray['Username']);
            } else {
                $errors[] = "Something in the username field caused an error!";
            }

            if (isset($inputArray['Is Professor'])) {
                // these two checks get confused if you don't have the second as an else
                if ($inputArray['Is Professor'] == 'Student') $inputArray['Is Professor'] = 0;
                else if ($inputArray['Is Professor'] == 'Professor') $inputArray['Is Professor'] = 1;

                // only modifies the password if its being inserted into the database
                if (isset($inputArray['Password'])) {
                    $inputArray['Password'] = password_hash($inputArray['Password'], PASSWORD_DEFAULT);
                } else {
                    $errors[] = "Something in the password field(s) caused an error!";
                }
            }

            if (!empty($errors))
                return DefaultMethods::generateReturnArray("Error", $errors);

            return DefaultMethods::generateReturnArray();
        }


		// This handles returning the array needed for the phtml pages to interpret the results.
		public static function generateReturnArray(string $outcome = null, array $feedback = null): array
        {
			// populates a return array if the function is sent two values
			if (isset($outcome) && isset($feedback))
				return array("Outcome" => $outcome, "Feedback"=> $feedback);
			
			// otherwise returns an empty array
			return array();
		}


		// gets an array of all the courses a user is enrolled in
        public static function getEnrolledCourses(): array
        {
            // sets variables for more legible names
            $userID = $_SESSION['userID'];
            return DatabaseMethods::getEnrolledCourses($userID);
        }

    }
	
?>