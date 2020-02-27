<?php
declare(strict_types=1);
    require_once(dirname(__FILE__, 2) . "/logic/Default_Users/Login_Methods.php");

    use PHPUnit\Framework\TestCase;


    class ViewCourseTest extends TestCase
    {
        public function testAttemptLogin()
        {
            $testArray = array(
                "Username" => "test",
                "Password" => "test"
            );

            $correctArray = array();
            $this->assertEquals($correctArray, LoginMethods::attemptLogin($testArray), "They're the same!");
        }

        public function testSetSessionVariables()
        {
            $testArray = array(
                "ID" => "test",
                "uniID" => "test",
                "username" => "test",
                "fname"   => "test",
                "lname"    => "test",
                "isProf"  => "test"
            );

            LoginMethods::setSessionVariables($testArray);

            $sessionArray = array(
                "ID" => $_SESSION['userID'],
                "uniID" => $_SESSION['uniID'],
                "username" => $_SESSION['username'],
                "fname"   => $_SESSION['fName'],
                "lname"    => $_SESSION['lName'],
                "isProf"  => $_SESSION['isProf']
            );

            $this->assertEquals($correctArray, $sessionArray, "They're the same!");
        }

        public function testGetRedirectString()
        {
            $testString = "1";

            $correctString = "Location: ../Professor/View_Data.php";
            $this->assertEquals($correctString, LoginMethods::attemptCourseWithdraw($testString), "They're the same!");
        }
    }

?>