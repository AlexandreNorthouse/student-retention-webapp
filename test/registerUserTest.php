<?php
declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Default_Users/Register_Methods.php");

    use PHPUnit\Framework\TestCase;


    class ViewCourseTest extends TestCase
    {
        public function testRegister()
        {
            $testArray = array(
                "Username" => 'test',
                "University ID" => '1',
                "Password" => 'test',
                "Password 2" => 'test',
                "First Name" => 'test',
                "Last Name" => 'test',
                "Is Professor" => '1'
            );

            $correctArray = array(
                "Outcome" => "Success",
                "Feedback" => array("Account successfully added! Return to the login page to login.")
            );
            $this->assertEquals($correctArray, RegisterMethods::Register($testArray), "They're the same!");
        }
        
        
        public function testDuplicateUsernameCheck()
        {
            $testArray = array(
                "Username" => "test",
                "University ID" => "1"
            );

            $correctArray = array();
            $this->assertEquals($correctArray, RegisterMethods::duplicateusernameCheck($testArray), "They're the same!");
        }

        public function testUserInsertion()
        {
            $testArray = array(
                "Username" => 'test',
                "University ID" => '1',
                "Password" => 'test',
                "Password 2" => 'test',
                "First Name" => 'test',
                "Last Name" => 'test',
                "Is Professor" => '1'
            );

            $correctArray = array();
            $this->assertEquals($correctArray, RegisterMethods::attemptUserInsertion($testArray), "They're the same!");
        }
    }

?>