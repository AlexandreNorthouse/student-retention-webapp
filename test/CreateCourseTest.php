<?php
    declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Professor/CreateCourseMethods.php");
    use PHPUnit\Framework\TestCase;

    class CreateCourseTest extends TestCase
    {
        public static function setUpBeforeClass(): void
        {
            // no code needed.
        }

        public function testDuplicateCourseCheck()
        {
            $testArray = array(
                "Course Number" => "EX101",
                "Course Section" => "1",
                "University ID" => "1"
            );

            $errorArray = array(
                "Outcome"  => "Error",
                "Feedback" => array("It seems that course number and section number already exists!"),
            );

            $this->assertEquals($errorArray, CreateCourseMethods::duplicateCrseNumSectCheck($testArray),
                "The duplicateCrseNumSectCheck() has failed.");
        }

        public function testAttempCourseInsertion()
        {
            $testArray = array(
                "Course Number" => "EX999",
                "Course Section" => "1",
                "Course Name" => "Test Course",
                "University ID" => "1",
                "Professor ID" => "1"
            );

            $correctArray = array();

            $this->assertEquals($correctArray, CreateCourseMethods::attemptCourseInsertion($testArray),
                "The attemptCourseInsertion() method failed.");
        }

        public static function tearDownAfterClass(): void
        {
            $conn = DatabaseMethods::setConnVariable();
            $query = "DELETE FROM courses WHERE crseID=\"EX999\"";
            $sql = $conn->prepare($query);
            $sql->execute();
            $conn = null;
        }
    }
?>