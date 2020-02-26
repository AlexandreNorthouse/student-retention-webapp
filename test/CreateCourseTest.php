<?php
    declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Professor/Create_Course_Methods.php");

    use PHPUnit\Framework\TestCase;


    class CreateCourseTest extends TestCase
    {
        public function testCreateCourse()
        {
            $testArray = array(
                "University ID" => "1",
                "Course Number" => "PSYC101",
                "Course Section" => "1",
                "Course Name" => "Intro to Psychology, Section 1",
                "Professor ID" => "1"
            );

            $correctArray = array(
                "Outcome" => "Success",
                "Feedback" => array("The course was successfully added to the university! " .
                "It should now appear in your enrolled courses.")
            );
            $this->assertEquals($correctArray, defaultMethods::createCourse($testArray), "They're the same!");
        }

        public function testDuplicateCourseCheck()
        {
            $testArray = array(
                "University ID" => "1",
                "Course Number" => "PSYC101",
                "Course Section" => "1",
            );

            $correctArray = array();
            $this->assertEquals($correctArray, defaultMethods::duplicateCrseNumSectCheck($testArray), "They're the same!");
        }

        public function testAttempCourseInsertion()
        {
            $testArray = array(
                "University ID" => "1",
                "Course Number" => "PSYC101",
                "Course Section" => "1",
                "Course Name" => "Intro to Psychology, Section 1",
                "Professor ID" => "1"
            );

            $correctArray = array();
            $this->assertNotEquals($correctArray, defaultMethods::attemptCourseInsertion($testArray), "They're the same!");
        }

    }


?>