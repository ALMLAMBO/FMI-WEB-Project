<?php
session_start();

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
    $loggedIn = true;
} else {
    $loggedIn = false;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>XML2Emmet - Web Technology Final Project</title>
        <link rel="stylesheet" href="style.css"/>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <meta charset="UTF-8">
    </head>
    <body>
        <header>
            <h1><a href="index.php">Welcome to XML2Emmet!</a></h1>
            <nav>
            <?php if ($loggedIn==true) { ?>
                <button onclick="location.href='./history.php'" type="button" class="nav_button">История</button>
                <button onclick="location.href='./src/logout.php'" type="button" class="nav_button">Изход</button>
            <?php } else { ?>
                <button onclick="location.href='./login.php'" type="button"  class="nav_button">Вход</button>
            <?php } ?>
            </nav>
        </header>
        <div class="user-data">
            <form action="http://localhost/FMI-WEB-Project/src/signup.php" method="POST" name="registration-form">
                <?php if (isset($_GET['error'])) { ?>

                    <p class="error"><?php echo $_GET['error']; ?></p>
        
                <?php } ?>
                <input class="user-data-field" id="username" name="username" type="text" placeholder="Username" required minlength="3" maxlength="10"/>
                <input class="user-data-field" id="email" name="email" type="email" placeholder="Email" required/>
                <input class="user-data-field" id="password" name="password" type="password" placeholder="Password" required/>
                <input class="user-data-field" id="conf_password" name="conf_password" type="password" placeholder="Confirm password" required/>
                <input class="sub_button" name="sub" type="submit" value="Register"/>
            </form>
        </div>
    </body>
</html>