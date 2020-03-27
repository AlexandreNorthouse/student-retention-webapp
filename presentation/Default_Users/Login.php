<html>
    <head>
        <title>SRS - Login</title>
        <link rel="stylesheet" href="../../presentation/StyleSheets/StyleSheet_User.css">
    </head>
    <body>
        <section class="default_user">
            <h1>Student Retention Service</h1>
            <h1>Login</h1>

            <form action="" method="post">
                <section class="fields">
                    <label for="username">Username: </label>
                    <input type="text" name="username" required
                        value="<?php echo(PresentationMethods::displayPostValue("username")) ?>"/>
                    <br><br>
                    <label for="password">Password: </label>
                    <input type="password" name="password" required />
                </section>

                <div class="centered_button">
                    <br><br>
                    <button type="submit" name="LoginButton" value="✓">Login</button>
                    <br>
                </div>
            </form>

            <?php if (!empty($feedback)) echo(PresentationMethods::displayFeedback($feedback)) ?>

            <div class="centered_button">
                <br><br>
                <button class="change_page" onclick="window.location.href = 'Register.php';">Register a New User</button>
            </div>
        </section>
    </body>
</html>