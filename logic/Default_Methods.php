<?php

	class DefaultMethods {

		// logs out the user
		public static function logoutUser() {
			session_start();
			session_destroy();
			header('Location: index.php');
		}

		// This will check the login of the current user, using the $_SESSION variable
		public static function checkLogin(string $userType) {
			// makes sure the crucial variable is set before continuing
			if (isset($_SESSION['isProf'])){
				
				// student login check
				if ($userType == "Student" && $_SESSION['isProf'] != FALSE) {
					DefaultMethods::logoutUser();
				}

				// professor login check
				if ($userType == "Professor" && $_SESSION['isProf'] != TRUE) {
					DefaultMethods::logoutUser();
				}
			} else {
				DefaultMethods::logoutUser();
			}
		}

		// This will format all the given fields in a dictionary array
		public static function formatFields(array $inputs): array {
			// creates array to collect any generated errors
			$errors = array();

			// runs through all the inputs to format them and check for empty values
			foreach ($inputs as $inputName => &$value) {

				// first trims the value
				$value = trim($value);
		
				// then reports if its empty
				if (empty($value) || $value == "") {
					$errors[] = "The $inputName field can't be empty!";
				}
			}
			
			// then returns an arrays of errors or...
			if (!empty($errors))
				return DefaultMethods::generateReturnArray("Error", $errors);
			
			// a successful empty array
			return DefaultMethods::generateReturnArray();
			
		}

		// This handles returning the array needed for the phtml pages to interpret the results.
		public static function generateReturnArray(string $outcome = null, array $feedback = null): array {
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
            $userID = $_SESSION['UserID'];
            DatabaseMethods::getEnrolledCourses($userID);
        }

    }
	
?>