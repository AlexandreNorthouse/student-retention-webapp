<?php
    declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Default_Users/RegisterMethods.php");
    use PHPUnit\Framework\TestCase;

    class RegisterTests extends TestCase
    {
        public static function setUpBeforeClass(): void
        {
            // no code needed.
        }

        public function testDuplicateUsernameCheck()
         {
             $testArray = array(
                 "Username" => "exampleStudent",
                 "uniID" => "1"
             );

             $successArray = array(
                 "Outcome" => "Error",
                 "Feedback" => array("That username already exists for that university!")
             );
             $this->assertEquals($successArray, RegisterMethods::duplicateusernameCheck($testArray),
                 "The duplicateUsernameCheck() method failed.");
         }

        public function testUserInsertion()
         {
             $testArray = array(
                 "Username"      => 'test',
                 "University ID" => '1',
                 "Password"      => 'test',
                 "First Name"    => 'test',
                 "Last Name"     => 'test',
                 "Is Professor"  => '1'
             );

             $correctArray = array();
             $this->assertEquals($correctArray, RegisterMethods::attemptUserInsertion($testArray),
                 "The attemptUserInsertion() method failed.");
         }

        public static function tearDownAfterClass(): void
        {
            $conn = DatabaseMethods::setConnVariable();
            $query = 'DELETE FROM users WHERE username="test"';
            $sql = $conn->prepare($query);
            $sql->execute();
            $conn = null;
        }
    }
?>