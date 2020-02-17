<?php
    declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Default_Mehtods.php");

    use PHPUnit\Framework\TestCase;


    class DefaultMethodsTest extends TestCase
    {

        public function testFormatFields()
        {
            $testArray = array(
                "Test" => "   test   "
            );

            $correctArray = array(
                "Test" => "test"
            );
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

            $this->assertEquals(, defaultMethods::generateReturnArray($outcome, $feedback), "They're the same!");
        }
    }
?>