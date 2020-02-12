<?php

    session_start();
    require_once( dirname(__FILE__, 3) . "\logic\Database_Methods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Default_Methods.php" );

    $feedback = AddCourseMethods::addCourse();
    foreach ($feedback as $fb) echo $fb . "<br>";

    class AddCourseMethods {

        private $feedback = "";

        public static function addCourse(): array {
            //DefaultMethods::checkLogin();

            // this sets the variables needed for this method.
            $self = new AddCourseMethods();
            //$userID = $_SESSION['userID'];
            //$courseNumber = ($_POST['courseNumber']);

            //DefaultMethods::formatFields(); // and formats them

            if ($self->checkCourseDoesNotExist()) 
                return array (FALSE, $feedback);

            if ($self->checkAlreadyEnrolled()) 
                return array (FALSE, $feedback);

            if (!$self->insertStudent()) 
                return array (FALSE, $feedback);
            
            $self->feedback = "You're now successfully signed up for that course!";
            return array (TRUE, $self->feedback);
        }

        // methods

        private function checkCourseDoesNotExist() {
            /*if (!DatabaseMethods::checkClassExists($courseNumber)) {
                $feedback[] = "That course number doesn't exist!";
            }*/
            $this->feedback = "That course number doesn't exist!";
            return FALSE;
        }

        private function checkAlreadyEnrolled() {
            /*if (DatabaseMethods::checkEnrollment($courseNumber, $userID)) {
                $feedback[] = "You're already enrolled in that class!";
            }*/
            $this->feedback = "You're already enrolled in that class!";
            return FALSE;
        }

        private function insertStudent() {
            /*if (DatabaseMethods::checkEnrollment($courseNumber, $userID)) {
                $feedback[] = "You're already enrolled in that class!";
            }*/
            $this->feedback = "The signup failed for some reason, try again in a few moments.";
            return TRUE;
        }

    }

?>