<?php
    class PresentationMethods
    {
        public static function displayPostValue(string $varName): string
        {
            if (!empty($_POST["$varName"])) {
                return $_POST["$varName"];
            } else {
                return "";
            }
        }

        public static function displayFeedback($feedback): string
        {
            $feedbackString = "<span class=\"" . $feedback["Outcome"] . "\">";
            foreach ($feedback["Feedback"] as $a) {
                $feedbackString .= $a . "<br>";
            }
            $feedbackString .= "</span>";
            return $feedbackString;
        }

        public static function displayCurrentEnrolledCourses(array $classList): string
        {
            $tableString = "<div><label for=\"selectedCourse\">Select Course: </label>";
            $tableString .= "<select name=\"selectedCourse\">";
            foreach ($classList as $c) {
                $tableString .= ('<option value="' . $c['ID'] . '"');

                // this uses the post variable to check if a course was selected
                if (isset($_POST['selectedCourse']) && $_POST['selectedCourse'] == $c['ID']) {
                    $tableString .= " selected ";
                }
                $tableString .= ('>' . $c['crseName'] . '</option>');
            }
            $tableString .= "</select></div>";
            return $tableString;
        }

        public static function displaySyllabusCreation(array $syllabusArray): string
        {
            $syllabusString = '<br><div class="twoTextareas"><div><label for="courseTitle">Course Title: </label><br>' .
                '<textarea name="courseTitle" >';
            if (isset($syllabusArray['courseTitle']) && !empty($syllabusArray['courseTitle']))
                $syllabusString .= $syllabusArray['courseTitle'];
            $syllabusString .= '</textarea></div>';


            $syllabusString .= '<br><div><label for="contactInfo">Contact Information: </label><br>' .
                '<textarea name="contactInfo" >';
            if (isset($syllabusArray['contactInformation']) && !empty($syllabusArray['contactInformation']))
                $syllabusString .= $syllabusArray['contactInformation'];
            $syllabusString .= '</textarea></div></div>';


            $syllabusString .= '<br><div class="twoTextareas"><div><label for="officeHours">Office Hours Policy: </label><br>' .
                '<textarea name="officeHours" >';
            if (isset($syllabusArray['officeHoursPolicy']) && !empty($syllabusArray['officeHoursPolicy']))
                $syllabusString .= $syllabusArray['officeHoursPolicy'];
            $syllabusString .= '</textarea></div>';


            $syllabusString .= '<br><div><label for="courseDes">Course Description: </label><br>' .
                '<textarea name="courseDes" >';
            if (isset($syllabusArray['courseDescription']) && !empty($syllabusArray['courseDescription']))
                $syllabusString .= $syllabusArray['courseDescription'];
            $syllabusString .= '</textarea></div></div>';


            $syllabusString .= '<br><div class="twoTextareas"><div><label for="courseGoals">Course Goals: </label><br>' .
                '<textarea name="courseGoals" >';
            if (isset($syllabusArray['courseGoals']) && !empty($syllabusArray['courseGoals']))
                $syllabusString .= $syllabusArray['courseGoals'];
            $syllabusString .= '</textarea></div>';


            $syllabusString .= '<br><div><label for="reqMaterials">Required Materials: </label><br>' .
                '<textarea name="reqMaterials" >';
            if (isset($syllabusArray['requiredMaterials']) && !empty($syllabusArray['requiredMaterials']))
                $syllabusString .= $syllabusArray['requiredMaterials'];
            $syllabusString .= '</textarea></div></div>';


            $syllabusString .= '<br><div class="twoTextareas"><div><label for="gradingPolicy">Grading Policy: </label><br>' .
                '<textarea name="gradingPolicy" >';
            if (isset($syllabusArray['gradingPolicy']) && !empty($syllabusArray['gradingPolicy']))
                $syllabusString .= $syllabusArray['gradingPolicy'];
            $syllabusString .= '</textarea></div>';


            $syllabusString .= '<br><div><label for="attenPolicy">Attendance Policy: </label><br>' .
                '<textarea name="attenPolicy" >';
            if (isset($syllabusArray['attendancePolicy']) && !empty($syllabusArray['attendancePolicy']))
                $syllabusString .= $syllabusArray['attendancePolicy'];
            $syllabusString .= '</textarea></div></div>';


            $syllabusString .= '<br><div class="twoTextareas"><div><label for="uniPolicies">University Policies: </label><br>' .
                '<textarea name="uniPolicies" >';
            if (isset($syllabusArray['universityPolicy']) && !empty($syllabusArray['universityPolicy']))
                $syllabusString .= $syllabusArray['universityPolicy'];
            $syllabusString .= '</textarea></div>';


            $syllabusString .= '<br><div><label for="stuResources">Student Resources: </label><br>' .
                '<textarea name="stuResources" >';
            if (isset($syllabusArray['studentResources']) && !empty($syllabusArray['studentResources']))
                $syllabusString .= $syllabusArray['studentResources'];
            $syllabusString .= '</textarea></div></div>';

            if (isset($syllabusArray['courseTitle'])) {
                $syllabusString .= '<br><div class="centeredButtons"><button type="submit" name="updateSyllabus" value="✓">' .
                    'Update Syllabus</button>';
                $syllabusString .= '<button type="submit" name="deleteSyllabus" value="✓">' .
                    'Delete Syllabus</button></div>';
            } else {
                $syllabusString .= '<br><div class="centeredButtons"><button type="submit" name="submitSyllabus" value="✓">' .
                    'Create Syllabus</button></div>';
            }

            return $syllabusString;
        }

        public static function displayEnrolledStudents(array $studentList): string
        {
            $studentString = "";
            if (!empty($studentList[0])) {
                $studentString .= "<table><tr><th>Student Lasts Name:</th><th>Student First Name:</th>" .
                    "<th>Remove Student:</th></tr>";
                foreach ($studentList as $f) {
                    $studentString .= "<tr><td>" . $f['fname'] . "</td><td>" . $f['lname'] . "</td>"
                        . "<td><button type='submit' name='selectedStudent' value='"
                        . $f['ID'] . "'>Remove Student</button></td></tr></div>";
                }
            } else if (!empty($studentList["Outcome"])) {
                $studentString .= '<span class="' . $studentList["Outcome"] . '">';
                foreach ($studentList["Feedback"] as $a) $studentString .= $a . "<br>";
                $studentString .= "</span><br>";
            }

            return $studentString;
        }

        public static function displayEnrolledCourses(array $classList): string
        {
            $classString = "<div><h3>Enrolled Courses:</h3></div>"
                . "<table><tr><th> Course Name:</th><th> Course Professor:</th><th>Drop Course:</th></tr>";
            foreach ($classList as $c) {
                $classString .= "<tr><td>" . $c['crseName'] . "</td><td>" . $c['fname'] . " " . $c['lname'] . "</td>"
                    . "<td><button type='submit' name='selectedCourse' value='" . $c['ID']
                    . "'> Drop Course</button></td></tr>";
            }
            return $classString;
        }

        public static function displayCreatedCourses(array $classList): string
        {
            $classString = "<div><h3>Created Courses:</h3></div>"
                . "<table><tr><th>Course Name:</th><th>Course ID:</th><th>Delete Course:</th></tr>";
            foreach ($classList as $c) {
                $classString .= "<tr><td>" . $c['crseName'] . "</td><td>" . $c['ID'] . "</td>"
                    . "<td><button type='submit' name='selectedCourse' value='" . $c['ID']
                    . "'>Delete Course</button></td></tr></div>";
            }

            return $classString;
        }

        public static function displayCreatedQuestions(array $questionList): string
        {
            $questionString = "";

            if (!empty($questionList[0])) {
                $questionString .= '<br><div style="text-align: center;"><h3>Retrieved Questions:</h3></div>'
                    . '<table><tr><th>Question Number</th>'
                    . '<th>Question Text</th><th>Question Answer</th><th>Edit Question</th><th>Delete Question</th></tr>';
                for ($i = 0; $i < count($questionList); $i++) {
                    if (isset($_POST["editQuestion"]) && $_POST["editQuestion"] == $questionList[$i]['ID']) {
                        $questionString .= '<tr><td>#' . ($i + 1) . '</td><td><textarea name="updateQuestion" '
                            . 'required>' . $questionList[$i]['qtext'] . '</textarea></td>'
                            . '<td><textarea name="updateAnswer" required>' . $questionList[$i]['atext']
                            . '</textarea></td>' . "<td><button type='submit' name='submitUpdate' value='"
                            . $questionList[$i]['ID'] . "'>Submit Edit</button></td><td><button type='submit' "
                            . "name='deleteQuestion' value='" . $questionList[$i]['ID']
                            . "'>Delete Question</button></td></tr>";
                    } else {
                        $questionString .= '<tr><td>#' . ($i + 1) . '</td>'
                            . '<td>' . $questionList[$i]['qtext'] . '</td>'
                            . '<td>' . $questionList[$i]['atext'] . '</td>'
                            . "<td><button type='submit' name='editQuestion' value='"
                            . $questionList[$i]['ID'] . "'>Edit Question</button></td>"
                            . "<td><button type='submit' name='deleteQuestion' value='"
                            . $questionList[$i]['ID'] . "'>Delete Question</button></td>";
                        $questionString .= '</tr>';
                    }
                }
                $questionString .= '</table>';


            } else if (!empty($questionList['Outcome'])) {
                $questionString .= "<span class=\"" . $questionList["Outcome"] . "\">";
                foreach ($questionList["Feedback"] as $a)
                    $questionString .= $a . "<br>";
                $questionString .= "</span>";
            }

            return $questionString;
        }

        public static function displayEnrolledCoursesTable(array $classList)
        {
            $classString = "<table><tr><th>Course Name:</th><th>View Course Questions:</th></tr>";
            foreach ($classList as $c) {
                $classString .= "<tr><td>" . $c['crseName'] . "</td>"
                    . "<td><button type='submit' name='selectedCourse' value='" . $c['ID']
                    . "'>Select Course</button></td></tr>";
            }
            $classString .= "</table>";
            return $classString;
        }

        public static function displayEnrolledQuestions(array $questionList)
        {
            $questionString = "";

            if (!empty($questionList[0])) {
                $questionString .= '<div style="text-align: center;"><h3>Retrieved Questions:</h3></div>'
                    . '<table><tr><th>Question Text</th><th>Question Answer</th></tr>';
                for ($i = 0; $i < count($questionList); $i++) {
                    $questionString .= '<tr><td>' . $questionList[$i]['qtext'] . '</td>'
                        . '<td>' . $questionList[$i]['atext'] . '</td>';
                    $questionString .= '</tr>';
                }
                $questionString .= '</table>';
                return $questionString;
            }
        }
    }
?>