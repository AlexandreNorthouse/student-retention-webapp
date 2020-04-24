<?php
	class DatabaseMethods {

	    // default method layout:
        /*

        // [description of what the method does]
        public static function asdf(asdf $asdf): asdf
        {
            /*
            try {
                $conn = DatabaseMethods::setConnVariable();
                $query = "";
                $sql = $conn->prepare($query);
                $sql->execute();
                $class = $sql->fetchAll();

                if ()
                    return FALSE;
            } catch (PDOException $e) {

            }
           /*
        }
        */



        // ==================================================================================================== //
        // ==================================================================================================== //
        // Universally used methods

        // Creates the conn variable for the below methods to use.
        public static function setConnVariable()
        {
            require(dirname(__FILE__, 2) . "\database\DatabaseVariables.php");
            $conn = new PDO("mysql:host=$serverName;dbname=$dbName", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }

        // Returns an array of courses a user is enrolled in; returns empty array if there are none.
        public static function getEnrolledCourses(string $userID): array
        {
            try {
                $conn = DatabaseMethods::setConnVariable();
                $query = "SELECT c.ID, c.crseID, c.sectNum, c.crseName FROM "
                    . "courses c, coursesusersroster cur WHERE c.ID=cur.crseID AND cur.userID=:userID";
                $sql = $conn->prepare($query);
                $sql->bindParam(':userID', $userID);
                $sql->execute();
                return $sql->fetchAll();
            } catch (PDOException $e) {
                return array();
            }
        }

        // Returns an array of enrolled courses with their professors' names; returns empty array if there are none.
        public static function getEnrolledCoursesAndProfessorNames($userID): array
        {
            try {
                $conn = DatabaseMethods::setConnVariable();
                $query = "SELECT c.ID, c.crseID, c.sectNum, c.crseName, p.fname, p.lname "
                    . "FROM courses c, coursesusersroster cur1, coursesusersroster cur2, users p "
                    . "WHERE (c.ID=cur1.crseID AND cur1.userID=:userID) AND "
                    . "(cur1.crseID=cur2.crseID AND cur2.userID=p.ID AND p.isProf=1)";
                $sql = $conn->prepare($query);
                $sql->bindParam(':userID', $userID);
                $sql->execute();
                return $sql->fetchAll();
            } catch (PDOException $e) {
                return array();
            }
        }

        // Attempts to insert row into "coursesusersroster"; returns TRUE for success, FALSE otherwise.
        public static function attemptCourseUserRelationshipInsertion(string $courseID, string $userID): bool
        {
            try {
                $conn = DatabaseMethods::setConnVariable();
                $query = "INSERT INTO coursesusersroster VALUES (:courseID, :userID)";
                $sql = $conn->prepare($query);
                $sql->bindParam(':courseID', $courseID);
                $sql->bindParam(':userID', $userID);
                $sql->execute();
                return TRUE;
            } catch (PDOException $e) {
                return FALSE;
            }
        }



        // ==================================================================================================== //
        // ==================================================================================================== //
        // DEFAULT USER METHODS:
        // Login methods

        // Attempts to log the user in; returns array of user data on success, empty array otherwise.
        public static function attemptLogin(string $username, string $password): array
        {
            try {
                $conn = DatabaseMethods::setConnVariable();
                $query = "SELECT * FROM users WHERE username=:username";
                $sql = $conn->prepare($query);
                $sql->bindParam(':username', $username);
                $sql->execute();
                $user = $sql->fetchAll();

                if (!empty($user)) {
                    if (password_verify($password, $user[0]['password'])) {
                        return $user[0];
                    }
                }
                return array();
            } catch (PDOException $e) {
                return array();
            }
        }




        // Register methods

        // Checks database for university / username combo; returns TRUE if exists, FALSE otherwise.
        public static function duplicateUsernameCheck(string $username, string $uniID): bool
        {
            try {
                $conn = DatabaseMethods::setConnVariable();
                $query = "SELECT * FROM users WHERE uniID=:uniID AND username=:username";
                $sql = $conn->prepare($query);
                $sql->bindParam(':uniID', $uniID);
                $sql->bindParam(':username', $username);
                $sql->execute();

                if (empty($sql->fetchALL())) return FALSE;
                return TRUE;
            } catch (PDOException $e) {
                return FALSE;
            }
        }

        // Attempts to insert the user into the database; returns TRUE for success, FALSE for failure.
        public static function attemptUserInsertion(string $username, string $password, string $uniID,
            string $fName, string $lName, string $isProf): bool
        {
            try {
                $conn = DatabaseMethods::setConnVariable();
                $query = "INSERT INTO users VALUES ".
                    "(NULL, :uniID, :username, :password, :fName, :lName, :isProf)";
                $sql = $conn->prepare($query);
                $sql->bindParam(':username', $username);
                $sql->bindParam(':password', $password);
                $sql->bindParam(':uniID', $uniID);
                $sql->bindParam(':fName', $fName);
                $sql->bindParam(':lName', $lName);
                $sql->bindParam(':isProf', $isProf);
                $conn->exec($query);

                echo ($conn->lastInsertID());
                return TRUE;
            } catch (PDOException $e) {
                return FALSE;
            }
        }



        // ==================================================================================================== //
        // ==================================================================================================== //
        // STUDENT METHODS:
        // Add_Course database methods

        // Checks the database for a provided course ID; returns TRUE if it exists, FALSE otherwise.
		public static function checkCourseExists(string $courseNumber): bool
        {
			try {
                $conn = DatabaseMethods::setConnVariable();
				$query = "SELECT ID FROM courses WHERE ID=:courseNumber";
                $sql = $conn->prepare($query);
                $sql->bindParam(':courseNumber', $courseNumber);
				$sql->execute();

				if (empty($sql->fetchAll()))
					return FALSE;
				return TRUE;
			} catch (PDOException $e) {
				return FALSE;
			}
		}

        // Checks database for user / course combo; returns FALSE if not enrolled, TRUE otherwise.
        public static function checkEnrollment(string $courseNumber, string $studentID): bool
        {
            try {
                $conn = DatabaseMethods::setConnVariable();
                $query = "SELECT * FROM coursesusersroster WHERE crseID=:courseNumber AND userID=:studentID";
                $sql = $conn->prepare($query);
                $sql->bindParam(':courseNumber', $courseNumber);
                $sql->bindParam(':studentID', $studentID);
                $sql->execute();

                if (!empty($sql->fetchAll()))
                    return TRUE;
                return FALSE;
            } catch (PDOException $e) {
                return TRUE;
            }
        }

        // Attempts to insert row into coursesusersroster; returns TRUE for success, FALSE for failure.
        public static function attemptStudentInsertion(string $courseNumber, string $userID): bool
        {
            try {
                $conn = DatabaseMethods::setConnVariable();
                $query = "INSERT INTO coursesusersroster VALUES (:courseNumber, :userID)";
                $sql = $conn->prepare($query);
                $sql->bindParam(':courseNumber', $courseNumber);
                $sql->bindParam(':userID', $userID);
                $sql->execute();
                return TRUE;
            } catch (PDOException $e) {
                return FALSE;
            }
        }




        // Chatbot_Methods database methods

        // This is where a method would go... IF IT HAD ONE!




        // Add_Data database methods

        // Checks database for course / question combo; returns TRUE if it exists, FALSE otherwise.
        public static function duplicateQACheck(string $question, string $answer, string $selectedCourse): bool
        {
            try {
                $conn = DatabaseMethods::setConnVariable();
                $query = "SELECT * FROM questions WHERE crseID=:selectedCourse AND qtext=:question";
                $sql = $conn->prepare($query);
                $sql->bindParam(':selectedCourse', $selectedCourse);
                $sql->bindParam(':question', $question);
                $sql->execute();

                if (empty($sql->fetchAll()))
                    return FALSE;
                else
                    return TRUE;
            } catch (PDOException $e) {
                return TRUE;
            }
        }

        // Attempts to insert row into questions; returns TRUE for success, FALSE otherwise.
        public static function attemptQAInsertion(string $question, string $answer, string $selectedCourse): bool
        {
            try {
                $conn = DatabaseMethods::setConnVariable();
                $query = "INSERT INTO questions VALUES (NULL, :selectedCourse, :question, :answer)";
                $sql = $conn->prepare($query);
                $sql->bindParam(':selectedCourse', $selectedCourse);
                $sql->bindParam(':question', $question);
                $sql->bindParam(':answer', $answer);
                $sql->execute();

                return TRUE;
            } catch (PDOException $e) {
                return FALSE;
            }
        }




        // View_Courses database methods

        // Attempts to delete row in coursesusersroster; returns TRUE for success, FALSE for failure.
        public static function attemptCourseWithdraw($courseNumber, $studentID)
        {
            try {
                $conn = DatabaseMethods::setConnVariable();
                $query = "DELETE FROM coursesusersroster WHERE crseID=:courseNumber AND userID=:studentID";
                $sql = $conn->prepare($query);
                $sql->bindParam(':courseNumber', $courseNumber);
                $sql->bindParam(':studentID', $studentID);
                $sql->execute();
                return TRUE;
            } catch (PDOException $e) {
                return FALSE;
            }
        }



        // ==================================================================================================== //
        // ==================================================================================================== //
        // PROFESSOR METHODS:
        // Create_Course database methods

        // Checks database for course number / section combo; returns TRUE if it exists, FALSE otherwise.
        public static function duplicateCrseNumSectCheck(string $courseNumber, string $courseSection,
            string $universityID): bool
        {
            try {
                $conn = DatabaseMethods::setConnVariable();
                $query = "SELECT * FROM courses WHERE uniID=:universityID AND crseID=:courseNumber " .
                    "AND sectNum=:courseSection";
                $sql = $conn->prepare($query);
                $sql->bindParam(':courseNumber', $courseNumber);
                $sql->bindParam(':courseSection', $courseSection);
                $sql->bindParam(':universityID', $universityID);
                $sql->execute();

                if (empty($sql->fetchAll()))
                    return FALSE;
                else
                    return TRUE;
            } catch (PDOException $e) {
                return TRUE;
            }
        }

        // Attempts to insert row into courses; returns course ID for success, empty return otherwise.
        public static function attemptCourseInsertion(string $courseNumber, string $courseSection, string $courseName,
            string $universityID): ?int
        {
            try {
                $conn = DatabaseMethods::setConnVariable();
                $query = "INSERT INTO courses VALUES ".
                    "(NULL, :universityID, :courseNumber, :courseSection, :courseName)";
                $sql = $conn->prepare($query);
                $sql->bindParam(':universityID', $universityID);
                $sql->bindParam(':courseNumber', $courseNumber);
                $sql->bindParam(':courseSection', $courseSection);
                $sql->bindParam(':courseName', $courseName);
                $sql->execute();

                return $conn->lastInsertID();
            } catch (PDOException $e) {
                return null;
            }
        }




        // Create_Syllabus database methods

        // Database check for a syllabus with that courseID; returns syllabus array if it exists, empty array otherwise.
        public static function checkSyllabusExists ($courseID): array
        {
            try {
                $conn = DatabaseMethods::setConnVariable();
                $query = "SELECT courseTitle, contactInformation, officeHoursPolicy, courseDescription, "
                    . "courseGoals, requiredMaterials, gradingPolicy, attendancePolicy, universityPolicy, "
                    . "studentResources FROM syllabi WHERE crseID=:courseID";
                $sql = $conn->prepare($query);
                $sql->bindParam(':courseID', $courseID);
                $sql->execute();
                $variable = $sql->fetchAll();
                return $variable;
            } catch (PDOException $e) {
                return array();
            }
        }

        // Attempts to insert row into syllabi; returns TRUE for success, FALSE otherwise
        public static function attemptSyllabusInsertion(string $courseID, string $courseTitle, string $contactInfo,
            string $officeHours, string $courseDesc, string $courseGoals, string $reqMaterials, string $grading,
            string $attendance, string $uniPolicies, string $stuResources): bool
        {
            try {
                $conn = DatabaseMethods::setConnVariable();
                $query = "INSERT INTO syllabi VALUES (NULL, :courseID, :courseTitle, :contactInfo, :officeHours,"
                    . " :courseDesc, :courseGoals, :reqMaterials, :grading, :attendance,"
                    . " :uniPolicies, :stuResources)";
                $sql = $conn->prepare($query);
                $sql->bindParam(':courseID', $courseID);
                $sql->bindParam(':courseTitle', $courseTitle);
                $sql->bindParam(':contactInfo', $contactInfo);
                $sql->bindParam(':officeHours', $officeHours);
                $sql->bindParam(':courseDesc', $courseDesc);
                $sql->bindParam(':courseGoals', $courseGoals);
                $sql->bindParam(':reqMaterials', $reqMaterials);
                $sql->bindParam(':grading', $grading);
                $sql->bindParam(':attendance', $attendance);
                $sql->bindParam(':uniPolicies', $uniPolicies);
                $sql->bindParam(':stuResources', $stuResources);
                $sql->execute();
                return TRUE;
            } catch (PDOException $e) {
                return FALSE;
            }
        }

        // Attempts to update a syllabus; returns TRUE if successful, FALSE otherwise.
        public static function attemptSyllabusUpdate(string $courseID, string $courseTitle, string $contactInfo,
            string $officeHours, string $courseDesc, string $courseGoals, string $reqMaterials, string $grading,
            string $attendance, string $uniPolicies, string $stuResources): bool
        {
            try {
                $conn = DatabaseMethods::setConnVariable();
                $query = "UPDATE syllabi "
                    . "SET courseTitle=:courseTitle, contactInformation=:contactInfo, "
                        . "officeHoursPolicy=:officeHours, courseDescription=:courseDesc, "
                        . "courseGoals=:courseGoals, requiredMaterials=:reqMaterials, "
                        . "gradingPolicy=:grading, attendancePolicy=:attendance, "
                        . "universityPolicy=:uniPolicies, studentResources=:stuResources "
                    . "WHERE crseID=:courseID";
                $sql = $conn->prepare($query);
                $sql->bindParam(':courseID', $courseID);
                $sql->bindParam(':courseTitle', $courseTitle);
                $sql->bindParam(':contactInfo', $contactInfo);
                $sql->bindParam(':officeHours', $officeHours);
                $sql->bindParam(':courseDesc', $courseDesc);
                $sql->bindParam(':courseGoals', $courseGoals);
                $sql->bindParam(':reqMaterials', $reqMaterials);
                $sql->bindParam(':grading', $grading);
                $sql->bindParam(':attendance', $attendance);
                $sql->bindParam(':uniPolicies', $uniPolicies);
                $sql->bindParam(':stuResources', $stuResources);
                $sql->execute();
                return TRUE;
            } catch (PDOException $e) {
                return FALSE;
            }
        }

        // Attempts to delete a syllabus; returns TRUE if successful, FALSE otherwise.
        public static function attemptSyllabusDeletion($courseID)
        {
            try {
                $conn = DatabaseMethods::setConnVariable();
                $query = "DELETE FROM syllabi WHERE crseID=:courseID";
                $sql = $conn->prepare($query);
                $sql->bindParam(':courseID', $courseID);
                $sql->execute();
                return TRUE;
            } catch (PDOException $e) {
                return FALSE;
            }
        }




        // View_Data database methods

        // Attempts to pull a courses' questions; returns array of questions if they exist, empty array otherwise.
        public static function attemptQuestionsPull($courseID): array
        {
            try {
                $conn = DatabaseMethods::setConnVariable();
                $query = "SELECT q.ID, q.qtext, q.atext FROM questions q WHERE q.crseID=:courseID";
                $sql = $conn->prepare($query);
                $sql->bindParam(':courseID', $courseID);
                $sql->execute();
                return $sql->fetchAll();
            } catch (PDOException $e) {
                return array();
            }
        }

        // Attempts to update a question's text; returns TRUE if successful, FALSE otherwise.
        public static function attemptQuestionUpdate($quesID, $updateQText, $updateAText): bool
        {
            try {
                $conn = DatabaseMethods::setConnVariable();
                $query = "UPDATE questions "
                    . "SET qtext=:updateQText, atext=:updateAText "
                    . "WHERE ID=:quesID";
                $sql = $conn->prepare($query);
                $sql->bindParam(':quesID', $quesID);
                $sql->bindParam(':updateQText', $updateQText);
                $sql->bindParam(':updateAText', $updateAText);
                $sql->execute();
                return TRUE;
            } catch (PDOException $e) {
                return FALSE;
            }
        }

        // Attempts to delete a question; returns TRUE if successful, FALSE otherwise.
        public static function attemptQuestionDelete($quesID)
        {
            try {
                $conn = DatabaseMethods::setConnVariable();
                $query = "DELETE FROM questions WHERE ID=:quesID";
                $sql = $conn->prepare($query);
                $sql->bindParam(':quesID', $quesID);
                $sql->execute();
                return TRUE;
            } catch (PDOException $e) {
                return FALSE;
            }
        }




        //  database methods

        // Attempts to delete row in courses; returns TRUE for success, FALSE for failure.
        public static function attemptCourseDeletion($courseNumber): bool
        {
            try {
                $conn = DatabaseMethods::setConnVariable();
                $query = "DELETE FROM courses WHERE ID=:courseNumber";
                $sql = $conn->prepare($query);
                $sql->bindParam(':courseNumber', $courseNumber);
                $sql->execute();
                return TRUE;
            } catch (PDOException $e) {
                return FALSE;
            }
        }




        //  database methods

        // Attempts to get students enrolled in a course; returns array of students for success, empty array otherwise.
        public static function getStudents($courseNumber): array
        {
            try {
                $conn = DatabaseMethods::setConnVariable();
                $query = "SELECT s.ID, s.fname, s.lname FROM coursesusersroster cur, users s "
                    . " WHERE cur.crseID=:courseNumber AND s.ID=cur.userID and s.isProf=0";
                $sql = $conn->prepare($query);
                $sql->bindParam(':courseNumber', $courseNumber);
                $sql->execute();
                return $sql->fetchAll();
            } catch (PDOException $e) {
                return array();
            }
        }

        // Attempts to delete a row in coursesusersoster; returns TRUE for success, FALSE for failure.
        public static function attemptStudentRemoval($courseNumber, $studentID)
        {
            try {
                $conn = DatabaseMethods::setConnVariable();
                $query = "DELETE FROM coursesusersroster WHERE crseID=:courseNumber AND userID=:studentID";
                $sql = $conn->prepare($query);
                $sql->bindParam(':courseNumber', $courseNumber);
                $sql->bindParam(':studentID', $studentID);
                $sql->execute();
                return TRUE;
            } catch (PDOException $e) {
                return FALSE;
            }
        }

        // ==================================================================================================== //
        // ==================================================================================================== //
    }
?>