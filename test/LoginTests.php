<?php
    declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Default_Users/LoginMethods.php");
    use PHPUnit\Framework\TestCase;

    class LoginTests extends TestCase
    {
        public static function setUpBeforeClass(): void
        {
            //no code needed.
        }

        public function testAttemptLogin()
         {
             $testArray = array(
                 "Username" => "exampleStudent",
                 "Password" => "password",
                 "isProf"   => "0"
             );

             $correctArray = array();
             $this->assertEquals($correctArray, LoginMethods::attemptLogin($testArray),
                 "Testing the attemptLogin() method failed.");
         }

        public function testSetSessionVariables()
         {
             $testArray = array(
                 "ID"       => "test",
                 "uniID"    => "test",
                 "username" => "test",
                 "fname"    => "test",
                 "lname"    => "test",
                 "isProf"   => "test"
             );

             LoginMethods::setSessionVariables($testArray);

             $sessionArray = array(
                 "ID"       => $_SESSION['userID'],
                 "uniID"    => $_SESSION['uniID'],
                 "username" => $_SESSION['username'],
                 "fname"    => $_SESSION['fName'],
                 "lname"    => $_SESSION['lName'],
                 "isProf"   => $_SESSION['isProf']
             );

             $this->assertEquals($testArray, $sessionArray,
                 "The setSessionVariables() method failed.");
         }

        public function testGetRedirectString()
         {
             $methodTestString = "1";
             $correctString = "Location: ../Professor/ViewData.php";

             $this->assertEquals($correctString, LoginMethods::getRedirectString($methodTestString),
                 "The getRedirectString() method failed.");
         }

        public static function tearDownAfterClass(): void
        {
            // no code needed.
        }
    }
?>