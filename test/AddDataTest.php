<?php
    declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Professor/Add_Data_Methods.php");

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
            $this->assertEquals($correctArray, Add_Data_Methods::addQuestion($testArray), "They're the same!");
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
            $this->assertNotEquals($correctArray, Add_Data_Methods::duplicateQACheck($testArray), "They're the same!");
        }
        
        public function testQAInsertion()
        {
            $testArray = array(
                "Selected Course" => "1",
                "Question"       => "Example Question",
                "Answer"         => "Example Answer"
            );

            $correctArray = array();
            
            $this->assertEquals($correctArray, Add_Data_Methods::attemptQAInsertion($testArray), "They're the same!");
        }

    }
?>