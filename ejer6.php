<?php
session_start();

function crearTablero(int $x, int $y)
{
    $arrayVacio = [];
    for ($i = 0; $i < $x; $i++) {
        for ($j = 0; $j < $y; $j++) {
            $arrayVacio[$i][$j] = 0;
        }
    }
    $arrayVacio = generarCasillas($x, $y, $arrayVacio);
    $_SESSION["tablero"] = $arrayVacio;
}

function generarCasillas(int $x, int $y, array $tablero): array
{
    $cantidadBombas = round(($x * $y) * 20 / 100);
    $cantidadVidas = round(($x * $y) * 8 / 100);
    $cantidadTesoros = 1;

    $colocadas = 0;
    while ($colocadas < $cantidadBombas) {
        $fila = rand(0, $x - 1);
        $columna = rand(0, $y - 1);

        if ($tablero[$fila][$columna] == 0) {
            $tablero[$fila][$columna] = -1;
            $colocadas++;
        }
    }

    $colocadas = 0;
    while ($colocadas < $cantidadVidas) {
        $fila = rand(0, $x - 1);
        $columna = rand(0, $y - 1);

        if ($tablero[$fila][$columna] == 0) {
            $tablero[$fila][$columna] = 1;
            $colocadas++;
        }
    }

    $colocadas = 0;
    while ($colocadas < $cantidadTesoros) {
        $fila = rand(0, $x - 1);
        $columna = rand(0, $y - 1);

        if ($tablero[$fila][$columna] == 0) {
            $tablero[$fila][$columna] = 2;
            $colocadas++;
        }
    }

    return $tablero;
}

if (!isset($_SESSION["pulsados"])) {
    $_SESSION["pulsados"] = [];
}

if (!isset($_SESSION["vidas"])) {
    $_SESSION["vidas"] = 3;
}

if (!isset($_SESSION["mensaje"])) {
    $_SESSION["mensaje"] = "";
}

if (!isset($_SESSION["ganado"])) {
    $_SESSION["ganado"] = false;
}

if (!isset($_SESSION["perdido"])) {
    $_SESSION["perdido"] = false;
}

$tableroCreado = false;
if (isset($_POST["largo"], $_POST["alto"], $_POST["dimensiones"])) {
    $_SESSION["largo"] = $_POST["largo"];
    $_SESSION["alto"] = $_POST["alto"];

    if ($_SESSION["largo"] < 5 || $_SESSION["alto"] < 5) {
        $tableroCreado = false;
        echo "<p style='color:red;'>Error: Ambas dimensiones han de ser mínimo de 5x5</p>";
    } else if (!empty($_SESSION["alto"]) && !empty($_SESSION["largo"])) {
        $tableroCreado = true;
        crearTablero($_POST["alto"], $_POST["largo"]);
    }
} else if (isset($_SESSION["tablero"])) {
    $tableroCreado = true;
}

if (isset($_POST["fila"], $_POST["columna"]) && !$_SESSION["perdido"] && !$_SESSION["ganado"]) {
    $fila = $_POST["fila"];
    $columna = $_POST["columna"];

    $_SESSION["pulsados"][$fila][$columna] = true;

    if ($_SESSION["tablero"][$fila][$columna] == -1) {
        $_SESSION["mensaje"] = "<p style='color:red;'>Casilla bomba, has perdido 1 vida</p>";
        $_SESSION["vidas"]--;
        if ($_SESSION["vidas"] == 0) {
            $_SESSION["perdido"] = true;
            $_SESSION["mensaje"] = "<h1 style='color:red;'>HAS PERDIDO</h1>";
        }
    } else if ($_SESSION["tablero"][$fila][$columna] == 1) {
        $_SESSION["mensaje"] = "<p style='color:green;'>Casilla de vida, has conseguido 1 vida!</p>";
        $_SESSION["vidas"]++;
    } else if ($_SESSION["tablero"][$fila][$columna] == 2) {
        $_SESSION["ganado"] = true;
        $_SESSION["mensaje"] = "<h1 style='color:green;'>Casilla del tesoro, HAS GANADO</h1>";
        $ganado = true;
    } else {
        $_SESSION["mensaje"] = "<p>Casilla vacía</p>";
    }
}

if (isset($_POST["reiniciar"])) {
    $tableroCreado = false;
    session_destroy();
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
    if (!$tableroCreado) {
    ?>
        <p>Introduce las dimensiones: (al menos 5x5)</p>
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

    <?php
    if ($tableroCreado) {
        echo "<p>Tienes: {$_SESSION["vidas"]} vidas</p>";
        if (isset($_SESSION["mensaje"])) {
            echo "{$_SESSION["mensaje"]}";
        }
    ?>
        <table border="1">
            <tbody>
                <?php
                for ($i = 0; $i < $_SESSION["alto"]; $i++) {
                    echo "<tr>";
                    for ($j = 0; $j < $_SESSION["largo"]; $j++) {
                        echo "<td>";

                        if (isset($_SESSION["pulsados"][$i][$j]) && $_SESSION["tablero"][$i][$j] == 1) {
                        
                        echo '<img src="./images_ejer6/vida.png" alt="Pulsado" style="width: 50px; height: 50px;">';

                        } else if (isset($_SESSION["pulsados"][$i][$j]) && $_SESSION["tablero"][$i][$j] == -1) {

                        echo '<img src="./images_ejer6/bomba.png" alt="Pulsado" style="width: 50px; height: 50px;">';

                        } else if (isset($_SESSION["pulsados"][$i][$j]) && $_SESSION["tablero"][$i][$j] == 2) {
                            
                        echo '<img src="./images_ejer6/tesoro.png" alt="Pulsado" style="width: 50px; height: 50px;">';
                        
                        } else if (isset($_SESSION["pulsados"][$i][$j]) && $_SESSION["tablero"][$i][$j] == 0) {
                        
                        echo '<img src="./images_ejer6/vacio.png" alt="Pulsado" style="width: 50px; height: 50px;">';
                        
                        } else if (!$_SESSION["ganado"] && !$_SESSION["perdido"]) {
                        ?>
                            <form action='<?= $_SERVER["PHP_SELF"] ?>' method="post">
                                <input type="image" name="posicion" id="posicion" src="./images_ejer6/inicial.png" alt="" style="width: 50px; height: 50px;">
                                <input type="hidden" name="fila" id="fila" value="<?= $i ?>">
                                <input type="hidden" name="columna" id="columna" value="<?= $j ?>">
                            </form>
                        <?php
                        } else {

                        echo '<img src="./images_ejer6/inicial.png" alt="Pulsado" style="width: 50px; height: 50px;">';

                        }
                        ?>
                <?php
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                ?>
                <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
                    <button type="submit" name="reiniciar">Reiniciar</button>
                </form>
            <?php
        }
            ?>
            </tbody>
        </table>
</body>

</html>