<?php

	require_once( dirname(__FILE__, 2) . "\database\Database_Connection.php");

	class DatabaseMethods {

	    // default method layout:
        /*

        // [description of what the method does]
        public static function asdf(asdf $asdf): asdf {
            // creates SQL query and attempts to execute it
            try {
                $query = "";
                $sql = $conn->prepare($query);
                $sql->execute();
                $class = $sql->fetchAll();

                if ()
                    return FALSE;

            // if something goes wrong, the code below executes as a failsafe
            } catch (Exception $e) {

            }

            // if nothings goes wrong and ..., it returns true
            return TRUE;
        }
        */



        // Universally used methods
        // [description of what the method does]
        public static function getEnrolledCourses($userID): array
        {
            /*
            $query = "SELECT Class.classID, Class.crseID, Class.sectNum, Class.crseName FROM Class, ClassUserRoster WHERE ClassUserRoster.classID=Class.classID AND ClassUserRoster.username='$username'";
            $sql = $conn->prepare($query);
            $sql->execute();
            $classList = $sql->fetchAll();
            */
            return array();
        }



        // Add_Course_Methods database methods
        // [description of what the method does]
		public static function checkCourseExists(int $courseNumber): bool
        {
			// creates SQL query and attempts to execute it
			try {
				$query = "SELECT classID FROM Class WHERE classID=$courseNumber";
                $sql = $conn->prepare($query);
				$sql->execute();
				$class = $sql->fetchAll();

				if (empty($class))
					return FALSE;

			// if something goes wrong, the code below executes as a failsafe
			} catch (Exception $e) {
				return FALSE;
			}

			// if nothing goes wrong and the course exists, it returns true
			return TRUE;
		}

        // [description of what the method does]
        public static function checkEnrollment(int $courseNumber, int $userID): bool
        {
            /*
			$query = "SELECT * FROM * WHERE ";
			$sql = $conn->prepare($query);
			$sql->execute();
			$copyCheck = $sql->fetchAll();
            */
            return TRUE;
        }

        // [description of what the method does]
        public static function attemptStudentInsertion(int $courseNumber, int $userID): bool
        {
            /*
			$query = "SELECT * FROM * WHERE ";
			$sql = $conn->prepare($query);
			$sql->execute();
			$copyCheck = $sql->fetchAll();
            */
            return TRUE;
        }



        // Chatbot_Methods database methods
        // This is where a method would go... IF IT HAD ONE!



        // Add_Data_Methods database methods
        // [description of what the method does]
        public static function duplicateQACheck(String $question, String $answer, int $selectedCourse): bool
        {
            /*
			$query = "SELECT * FROM Question, ClassQuestions WHERE
						ClassQuestions.quesID=$selectedClass AND Question.qtext='$question'";
			$sql = $conn->prepare($query);
			$sql->execute();
			$copyCheck = $sql->fetchAll();
            */
            return TRUE;
        }

        // [description of what the method does]
        public static function attemptQAInsertion(String $question, String $answer, int $selectedCourse): bool
        {
            /*
			$query = "SELECT * FROM * WHERE ";
			$sql = $conn->prepare($query);
			$sql->execute();
			$copyCheck = $sql->fetchAll();
            */
            return TRUE;
        }



        // Create_Course_Methods database methods
        // [description of what the method does]
        public static function duplicateCrseNumSectCheck(int $courseNumber, String $courseSection, String $universityID): bool
        {
            /*
			$query = "SELECT * FROM UniversityClassRoster, Class WHERE Class.crseID='$classNum' AND Class.sectNum=$classSec AND UniversityClassRoster.uniID=$uniID";
			$sql = $conn->prepare($query);
			$sql->execute();
			$classIDs = $sql->fetchAll();
            */
            return TRUE;
        }

        // [description of what the method does]
        public static function attemptCourseInsertion(int $courseNumber, String $courseSection, String $courseName, String $universityID, String $professorID): bool
        {
            /*
			$query = "SELECT * FROM * WHERE ";
			$sql = $conn->prepare($query);
			$sql->execute();
			$copyCheck = $sql->fetchAll();
            */
            return TRUE;
        }



        // Create_Syllabus_Methods database methods
        // [description of what the method does]
        public static function checkSyllabusExists ($courseID)
        {
            /*
			$query = "SELECT * FROM * WHERE ";
			$sql = $conn->prepare($query);
			$sql->execute();
			$copyCheck = $sql->fetchAll();
            */
            return TRUE;
        }

        // [description of what the method does]
        public static function attemptSyllabusInsertion(int $courseID, String $courseTitle, String $contactInfo, String $officeHours, String $courseDesc, String $courseGoals, String $reqMaterials, String $grading, String $attendance, String $uniPolicies, String $stuResources)
        {
            /*
            $query = "INSERT INTO Syllabus VALUES (NULL, '$ct', '$ci', '$ohp', '$cd', '$cg', '$rm',
                        '$g', '$a', '$up', '$sr')";
            $sql = $conn->prepare($query);
            $sql->execute();
            */
            return TRUE;
        }



        // View_Data_Methods database methods
        // [description of what the method does]
        public static function attemptQuestionsPull($courseNumber): array
        {
            /*
			$query = "SELECT * FROM * WHERE ";
			$sql = $conn->prepare($query);
			$sql->execute();
			$copyCheck = $sql->fetchAll();
            */
            return array();
        }
    }
?>