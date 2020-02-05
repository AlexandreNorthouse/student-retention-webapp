-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2020 at 11:55 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student-engagement-retention-local`
--

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`ID`, `uniID`, `crseID`, `sectNum`, `crseName`) VALUES
(1, 1, 'EX101', 1, 'Example Course, Section 1'),
(2, 1, 'EX101', 2, 'Example Course, Section 2');

--
-- Dumping data for table `coursesusersroster`
--

INSERT INTO `coursesusersroster` (`crseID`, `userID`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2);

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`ID`, `crseID`, `qtext`, `atext`) VALUES
(1, 1, 'What\'s the capital of Indiana?', 'The capital of Indiana is Indianaoplis.'),
(2, 1, 'What section of EX101 is this?', 'This is section 1 of EX101.'),
(3, 2, 'What\'s the capital of Michigan?', 'The capital of Michigan is Grand Rapids.'),
(4, 2, 'What section of EX101 is this?', 'This is section 2 of EX101.');

--
-- Dumping data for table `syllabi`
--

INSERT INTO `syllabi` (`ID`, `crseID`, `courseTitle`, `contactInformation`, `officeHoursPolicy`, `courseDescription`, `courseGoals`, `requiredMaterials`, `gradingPolicy`, `attendancePolicy`, `universityPolicy`, `studentResources`) VALUES
(1, 1, 'Example title', 'Example contact information', 'Example office hours policy', 'Example course description', 'Example course goals', 'Example required materials', 'Example grading policy', 'Example attendance policy', 'Example university policy', 'Example student resources'),
(2, 2, 'Example title 2', 'Example contact information 2', 'Example office hours policy 2', 'Example course description 2', 'Example course goals 2', 'Example required materials 2', 'Example grading policy 2', 'Example attendance policy 2', 'Example university policy 2', 'Example student resources 2');

--
-- Dumping data for table `universities`
--

INSERT INTO `universities` (`ID`, `name`) VALUES
(1, 'Example University');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `uniID`, `username`, `password`, `fname`, `lname`, `isProf`) VALUES
(1, 1, 'exampleStudent', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Millie', 'Brown', 0),
(2, 1, 'exampleProfessor', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Abigail', 'Smith', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
