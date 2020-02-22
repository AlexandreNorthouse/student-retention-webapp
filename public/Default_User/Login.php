<?php
    if (isset($_SESSION)) {
        session_destroy();
    }
    require_once( dirname(__FILE__, 3) . "\logic\Default_Users\Login_Methods.php" );
?>

<html>
    <head>
        <title>SRS - Login</title>
        <link rel="stylesheet" href="../StyleSheets/StyleSheet_User.css">
    </head>
    <body>
        <section class="default_user">
            <h1>Student Retention Service</h1>
            <h1>Login</h1>

            <form action="" method="post">
                <section class="fields">
                    <label for="username">Username: </label>
                    <input type="text" name="username" required value="
                        <?php if(!empty($_POST['username'])){ echo $_POST['username']; } else { echo ''; } ?>"/>
                    <br><br>
                    <label for="password">Password: </label>
                    <input type="password" name="password" required />
                </section>
                <br><br>

                <button type="submit" name="LoginButton" value="✓">Login</button>
                <br><br>
            </form>

            <?php
                if (!empty($feedback["Feedback"])) {
                    echo("<span class=\"". $feedback["Status"] . "\">");
                    foreach($feedback["Feedback"] as $a) echo $a . "<br>";
                    echo("</span>");
                }
            ?>
            <br><br>

            <div class="centered_button">
                <button class="change_page" onclick="window.location.href = 'Register.php';">Register a New User</button>
            </div>
        </section>
    </body>
</html>











