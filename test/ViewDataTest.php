<?php
declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Professor/ViewDataMethods.php");

    use PHPUnit\Framework\TestCase;


    class ViewDataTest extends TestCase
    {
        public static function setUpBeforeClass(): void
        {
            // no code needed
        }

        public function testAttemptQuestionPull()
        {
            $expected = array (
                0 => array(
                    "ID"    => "3",
                    0       => "3",
                    "qtext" => "Whats the capital of Michigan",
                    1       => "Whats the capital of Michigan",
                    "atext" => "The capital of Michigan is Detroit.",
                    2       => "The capital of Michigan is Detroit.",
                ),
                1 => array(
                    "ID"    => "4",
                    0       => "4",
                    "qtext" => "What section of EX101 is this",
                    1       => "What section of EX101 is this",
                    "atext" => "This is section 2 of EX101.",
                    2       => "This is section 2 of EX101.",
                ),
                2 => array(
                    "ID"    => "5",
                    0       => "5",
                    "qtext" => "asdf",
                    1       => "asdf",
                    "atext" => "asdf",
                    2       => "asdf",
                )
            );

            $testArray = array(
                "Selected Course" => "2"
            );
            $actual = ViewDataMethods::attemptQuestionsPull($testArray);
            $this->assertEquals($expected, $actual,
                "The attemptQuestionsPull() method failed.");
        }

        public function testAttemptDataUpdate()
        {
            $expected = array();

            $testArray = array(
                "Selected Question" => "5",
                "Update Question"   => "Are dogs canines?",
                "Update Answer"     => "Yes"
            );
            $actual = ViewDataMethods::attemptDataUpdate($testArray);
            $this->assertEquals($expected, $actual,
                "The attemptQuestionsUpdate() method failed.");
        }

        public function testAttemptDataDelete()
        {
            $expected = array(
                'Outcome' => 'Success',
                'Feedback' => array("Question successfully deleted!")
            );

            $testArray = array(
                'Selected Question' => 5
            );
            $actual = ViewDataMethods::attemptDataDelete($testArray);
            $this->assertEquals($expected, $actual,
                "The attemptQuestionsDelete() method failed.");
        }

        public static function tearDownAfterClass(): void
        {
            // no code needed.
        }
    }
?>