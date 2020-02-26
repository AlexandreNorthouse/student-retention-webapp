<?php
    declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Student/View_Data_Methods.php");

    use PHPUnit\Framework\TestCase;


    class ViewDataTest extends TestCase
    {
        public function testViewCourse()
        {
            $testArray = array(
                "Selected Course" => "1",
            );

            $correctArray = array();
            $this->assertEquals($correctArray, View_Data_Methods::viewCourse($testArray), "They're the same!");
        }
    

        public function testAttemptQuestionPull()
        {
            $testArray = array(
                "Selected Course" => "1",
            );

            $correctArray = array();
            $this->assertEquals($correctArray, View_Data_Methods::attemptQuestionPull($testArray), "They're the same!");
        }
    }
?>