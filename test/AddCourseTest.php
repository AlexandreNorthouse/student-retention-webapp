<?php
declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Add_Course_Methods.php");

    use PHPUnit\Framework\TestCase;


    class AddCourseTest extends TestCase
    {
        public function testCheckCourseExists()
        {
            $testArray = array(
                "Course Number" => "1"
            );

            $correctArray = array();
            $this->assertEquals($correctArray, defaultMethods::checkCourseExists($testArray), "They're the same!");
        }


        public function testCheckIfNotEnrolled()
        {
            $testArray = array(
                "Course Number" => "1",
                "Student ID" => "1"
            );

            $correctArray = array();
            $this->assertEquals($correctArray, defaultMethods::checkIfNotEnrolled($testArray), "They're the same!");
        }

        //Work on this more later
        /*public function testAttemptStudentInsertion()
        {
            $testArray = array(
                "Course Number" => "1",
                "Student ID" => "1"
            );

            $correctArray = array();
            $this->assertEquals($correctArray, defaultMethods::attemptStudentInsertion($testArray), "They're the same!");
        }*/

        
    }


?>