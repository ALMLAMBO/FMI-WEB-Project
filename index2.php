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
        <?php if (isset($_GET['error'])) { ?>

            <p class="error"><?php echo $_GET['error']; ?></p>

        <?php } ?>
        <div class="container">
            <form action="http://localhost/FMI-WEB-Project/xml_to_emmet/xml_to_emmet.php" method="POST" id="xml_input">
            <?php if (isset($_SESSION['last_xml'])) {?>
                   <textarea class="input_box" placeholder="Enter XML" name="input_box"><?php print_r( $_SESSION['last_xml']);?></textarea>  
           <?php }else{?>
            <textarea class="input_box" placeholder="Enter XML" name="input_box"></textarea>
        <?php } ?>                 <input class="emmet_output" type="hidden" name="emmet_output" id='emmet2' value=""/>
            </form>
            <button onclick="location.href='./index.php'" type="button" class="change_button">⇌</button> 
            <pre id="emmet_output" class="output_box"><?php if (isset($_SESSION['last_emmet'])) {
                print_r($_SESSION['last_emmet']);
            }else{
                echo "Emmet output";
            }
            ?></pre>
        </div>
        <input form="xml_input" class="sub_button" type="submit" value="Convert" />

        <script>
            const form=document.getElementById('xml_input');
            form.addEventListener('submit', (event) => {
                event.preventDefault();
                document.getElementById("emmet_output").textContent = sessionStorage.getItem("last_emmet");
                <?php if($loggedIn){?>
                form.submit();
                <?php }?>
            });

        </script>
    </body>
</html>