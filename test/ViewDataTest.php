<?php
declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Professor/View_Data_Methods.php");

    use PHPUnit\Framework\TestCase;


    class ViewDataTest extends TestCase
    {

        

        public function testAttemptQuestionPull()
        {
            $testArray = array(
                "Selected Course" => "Ex101"
            );

            $correctArray = array();
            $this->assertEquals($correctArray, ViewDataMethods::deleteCourse($testArray),
                "Testing Question Pull method!");
        }

        public function testAttemptDataUpdate()
        {
            $testArray = array(
            "Selected Question" => "1",
            "Update Question" =>"The dog is red",
            "Update Answer" => "Yes"
            );

            $correctArray = array(
            "Selected Question" => "1",
            "Update Question" =>"The dog is red",
            "Update Answer" => "No"
            );
            $this->assertNotEquals($correctArray, ViewDataMethods::attemptDataUpdate($testArray),
                "Testing Attempt Update method!");
        }

        public function testAttemptDataDelete()
        {
            $testArray = array(
                "Selected Question" => "1"
            );

            $correctArray = array();
            $this->assertEquals($correctArray, ViewDataMethods::attemptDataDelete($testArray),
                "Testing Attempt Data Delete method!");
        }


    }
?>