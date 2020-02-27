<?php
declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Student/Add_Course_Methods.php");

    use PHPUnit\Framework\TestCase;


    class AddCourseTest extends TestCase
    {
        public function testCheckCourseExists()
        {
            $testArray = array(
                "Course Number" => "1"
            );

            $correctArray = array();
            $this->assertEquals($correctArray, AddCourseMethods::checkCourseExists($testArray), "They're the same!");
        }


        public function testCheckIfNotEnrolled()
        {
            $testArray = array(
                "Course Number" => "1",
                "Student ID" => "1"
            );

            $correctArray = array();
            $this->assertEquals($correctArray, AddCourseMethods::checkIfNotEnrolled($testArray), "They're the same!");
        }

        
        public function testAttemptStudentInsertion()
        {
            $testArray = array(
                "Course Number" => "1",
                "Student ID" => "1"
            );

            $correctArray = array();
            $this->assertEquals($correctArray, AddCourseMethods::attemptStudentEnrollment($testArray), "They're the same!");
        }
        
    }


?>