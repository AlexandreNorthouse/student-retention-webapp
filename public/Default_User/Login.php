<?php
    require_once( dirname(__FILE__, 3) . "\logic\Default_Users\Login_Methods.php" );
?>

<html>
<head>
    <title>SRS - Login</title>
    <link rel="stylesheet" href="StyleSheet_User.css">
</head>
<body>
<section class="login">
    <h1>Student Retention Service</h1>
    <h1>Login</h1>

    <form action="" method="post">
        <section class="fields">
            <label for="username">Username: </label>
            <input type="text" name="username" required value="<?php if(!empty($_POST['username'])){ echo $username; } else { echo ''; } ?>"/><br><br>
            <label for="password">Password: </label>
            <input type="password" name="password" required />
        </section>
        <br><br>

        <button type="submit" name="LoginButton" value="✓">Login</button>
        <br><br>
    </form>

    <span class="error"><?php if(!empty($error)) foreach($error as $e) echo $e . "<br>"; ?></span>
    <br><br>
    <div style="text-align: center;">
        <button style="position:relative" onclick="window.location.href = 'user-register.php';">Register a New User</button>
    </div>
</section>
</body>
</html>











