<?php
    // this makes sure that all stored session values are kept
    session_start();

    // these include the database, default, page, and presentation classes
    require_once( dirname(__FILE__, 3) . "\logic\DatabaseMethods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\DefaultMethods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Student\ChatbotMethods.php");
    require_once( dirname(__FILE__, 3) . "\presentation\PresentationMethods.php");

    DefaultMethods::checkLogin("Student");

    // this handles calling the logic function (which is currently useless)
    ChatbotMethods::chatbot();

    // this then loads the presentation layer
    require_once( dirname(__FILE__, 3) . "\presentation\Student\ChatbotPresentation.php");
?>