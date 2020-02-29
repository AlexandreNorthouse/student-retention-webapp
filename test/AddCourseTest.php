<?php
declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Student/Add_Course_Methods.php");

    use PHPUnit\Framework\TestCase;


    class AddCourseTest extends TestCase
    {

        public static function setUpBeforeClass(): void
        {
            $conn = DatabaseMethods::setConnVariable();
            $query = "DELETE FROM coursesusersroster WHERE crseID=1 AND userID=1;";
            $sql = $conn->prepare($query);
            $sql->execute();
        }

        public function testCheckCourseExists()
        {
            $testArray = array(
                "Course Number" => "1"
            );

            $correctArray = array();
            $this->assertEquals($correctArray, AddCourseMethods::checkCourseExists($testArray),
                "Testing course check method!");
        }


        public function testCheckIfNotEnrolled()
        {
            $testArray = array(
                "Course Number" => "1",
                "Student ID" => "1"
            );

            $correctArray = array();
            $this->assertEquals($correctArray, AddCourseMethods::checkIfNotEnrolled($testArray),
                "Testing check enrollment method!");
        }

        
        public function testAttemptStudentInsertion()
        {
            $testArray = array(
                "Course Number" => "1",
                "Student ID" => "1"
            );

            $correctArray = array();
            $this->assertEquals($correctArray, AddCourseMethods::attemptStudentEnrollment($testArray),
                "Testing student insertion method!");
        }
        
    }


?>