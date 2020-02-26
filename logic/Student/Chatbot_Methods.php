<?php
    // this makes sure that all stored session values are kept
    session_start();

    // this includes the needed database and default methods
    require_once( dirname(__FILE__, 3) . "\logic\Database_Methods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Default_Methods.php" );

    DefaultMethods::checkLogin("Student");

    // this handles calling the logic function (which is currently useless)
    ChatbotMethods::chatbot();

    class ChatbotMethods {

        // main block of code for running the presentation layer
        public static function chatbot()
        {

        }

    }

?>