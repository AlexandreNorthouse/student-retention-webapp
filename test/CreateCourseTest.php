<?php
    declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Create_Course_Methods.php");

    use PHPUnit\Framework\TestCase;


    class CreateCourseTest extends TestCase
    {
        public function testCreateCourse()
        {
            $testArray = array(
                "University ID" => "",
                "Course Number" => "",
                "Course Section" => "",
                "Course Name" => "",
                "Professor ID" => ""//Add data
            );

            $correctArray = array();
            $this->assertEquals($correctArray, defaultMethods::createCourse($testArray), "They're the same!");
        }

    }
?>