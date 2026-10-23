<?php
session_start();

$_SESSION["pulsados"] = [];


function crearTablero(int $x, int $y) {
    $arrayVacio = [];
    for ($i=0;$i<$x;$i++) {
        for ($j=0;$j<$y;$j++) {
            $arrayVacio[$i][$j] = 1;
        }
    }
    $arrayVacio = generarCasillas($x, $y, $arrayVacio);
    $_SESSION["tablero"] = $arrayVacio;
}

function generarCasillas(int $x, int $y, array $tablero):array {
    $totalCasillas = $x*$y;
    for ($i=0;$i>round(($x * $y) * 20 / 100);$i++) {
        $tablero[rand(0,$x)][rand(0,$y)] = -2;
        print_r($tablero);
    }
    return $tablero;
}

$tableroCreado = false;
if (isset($_POST["largo"], $_POST["alto"], $_POST["dimensiones"])) {
    $tableroCreado = true;
    $_SESSION["largo"] = $_POST["largo"];
    $_SESSION["alto"] = $_POST["alto"];

    crearTablero($_POST["alto"], $_POST["largo"]);
}

$mostrar = false;
if (isset($_POST["posicion_x"])) {
    $mostrar = true;
    $fila = $_POST["fila"];
    $columna = $_POST["columna"];

    array_push($_SESSION["pulsados"], $fila, $columna);
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
            for ($i=0;$i<$_SESSION["alto"];$i++) {
                echo "<tr>";
                for ($j=0;$j<$_SESSION["largo"];$j++) {
                    echo "<td>";
                    ?>
                        <?php
                        if (isset($_SESSION["pulsados"][$fila][$columna])) {
                            ?>
                            <img src="./images_ejer6/Captura de pantalla 2025-03-31 124316.png" alt="Pulsado" style="width: 40px; height: 40px;>
                            <?php
                        } else {
                            ?>
                        <form action='<?= $_SERVER["PHP_SELF"] ?>' method="post">
                        <input type="image" name="posicion" id="posicion" src="./images_ejer6/Captura de pantalla 2025-03-31 145917.png" alt="" style="width: 40px; height: 40px;">
                        <input type="hidden" name="fila"  id="fila" value="<?= $i ?>">
                        <input type="hidden" name="columna" id="columna" value="<?= $j ?>">
                        </form>
                        <?php
                        }
                        ?>
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