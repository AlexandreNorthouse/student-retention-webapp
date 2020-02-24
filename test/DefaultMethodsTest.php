<?php
    declare(strict_types=1);
require_once(dirname(__FILE__, 2) . "/logic/Default_Methods.php");
require_once(dirname(__FILE__, 2) . "/logic/Database_Methods.php");

    use PHPUnit\Framework\TestCase;


    class DefaultMethodsTest extends TestCase
    {

        public function testFormatFields()
        {
            $testArray = array(
                "Test" => "   test   "
            );

            $correctArray = array();

            $this->assertEquals($correctArray, defaultMethods::formatFields($testArray), "They're the same!");
        }

        public function testGenerateReturnArray()
        {
            $outcome = "Error";
            $feedback = array("This is a test");


            $correctArray = array(
                "Outcome" => "Error",
                "Feedback" => array("This is a test")
            );

            $this->assertEquals($correctArray, defaultMethods::generateReturnArray($outcome, $feedback), "They're the same!");
        }

        public function testGetEnrolledCourse()
        {
            $_SESSION['userID'] = 1;

            $class1 = array(
                "ID" => '1',
                "crseID" => "EX101",
                "sectNum" => '1',
                "crseName" => "Example Course, Section 1",
                "0" => '1',
                "1" => "EX101",
                "2" => '1',
                "3" => "Example Course, Section 1"
            );

            $class2 = array(
                "ID" => '2',
                "crseID" => "EX101",
                "sectNum" => '2',
                "crseName" => "Example Course, Section 2",
                "0" => '1',
                "1" => "EX101",
                "2" => '2',
                "3" => "Example Course, Section 2"
            );

            $correctIDArray = array(
                0 => $class1,
                1 => $class2
            );

            $this->assertEquals($correctIDArray, defaultMethods::getEnrolledCourses(), "They're the same!");
        }

    }
?>