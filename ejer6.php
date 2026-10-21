<?php
session_start();

function crearTablero(int $x, int $y) {
    $arrayVacio = [];
    for ($i=0;$i<$x;$i++) {
        for ($j=0;$j<$y;$j++) {
            $arrayVacio[$i][$j] = 1;
        }
    }
    $_SESSION["tablero"] = $arrayVacio;
}

$tableroCreado = false;
if (isset($_POST["largo"], $_POST["alto"], $_POST["dimensiones"])) {
    $tableroCreado = true;
    $largo = $_POST["largo"];
    $alto = $_POST["alto"];

    crearTablero($largo, $alto);


} 


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if(!$tableroCreado) {
        ?>
        <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
        <label for="largo">Largo del tablero: </label>
        <input type="number" name="largo" id="largo">
        <label for="alto">Alto del tablero: </label>
        <input type="number" name="alto" id="alto">
        <button type="submit" name="dimensiones">Crear tablero</button>
    </form>
    <?php
    }
    ?>
    
    <table border="1">
        <tbody>
        <?php
        if ($tableroCreado) {
            for ($i=0;$i<$largo;$i++) {
                echo "<tr>";
                for ($j=0;$j<$alto;$j++) {
                    echo "<td>";
                    ?>
                    <form action='<?= $_SERVER["PHP_SELF"] ?>' method="post">
                        <input type="image" src="./images_ejer6/vacio.png" alt="" style="width: 40px; height: 40px;">
                    </form>
                    <?php
                    echo "</td>";
                }
                echo "</tr>";
            }
        }
        ?>
    </tbody>
    </table>
</body>

</html>