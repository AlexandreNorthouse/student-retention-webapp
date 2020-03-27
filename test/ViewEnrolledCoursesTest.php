<?php
    declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Student/ViewEnrolledCoursesMethods.php");
    use PHPUnit\Framework\TestCase;

    class ViewEnrolledCoursesTest extends TestCase
    {
        public static function setUpBeforeClass(): void
        {
            // no code needed.
        }

        public function testAttemptCourseWithdraw()
        {
            $expected = array(
                'Outcome' => 'Success',
                'Feedback' => array("Successfully withdrew from the course!")
            );

            $testArray = array(
                "Selected Course" => "1",
                "Student ID" => "1"
            );
            $actual = ViewEnrolledCoursesMethods::dropCourse($testArray);
            $this->assertEquals($expected, $actual,
                "The attemptCourseWithdraw() method failed.");
        }

        public static function tearDownAfterClass(): void
        {
            $conn = DatabaseMethods::setConnVariable();
            $query = "INSERT INTO coursesusersroster VALUES(1, 1)";
            $sql = $conn->prepare($query);
            $sql->execute();
            $conn = null;
        }
    }
?>