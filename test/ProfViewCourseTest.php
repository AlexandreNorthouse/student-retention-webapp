<?php
declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Professor/View_Course_Methods.php");

    use PHPUnit\Framework\TestCase;


    class ViewCourseTest extends TestCase
    {

        //needs setup method

        public function testDeleteCourse()
        {
            $testArray = array(
                "Course Number" => "1"
                
            );

            $correctArray = array();
            $this->assertEquals($correctArray, ViewCoursesMethodsProf::deleteCourse($testArray),
                "Testing course Delete method!");
        }



    }
?>