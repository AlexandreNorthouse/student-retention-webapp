<?php
    declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Professor/ViewCreatedCoursesMethods.php");
    use PHPUnit\Framework\TestCase;

    class ViewCreatedCoursesTest extends TestCase
    {
        public static function setUpBeforeClass(): void
        {
            // no code needed.
        }

        public function testAttemptCourseDeletion()
        {
            $expected = array(
                'Outcome' => 'Success',
                'Feedback' => array("Successfully deleted the course!")
            );

            $testArray = array(
                "Selected Course" => "4"
            );
            $actual = ViewCreatedCoursesMethods::deleteCourse($testArray);
            $this->assertEquals($expected, $actual,
                "The attemptCourseDeletion() method failed.");
        }

        public static function tearDownAfterClass(): void
        {
            // no code needed.
        }
    }
?>