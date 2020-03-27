<?php
    // this makes sure that all stored session values are kept
    session_start();

    // This includes the login methods class.
    require_once( dirname(__FILE__, 3) . "\logic\Default_Users\LoginMethods.php" );


    // this handles calling the logic function and its return array
    if (!empty($_POST)) {
        $inputArray = array(
            "Username" => ($_POST['username']),
            "Password" => ($_POST['password'])
        );
        $feedback = LoginMethods::login($inputArray);
    } else {
        $feedback = array();
    }

    // this then loads the presentation layer and it's required method class.
    require_once( dirname(__FILE__, 3) . "\presentation\PresentationMethods.php" );
    require_once( dirname(__FILE__, 3) . "\presentation\Default_Users\LoginPresentation.php");
?>