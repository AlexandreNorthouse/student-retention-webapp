CREATE TABLE `Universitites` (
  `ID` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `name` varchar(255)
);

CREATE TABLE `Courses` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `uniID` int(11) NOT NULL,
  `crseID` varchar(255) NOT NULL,
  `sectNum` int(11) NOT NULL,
  `crseName` varchar(255),
  PRIMARY KEY (`ID`, `uniID`)
);

CREATE TABLE `Users` (
  `ID` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `uniID` int(11) NOT NULL,
  `username` varchar(255),
  `password` varchar(255),
  `fname` varchar(255),
  `lname` varchar(255),
  `isProf` tinyint(1)
);

CREATE TABLE `Questions` (
  `ID` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `crseID` int(11) NOT NULL,
  `qtext` text NOT NULL,
  `atext` text NOT NULL
);

CREATE TABLE `Syllabi` (
  `ID` int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `crseID` int(11) NOT NULL,
  `courseTitle` text,
  `contactInformation` text,
  `officeHoursPolicy` text,
  `courseDescription` text,
  `courseGoals` text,
  `requiredMaterials` text,
  `gradingPolicy` text,
  `attendancePolicy` text,
  `universityPolicy` text,
  `studentResources` text
);

CREATE TABLE `CoursesUsersRoster` (
  `crseID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`crseID`, `userID`)
);

ALTER TABLE `Courses` ADD FOREIGN KEY (`uniID`) REFERENCES `Universitites` (`ID`);

ALTER TABLE `Users` ADD FOREIGN KEY (`uniID`) REFERENCES `Universitites` (`ID`);

ALTER TABLE `Questions` ADD FOREIGN KEY (`crseID`) REFERENCES `Courses` (`ID`);

ALTER TABLE `Syllabi` ADD FOREIGN KEY (`crseID`) REFERENCES `Courses` (`ID`);

ALTER TABLE `CoursesUsersRoster` ADD FOREIGN KEY (`crseID`) REFERENCES `Courses` (`ID`);

ALTER TABLE `CoursesUsersRoster` ADD FOREIGN KEY (`userID`) REFERENCES `Users` (`ID`);

ALTER TABLE `Users` ADD FOREIGN KEY (`uniID`) REFERENCES `Users` (`ID`);
