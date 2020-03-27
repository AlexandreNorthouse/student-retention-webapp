<?php
declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Professor/Student_Enrollment_Methods.php");

    use PHPUnit\Framework\TestCase;


    //Still needs the setup method

    class StudentEnrollmentTest extends TestCase
    {
        public function testAttempStudentRemoval()
        {
            $testArray = array(
                "Course Number" => "1",
                "Student ID" => "1"
            );

            $correctArray = array();
            $this->assertEquals($correctArray, StudentEnrollmentMethods::removeStudent($testArray),
                "Testing Attempt Student Removal method!");
        }

        public function testGetStudents()
        {
            $testArray = array(
                //Not Finished
            );

            $correctArray = array();
            $this->assertEquals($correctArray, StudentEnrollmentMethods::getStudents($testArray),
                "Testing Get Students method!");
        }

    }
?>