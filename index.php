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
        <?php if (isset($_GET['message'])) { ?>

<h3 class="message"><?php echo $_GET['message']; ?></h3>

<?php } ?>
        <div class="container">
            <form action="emmet2xml.php" method="POST" id="emmet_input">
                <textarea class="input_box" placeholder="Enter Emmet"></textarea>
            </form>
            <button onclick="location.href='./index2.php'" type="button" class="change_button">⇌</button> 
            <code id="xml_output" class="output_box">XML output</code>
        </div>
        <input form="emmet_input" class="sub_button" type="submit" value="Convert" /> 
    </body>
</html>