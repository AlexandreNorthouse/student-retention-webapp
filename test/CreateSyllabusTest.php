<?php
    declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Professor/CreateSyllabusMethods.php");
    use PHPUnit\Framework\TestCase;

    class CreateSyllabusTest extends TestCase
    {
        public static function setUpBeforeClass(): void
        {
            // no code needed.
        }

        public function testGetSyllabus()
        {
            $expected = array(
                0 => array(
                    "courseTitle" => "Example title",
                    0 => "Example title",
                    "contactInformation" => "Example contact information",
                    1 => "Example contact information",
                    "officeHoursPolicy"=> "Example office hours policy",
                    2 => "Example office hours policy",
                    "courseDescription" => "Example course description",
                    3 => "Example course description",
                    "courseGoals" => "Example course goals",
                    4 => "Example course goals",
                    "requiredMaterials" => "Example required materials",
                    5 => "Example required materials",
                    "gradingPolicy" => "Example grading policy",
                    6 => "Example grading policy",
                    "attendancePolicy" => "Example attendance policy",
                    7 => "Example attendance policy",
                    "universityPolicy" => "Example university policy",
                    8 => "Example university policy",
                    "studentResources" => "Example student resources",
                    9 => "Example student resources"
                )
            );
            $actual = CreateSyllabusMethods::getSyllabus(array("Course ID" => 1));
            $this->assertEquals($expected, $actual,
                "The getSyllabus() method failed.");
        }

        public function testAttemptSyllabusInsertion()
        {
            $expected = array();

            $testArray = array(
                "Course ID"           => "3",
                "Course Title"        => "1",
                "Contact Information" => "1",
                "Office Hours"        => "1",
                "Course Description"  => "1",
                "Course Goals"        => "1",
                "Required Materials"  => "1",
                "Grading Policy"      => "1",
                "Attendance Policy"   => "1",
                "University Policies" => "1",
                "Student Resources"   => "1"
            );
            $actual = CreateSyllabusMethods::attemptSyllabusInsertion($testArray);
            $this->assertEquals($expected, $actual,
                "The attemptSyllabusInsertion() method failed.");
        }

        public function testAttemptSyllabusUpdate()
        {
            $expected = array();

            $testArray = array(
                "Course ID"           => "3",
                "Course Title"        => "2",
                "Contact Information" => "2",
                "Office Hours"        => "2",
                "Course Description"  => "2",
                "Course Goals"        => "2",
                "Required Materials"  => "2",
                "Grading Policy"      => "2",
                "Attendance Policy"   => "2",
                "University Policies" => "2",
                "Student Resources"   => "2"
            );
            $actual = CreateSyllabusMethods::attemptSyllabusUpdate($testArray);
            $this->assertEquals($expected, $actual,
                "The attemptSyllabusUpdate() method failed.");
        }

        public function testAttemptSyllabusDelete()
        {
            $expected = array(
                'Outcome' => 'Success',
                'Feedback' => array("Syllabus successfully deleted!")
            );

            $testArray = array(
                "Course ID" => 3
            );
            $actual = CreateSyllabusMethods::attemptSyllabusDelete($testArray);
            $this->assertEquals($expected, $actual,
                "The attemptSyllabusDelete() method failed.");
        }

        public static function tearDownAfterClass(): void
        {
            // no code needed.
        }
    }
?>