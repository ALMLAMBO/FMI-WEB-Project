<?php
session_start();

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
    $loggedIn = true;
} else {
    $loggedIn = false;
}

include ("./config/Config.php");
$conn =  Config::mysql_conection(); 
$id = $_SESSION['id'];
$query = "SELECT * FROM users_conversions Join conversions on conversion_id=conversions.id where user_id='$id' ORDER BY users_conversions.converted_at DESC";
$res = mysqli_query($conn,$query);
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
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Input</th>
                    <th>Result</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php while( $row=  mysqli_fetch_array($res)){?>
                    <tr>
                        <td><?php echo $row['converted_at']; ?></td>
                        <td><?php echo $row['from_what']; ?></td>
                        <td><?php echo $row['to_what']; ?></td>
                        <td><?php echo htmlspecialchars($row['content_to_convert']) ;?></td>
                        <td><?php echo htmlspecialchars($row['result_from_conversion'] );?></td>
                        <td class="for_button">
                            <form action="./src/openHistory.php" method="POST">
                                <input type="hidden" name="conv_id" value="<?php echo $row['conversion_id'] ?>"/>
                                <input class="open_button" name="sub" type="submit" value="Отвори"/>
                            </form>
                        </td>
                    </tr>
            <?php }?>
            </tbody>
</html>