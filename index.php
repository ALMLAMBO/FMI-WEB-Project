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
        <script type="text/javascript" src="./src/emmet2xml.js">></script>
        <meta charset="UTF-8">
    </head>
    <body>
        <header>
            <h1><a href="index.php">Welcome to XML2Emmet!</a></h1>
            <!--<div class="header_container">-->
            
            <nav>
            <?php if ($loggedIn==true) { ?>
                <button onclick="location.href='./history.php'" type="button" class="nav_button">История</button>
                <button onclick="location.href='./src/logout.php'" type="button" class="nav_button">Изход</button>
            <?php } else { ?>
                <button onclick="location.href='./login.php'" type="button"  class="nav_button">Вход</button>
            <?php } ?>
            </nav>
            <?php if (isset($_GET['message'])) { ?>
                <h3 class="message"><?php echo $_GET['message']; ?></h3>
            <?php } ?>
            <!--</div>-->
        </header>
        <?php if (isset($_GET['error'])) { ?>

            <p class="error"><?php echo $_GET['error']; ?></p>

        <?php } ?>
        <div class="container">
            <form action="./src/emmet2xml.php" method="POST" id="emmet_input">
         
            <?php if (isset($_SESSION['last_emmet'])) {?>
                   <textarea class="input_box" placeholder="Enter Emmet" name="input_box"><?php print_r( $_SESSION['last_emmet']);?></textarea>  
           <?php }else{?>
            <textarea class="input_box" placeholder="Enter Emmet" name="input_box"></textarea> 
        <?php } ?> 
           
            <input class="xml_output" type="hidden" name="xml_output" id='xml2' value=""/>
            </form>
            <button onclick="location.href='./index2.php'" type="button" class="change_button">⇌</button> 
            <pre id="xml_output" class="output_box"><?php if (isset($_SESSION['last_xml'])) {
                print_r($_SESSION['last_xml']);
            }else{
                echo "XML output";
            }
            ?></pre>
        </div>
        <input form="emmet_input" class="sub_button" type="submit" value="Convert" /> 

        <script>
               
            const form=document.getElementById('emmet_input');
            form.addEventListener('submit', (event) => {
                event.preventDefault();
                var emmet_input=document.querySelector('.input_box').value;
                console.log(emmet_input.val);
                var xml_output=EmmetToXML(emmet_input);
                console.log(xml_output);
                document.getElementById("xml_output").textContent =xml_output;
                var text=document.getElementById("xml2")
                text.value+=xml_output;
                form.submit();
            });
            
        </script>
    </body>
</html>