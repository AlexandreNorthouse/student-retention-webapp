<?php
    declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Professor/Create_Syllabus_Methods.php");

    use PHPUnit\Framework\TestCase;


    class CreateSyllabusTest extends TestCase
    {

        public static function tearDownAfterClass(): void
        {
            $conn = DatabaseMethods::setConnVariable();
            $query = "DELETE FROM syllabi WHERE studentResources=\"Example\";";
            $sql = $conn->prepare($query);
            $sql->execute();
        }

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
            $this->assertEquals($correctArray, CreateSyllabusMethods::createSyllabus($testArray), "They're the same!");
        }

        public function testAttemptSyllabusInsertion()
        {
            $testArray = array(
                "Course ID"           => "2",
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
            $this->assertEquals($correctArray, CreateSyllabusMethods::attemptSyllabusInsertion($testArray), "They're the same!");
        }  
    }
?>