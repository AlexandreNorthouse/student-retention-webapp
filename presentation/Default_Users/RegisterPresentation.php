<html>
    <head>
        <title>SRS - Register User</title>
        <link rel="stylesheet" href="../../presentation/StyleSheets/StyleSheet_User.css">
    </head>
    <body>
        <section class="default_user">
            <h1>Student Retention Service</h1>
            <h1>Register</h1>

            <form action="" method="post">
                <section class="fields">
                    <label for="username">Username: </label>
                    <input name="username" type="text" required
                           value="<?php echo(PresentationMethods::displayPostValue("username")) ?>"/>
                    <br>

                    <label for="password">Password: </label>
                    <input name="password" type="password" required />
                    <br>

                    <label for="password2">Re-enter Password: </label>
                    <input name="password2" type="password" required />
                    <br>

                    <label for="uniID">University ID Number: </label>
                    <input name="uniID" type="number" required min=1 max=99999999999
                           value="<?php echo(PresentationMethods::displayPostValue("uniID")) ?>"/>
                    <br>

                    <div class="doubleUp">
                        <div>
                            <label for="fName">First Name: </label><br>
                            <input name="fName" type="text" required
                                   value="<?php echo(PresentationMethods::displayPostValue("fName")) ?>"/>
                            <br><br>
                        </div>
                        <div>
                            <label for="lName">Last Name: </label><br>
                            <input name="lName" type="text" required
                                   value="<?php echo(PresentationMethods::displayPostValue("lName")) ?>"/>
                        </div>
                    </div>
                </section>

                <section class="horizontal_section">
                    <button type="submit" name="createUser" value="Student">Create Student</button>
                    <button type="submit" name="createUser" value="Professor">Create Professor</button>
                </section>

                <br><br>
                <?php if (!empty($feedback)) echo(PresentationMethods::displayFeedback($feedback)) ?>
            </form>

            <br>
            <div  class="centered_button">
                <button class="change_page" onclick="window.location.href = 'Login.php';">Return to Login Page</button>
            </div>
        </section>
    </body>
</html>