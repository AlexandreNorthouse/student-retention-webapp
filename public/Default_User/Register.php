<?php
    if (isset($_SESSION)) {
        session_destroy();
    }
    require_once( dirname(__FILE__, 3) . "\logic\Default_Users\Register_Methods.php" );
?>

<html>
    <head>
        <title>SRS - Register User</title>
        <link rel="stylesheet" href="../StyleSheets/StyleSheet_User.css">
    </head>
    <body>
        <section class="default_user">
            <h1>Student Retention Service</h1>
            <h1>Register</h1>

            <form action="" method="post">
                <section class="fields">
                    <label for="username">Username: </label>
                    <input name="username" type="text" required
                        value="<?php if(!empty($_POST['username'])){ echo $_POST['username']; } else { echo ''; } ?>"/>
                    <br>

                    <label for="uniID">University ID Number: </label>
                    <input name="uniID" type="number" required min=1 max=99999999999
                        value="<?php if(!empty($_POST['uniID'])){ echo $_POST['uniID']; } else { echo ''; } ?>"/>
                    <br>

                    <label for="password">Password: </label>
                    <input name="password" type="password" required />
                    <br>

                    <label for="password2">Re-enter Password: </label>
                    <input name="password2" type="password" required />
                    <br><br>

                    <label for="fName">First Name: </label>
                    <input name="fName" type="text" required
                        value="<?php if(!empty($_POST['fName'])){ echo $_POST['fName']; } else { echo ''; } ?>"/>
                    <br>

                    <label for="lName">Last Name: </label>
                    <input name="lName" type="text" required
                        value="<?php if(!empty($_POST['lName'])){ echo $_POST['lName']; } else { echo ''; } ?>"/>
                </section>

                <br><br>
                <?php
                if (!empty($feedback["Feedback"])) {
                    echo("<span class=\"". $feedback["Outcome"] . "\">");
                    foreach($feedback["Feedback"] as $a) echo $a . "<br>";
                    echo("</span>");
                }
                ?>
                <br><br>

                <section class="horizontal_section">
                    <button type="submit" name="createUser" value="Student">Create Student</button>
                    <button type="submit" name="createUser" value="Professor">Create Professor</button>
                </section>
            </form>

            <br>
            <div  class="centered_button">
                <button class="change_page" onclick="window.location.href = 'Login.php';">Return to Login Page</button>
            </div>
        </section>
    </body>
</html>