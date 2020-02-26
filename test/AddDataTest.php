<?php
    declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Add_Data_Methods.php");

    use PHPUnit\Framework\TestCase;


    class AddDataTest extends TestCase
    {
        public function testAddQuestion()
        {
            $testArray = array(
                "Selected Course" => "Ex101",
                "Question"       => "",//add Data Here,
                "Answer"         => ""//add data here
            );

            $correctArray = array();
            $this->assertEquals($correctArray, defaultMethods::addQuestion($testArray), "They're the same!");
        }

        public function testCheckDuplicate()
        {
            $testArray = array(
                "Selected Course" => "Ex101",
                "Question"       => "",//add Data Here,
                "Answer"         => ""//add data here
            );

            $correctArray = array();
            $this->assertEquals($correctArray, defaultMethods::duplicateQACheck($testArray), "They're the same!");
        }

        public function testQAInsertion()
        {
            $testArray = array(
                "Selected Course" => "Ex101",
                "Question"       => "",//add Data Here,
                "Answer"         => ""//add data here
            );

            $correctArray = array();
            $this->assertEquals($correctArray, defaultMethods::attemptQAInsertion($testArray), "They're the same!");
        }

    }
?>