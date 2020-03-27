<?php
    declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Professor/AddDataMethods.php");
    use PHPUnit\Framework\TestCase;

    class AddDataTest extends TestCase
    {
        public static function setUpBeforeClass(): void
        {
            //no code needed.
        }

        public function testCheckDuplicate()
        {
            $testArray = array(
                "Question"        => "What's the capital of Indiana?",
                "Answer"          => "The capital of Indiana is Indianapolis.",
                "Selected Course" => "1"
            );

            $correctArray = array(
                "Outcome" => "Error",
                "Feedback" => array("It seems like that question / answer combo already exists, "
                    . "please contact your system admin with this error.")
            );

            $this->assertNotEquals($correctArray, AddDataMethods::duplicateQACheck($testArray),
                "The duplicateQACheck() method failed.");
        }
        
        public function testQAInsertion()
        {
            $testArray = array(
                "Selected Course" => "1",
                "Question"        => "Example Question",
                "Answer"          => "Example Answer"
            );

            $correctArray = array();
            
            $this->assertEquals($correctArray, AddDataMethods::attemptQAInsertion($testArray),
                "The attemptQAInsertion() method failed.");
        }

        public static function tearDownAfterClass(): void
        {
            $conn = DatabaseMethods::setConnVariable();
            $query = "DELETE FROM questions WHERE qtext=\"Example Question\"";
            $sql = $conn->prepare($query);
            $sql->execute();
            $conn = null;
        }
    }
?>