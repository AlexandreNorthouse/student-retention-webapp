<?php
declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Professor/View_Data_Methods.php");

    use PHPUnit\Framework\TestCase;


    class ViewDataTest extends TestCase
    {

        //needs setup method

        public function testAttemptQuestionPull()
        {
            $testArray = array(
                "Selected Course" => "Ex101",
            );

            $correctArray = array();
            $this->assertEquals($correctArray, ViewDataMethods::deleteCourse($testArray),
                "Testing course Delete method!");
        }

        



    }
?>