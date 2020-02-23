<?php
    declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Default_Methods.php");

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
            $userID = "BrendenJones12";

            $correctIDArray = array(
                "UserID" => "BrendenJones12"
            );

            $this->assertEquals($correctIDArray, defaultMethods::ggetEnrolledCourses(), "They're the same!");
        }

    }
?>