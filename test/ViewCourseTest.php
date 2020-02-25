<?php
declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/View_Course_Methods.php");

    use PHPUnit\Framework\TestCase;


    class ViewCourseTest extends TestCase
    {
        public function testDropCourse()
        {
            $testArray = array(
                "Selected Course" => "Ex101",
                "Student ID" => "1"
            );

            $correctArray = array();
            $this->assertEquals($correctArray, defaultMethods::dropCourse($testArray), "They're the same!");
        }

        public function testAttemptCourseWithdraw()
        {
            $testArray = array(
                "Selected Course" => "Ex101",
                "Student ID" => "1"
            );

            $correctArray = array();
            $this->assertEquals($correctArray, defaultMethods::attemptCourseWithdraw($testArray), "They're the same!");
        }
    }

?>