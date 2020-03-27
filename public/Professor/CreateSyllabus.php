<?php
    // this makes sure that all stored session values are kept
    session_start();


    // these include the database, default, page, and presentation classes
    require_once( dirname(__FILE__, 3) . "\logic\Database_Methods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Default_Methods.php" );
    require_once( dirname(__FILE__, 3) . "\logic\Professor\Create_Syllabus_Methods.php");
    require_once( dirname(__FILE__, 3) . "\presentation\PresentationMethods.php");


    DefaultMethods::checkLogin("Professor");
    $classList = DefaultMethods::getEnrolledCourses();


    // this handles calling the logic function and its return array
    if (!empty($_POST['getSyllabus'])) {
        $inputArray = array(
            "Course ID" => $_POST['selectedCourse']
        );
        $tempArray = CreateSyllabusMethods::getSyllabus($inputArray);
        if (!empty($tempArray)) {
            $syllabusArray = CreateSyllabusMethods::getSyllabus($inputArray)[0];
        } else {
            $syllabusArray = $tempArray;
        }
    }

    else if (!empty($_POST['submitSyllabus'])) {
        $inputArray = array(
            "Course ID"           => $_POST['selectedCourse'],
            "Course Title"        => $_POST['courseTitle'],
            "Contact Information" => $_POST['contactInfo'],
            "Office Hours"        => $_POST['officeHours'],
            "Course Description"  => $_POST['courseDes'],
            "Course Goals"        => $_POST['courseGoals'],
            "Required Materials"  => $_POST['reqMaterials'],
            "Grading Policy"      => $_POST['gradingPolicy'],
            "Attendance Policy"   => $_POST['attenPolicy'],
            "University Policies" => $_POST['uniPolicies'],
            "Student Resources"   => $_POST['stuResources']
        );
        $feedback = CreateSyllabusMethods::createSyllabus($inputArray);
        $tempArray = CreateSyllabusMethods::getSyllabus($inputArray);
        if (!empty($tempArray)) {
            $syllabusArray = CreateSyllabusMethods::getSyllabus($inputArray)[0];
        } else {
            $syllabusArray = $tempArray;
        }
    }

    else if (!empty($_POST['updateSyllabus'])){
        $inputArray = array(
            "Course ID"           => $_POST['selectedCourse'],
            "Course Title"        => $_POST['courseTitle'],
            "Contact Information" => $_POST['contactInfo'],
            "Office Hours"        => $_POST['officeHours'],
            "Course Description"  => $_POST['courseDes'],
            "Course Goals"        => $_POST['courseGoals'],
            "Required Materials"  => $_POST['reqMaterials'],
            "Grading Policy"      => $_POST['gradingPolicy'],
            "Attendance Policy"   => $_POST['attenPolicy'],
            "University Policies" => $_POST['uniPolicies'],
            "Student Resources"   => $_POST['stuResources']
        );
        $feedback = CreateSyllabusMethods::updateSyllabus($inputArray);
        $tempArray = CreateSyllabusMethods::getSyllabus($inputArray);
        if (!empty($tempArray)) {
            $syllabusArray = CreateSyllabusMethods::getSyllabus($inputArray)[0];
        } else {
            $syllabusArray = $tempArray;
        }
    }

    else if (!empty($_POST['deleteSyllabus'])){
        $inputArray = array(
            "Course ID"           => $_POST['selectedCourse']
        );
        $feedback = CreateSyllabusMethods::attemptSyllabusDelete($inputArray);
        $tempArray = CreateSyllabusMethods::getSyllabus($inputArray);
        if (!empty($tempArray)) {
            $syllabusArray = CreateSyllabusMethods::getSyllabus($inputArray)[0];
        } else {
            $syllabusArray = $tempArray;
        }
    }

    // this then loads the presentation layer
    require_once( dirname(__FILE__, 3) . "\presentation\Professor\Create_Syllabus.php");
?>