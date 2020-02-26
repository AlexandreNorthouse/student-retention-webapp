<?php
    declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Add_Data_Methods.php");

    use PHPUnit\Framework\TestCase;


    class AddDataTest extends TestCase
    {
        public function testAddQuestion()
        {
            $testArray = array(
                "Selected Course" => "1",
                "Question"       => "Example Question",
                "Answer"         => "Example Answer"
            );

            $correctArray = array(
                "Outcome" => "Success",
                "Feedback" => array(
                    "The question was successfully added to the course"
                )
            );
            $this->assertEquals($correctArray, defaultMethods::addQuestion($testArray), "They're the same!");
        }

        public function testCheckDuplicate()
        {
            $testArray = array(
                "Selected Course" => "1",
                "Question"       => "Example Question",
                "Answer"         => "Example Answer"
            );

            $correctArray = array(
                "Outcome" => "Error",
                "Feedback" => array(
                    "It seems like that question / answer combo already exists, please contact your system admin with this error."
                )
            );
            $this->assertNotEquals($correctArray, defaultMethods::duplicateQACheck($testArray), "They're the same!");
        }
        
        public function testQAInsertion()
        {
            $testArray = array(
                "Selected Course" => "1",
                "Question"       => "Example Question",
                "Answer"         => "Example Answer"
            );

            $correctArray = array();
            
            $this->assertEquals($correctArray, defaultMethods::attemptQAInsertion($testArray), "They're the same!");
        }

    }
?>