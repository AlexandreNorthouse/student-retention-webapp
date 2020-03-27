<?php
    // this makes sure that all stored session values are kept
    session_start();

    // This includes the chatbot methods class.
    require_once( dirname(__FILE__, 3) . "\logic\Student\ChatbotMethods.php");

    DefaultMethods::checkLogin("Student");

    // this handles calling the logic function (which is currently useless)
    ChatbotMethods::chatbot();

    // this then loads the presentation layer and it's required method class.
    require_once( dirname(__FILE__, 3) . "\presentation\PresentationMethods.php");
    require_once( dirname(__FILE__, 3) . "\presentation\Student\ChatbotPresentation.php");
?>