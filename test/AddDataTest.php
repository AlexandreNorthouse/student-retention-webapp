<?php
    declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Professor/Add_Data_Methods.php");

    use PHPUnit\Framework\TestCase;


    class AddDataTest extends TestCase
    {

        public static function tearDownAfterClass(): void
        {
            $conn = DatabaseMethods::setConnVariable();
            $query = "DELETE FROM questions WHERE qtext=\"Example Question1\"; "
                . "DELETE FROM questions WHERE qtext=\"Example Question2\";";
            $sql = $conn->prepare($query);
            $sql->execute();
        }

        public function testAddQuestion()
        {
            $testArray = array(
                "Selected Course" => "1",
                "Question"       => "Example Question1",
                "Answer"         => "Example Answer1"
            );

            $correctArray = array(
                "Outcome" => "Success",
                "Feedback" => array(
                    "The question was successfully added to the course!"
                )
            );
            $this->assertEquals($correctArray, AddDataMethods::addQuestion($testArray),
                "Testing add question method!");
        }

        public function testCheckDuplicate()
        {
            $testArray = array(
                "Selected Course" => "1",
                "Question"       => "Example Question1",
                "Answer"         => "Example Answer1"
            );

            $correctArray = array(
                "Outcome" => "Error",
                "Feedback" => array(
                    "It seems like that question / answer combo already does not exists, please contact your system admin with this not error."
                )
            );
            $this->assertNotEquals($correctArray, AddDataMethods::duplicateQACheck($testArray),
                "Testing  method!");
        }
        
        public function testQAInsertion()
        {
            $testArray = array(
                "Selected Course" => "1",
                "Question"       => "Example Question2",
                "Answer"         => "Example Answer2"
            );

            $correctArray = array();
            
            $this->assertEquals($correctArray, AddDataMethods::attemptQAInsertion($testArray),
                "Testing  method!");
        }

    }
?>