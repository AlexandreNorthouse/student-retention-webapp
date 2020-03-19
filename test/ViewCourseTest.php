<?php
declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Student/View_Course_Methods.php");

    use PHPUnit\Framework\TestCase;


    class ViewCourseTest extends TestCase
    {

        public function testAttemptCourseWithdraw()
        {
            $testArray = array(
                "Course Number" => "1",
                "Student ID" => "1"
            );

            $correctArray = array();
            $this->assertEquals($correctArray, ViewCoursesMethods::checkCourseExists($testArray),
                "Testing course withdraw method!");
        }



    }