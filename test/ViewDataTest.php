<?php
declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Professor/View_Data_Methods.php");

    use PHPUnit\Framework\TestCase;


    class ViewCourseTest extends TestCase
    {

        //needs setup method

        public function testDeleteCourse()
        {
            $testArray = array(
                //not finished
                
            );

            $correctArray = array();
            $this->assertEquals($correctArray, ViewDataMethods::deleteCourse($testArray),
                "Testing course Delete method!");
        }



    }
?>