<?php
    // this makes sure that all stored session values are kept
    session_start();

    // this includes the needed database and default methods
    require_once( dirname(__FILE__, 3) . "\logic\Database_Methods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Default_Methods.php" );

    // this handles calling the logic function
    ChatbotMethods::chatbot();

    class ChatbotMethods {

        /* this page doesn't currently have any logic functionality outside the chatbot,
            so it just checks the user's login for now. */
        public static function chatbot() {
            //DefaultMethods::checkLogin("Student");
        }

    }

?>