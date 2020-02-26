<?php
    declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Create_Syllabus_Methods.php");

    use PHPUnit\Framework\TestCase;


    class CreateSyllabusTest extends TestCase
    {
        public function testCreateSyllabus()
        {
            $testArray = array(
                "Course ID"           => "1",
                "Course Title"        => "Example",
                "Contact Information" => "Example",
                "Office Hours"        => "Example",
                "Course Description"  => "Example",
                "Course Goals"        => "Example",
                "Required Materials"  => "Example",
                "Grading Policy"      => "Example",
                "Attendance Policy"   => "Example",
                "University Policies" => "Example",
                "Student Resources"   => "Example"
            );

            $correctArray = array(
                "Outcome" => "Success",
                "Feedback" => array("The syllabus was successfully added to the course!")
            );
            $this->assertNotEquals($correctArray, defaultMethods::createSyllabus($testArray), "They're the same!");
        }  

        public function testCheckSyllabusExists()
        {
            $testArray = array(
                "Course ID" => "1",
            );

            $correctArray = array(
                "Outcome" => "Error",
                "Feedback" => array("It seems like a syllabus already exists for this course!")
            );
            $this->assertNotEquals($correctArray, defaultMethods::checkSyllabusExists($testArray), "They're the same!");
        }  

        public function testAttemptSyllabusInsertion()
        {
            $testArray = array(
                "Course ID"           => "1",
                "Course Title"        => "Example",
                "Contact Information" => "Example",
                "Office Hours"        => "Example",
                "Course Description"  => "Example",
                "Course Goals"        => "Example",
                "Required Materials"  => "Example",
                "Grading Policy"      => "Example",
                "Attendance Policy"   => "Example",
                "University Policies" => "Example",
                "Student Resources"   => "Example"
            );

            $correctArray = array();
            $this->assertNotEquals($correctArray, defaultMethods::attemptSyllabusInsertion($testArray), "They're the same!");
        }  
    }
?>