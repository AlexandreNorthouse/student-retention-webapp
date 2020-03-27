<?php
declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Student/AddCourseMethods.php");

    use PHPUnit\Framework\TestCase;


    class AddCourseTest extends TestCase
    {
        public static function setUpBeforeClass(): void
        {
            $conn = DatabaseMethods::setConnVariable();
            $query = "DELETE FROM coursesusersroster WHERE crseID=1 AND userID=1;";
            $sql = $conn->prepare($query);
            $sql->execute();
            $conn = null;
        }

        public function testCheckCourseExists()
        {
            $expected = array();

            $testArray = array(
                "Course Number" => "1"
            );
            $actual = AddCourseMethods::checkCourseExists($testArray);
            $this->assertEquals($expected, $actual,
                "The checkCourseExists() method failed.");
        }

        public function testCheckIfNotEnrolled()
        {
            $expected = array();

            $testArray = array(
                "Course Number" => "1",
                "Student ID" => "1"
            );
            $actual = AddCourseMethods::checkIfNotEnrolled($testArray);
            $this->assertEquals($expected, $actual,
                "The checkCourseExists() method failed.");
        }
        
        public function testAttemptStudentInsertion()
        {
            $expected = array();

            $testArray = array(
                "Course Number" => "1",
                "Student ID" => "1"
            );
            $actual = AddCourseMethods::attemptStudentEnrollment($testArray);
            $this->assertEquals($expected, $actual,
                "The checkCourseExists() method failed.");
        }

        public static function tearDownAfterClass(): void
        {
            // no code needed.
        }
    }
?>