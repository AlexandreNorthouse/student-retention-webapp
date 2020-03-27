<?php
    declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Professor/StudentEnrollmentMethods.php");
    use PHPUnit\Framework\TestCase;

    class StudentEnrollmentTest extends TestCase
    {
        public static function setUpBeforeClass(): void
        {
            $conn = DatabaseMethods::setConnVariable();
            $query = "INSERT INTO coursesusersroster VALUES (3, 1)";
            $sql = $conn->prepare($query);
            $sql->execute();
            $conn = null;
        }

        public function testAttemptStudentRemoval()
        {
            $expected = array(
                "Outcome" => "Success",
                "Feedback" => array("Successfully withdrew student from the course!")
            );

            $testArray = array(
                "Selected Course" => "3",
                "Selected Student" => "1"
            );
            $actual = StudentEnrollmentMethods::removeStudent($testArray);
            $this->assertEquals($expected, $actual,
                "The attemptStudentRemoval() method failed.");
        }

        public function testGetStudents()
        {
            $expected = array(
                array (
                    "ID"    => "1",
                    0       => "1",
                    "fname" => "Millie",
                    1       => "Millie",
                    "lname" => "Brown",
                    2       => "Brown"
                )
            );


            $testArray = array(
                "Selected Course" => 1
            );
            $actual = StudentEnrollmentMethods::getStudents($testArray);
            $this->assertEquals($expected, $actual,
                "The getStudents() method failed.");
        }

        public static function tearDownAfterClass(): void
        {
            // no code needed.
        }
    }
?>