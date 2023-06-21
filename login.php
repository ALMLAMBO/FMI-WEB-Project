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
        <div class="user-data">
            <form action="http://localhost/FMI-WEB-Project/src/login.php" onsubmit = "return validation()" method="POST" name="login">
                <?php if (isset($_GET['error'])) { ?>

                    <p class="error"><?php echo $_GET['error']; ?></p>
        
                <?php } ?>
                <input class="user-data-field" id="username" name="username" type="text" placeholder="Username"/>
                <input class="user-data-field" id="password" name="password" type="password" placeholder="Password"/>
                <input class="sub_button" name="sub" type="submit" value="Log in"/>
            </form>
            <p>Ако нямате профил може да се <a href="">Регистрирате</a></p>
        </div>
    </body>
    <script>  
        function validation()  
        {  
            var username=document.getElementById('username').value;
            var pass=document.getElementById('password').value;
            if(username.length=="" && pass.length=="") {  
                alert("Username and Password fields are empty");  
                return false;  
            }  
            else  
            {  
                if(username.length=="") {  
                    alert("Username is empty");  
                    return false;  
                }   
                if (pass.length=="") {  
                alert("Password field is empty");  
                return false;  
                }  
            }                             
        }  
    </script> 
</html>