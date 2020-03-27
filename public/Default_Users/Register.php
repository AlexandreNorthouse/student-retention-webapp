<?php
    // this makes sure that all stored session values are kept
    session_start();

    // This includes the register methods class..
    require_once( dirname(__FILE__, 3) . "\logic\Default_Users\RegisterMethods.php" );


    // this handles calling the logic function and its return array
    if (!empty($_POST)) {
        $inputArray = array(
            "Username" => $_POST['username'],
            "University ID" => $_POST['uniID'],
            "Password" => $_POST['password'],
            "Password 2" => $_POST['password2'],
            "First Name" => $_POST['fName'],
            "Last Name" => $_POST['lName'],
            "Is Professor" => $_POST['createUser']
        );
        $feedback = RegisterMethods::register($inputArray);
    } else {
        $feedback = array();
    }

    // this then loads the presentation layer and it's required method class.
    require_once( dirname(__FILE__, 3) . "\presentation\PresentationMethods.php" );
    require_once( dirname(__FILE__, 3) . "\presentation\Default_Users\RegisterPresentation.php" );
?>