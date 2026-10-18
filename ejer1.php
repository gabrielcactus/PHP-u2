<?php

function codificarA(string $mensaje, int $semilla): string
{
    $abecedario = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];

    $mensaje = strtoupper($mensaje);
    $mensajeFinal = "";
    for ($i = 0; $i < strlen($mensaje); $i++) {
        $posicion = array_search($mensaje[$i], $abecedario);

        if ($mensaje[$i] == " ") {
            $mensajeFinal .= " ";
            continue;
        }

        if ($posicion === false) {
            $mensajeFinal .= $mensaje[$i];
        } else {
            $nuevaPosicion = ($posicion + $semilla) % count($abecedario);;
            $mensajeFinal .= $abecedario[$nuevaPosicion];
        }
    }
    return $mensajeFinal;
}

function deCodificarA(string $mensaje, int $semilla): string
{
    $abecedario = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];

    $mensaje = strtoupper($mensaje);
    $mensajeFinal = "";
    for ($i = 0; $i < strlen($mensaje); $i++) {
        $posicion = array_search($mensaje[$i], $abecedario);

        if ($mensaje[$i] == " ") {
            $mensajeFinal .= " ";
            continue;
        }

        if ($posicion === false) {
            $mensajeFinal .= $mensaje[$i];
        } else {
            $nuevaPosicion = ($posicion - $semilla) % count($abecedario);;
            $mensajeFinal .= $abecedario[$nuevaPosicion];
        }
    }
    return $mensajeFinal;
}

function codificarB(string $mensaje, string $semilla): string
{
    $abecedario = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
    $mensaje = strtoupper($mensaje);
    $semilla = str_replace(" ", "" ,trim(strtoupper($semilla)));
    $mensajeFinal = "";


    $contador = 0;
    for ($i = 0; $i < strlen($mensaje); $i++) {
        $posicion = array_search($mensaje[$i], $abecedario);

        if ($mensaje[$i] == " ") {
            $mensajeFinal .= " ";
            continue;
        }

        $indiceSemilla = $contador % strlen($semilla);
        $posicionSemilla = array_search($semilla[$indiceSemilla], $abecedario);

        if ($posicion === false) {
            $mensajeFinal .= $mensaje[$i];
        } else {
            $nuevaPosicion = ($posicion + $posicionSemilla + 1) % count($abecedario);
            $mensajeFinal .= $abecedario[$nuevaPosicion];
            $contador++;
        }
    }

    return $mensajeFinal;
}

function deCodificarB(string $mensaje, string $semilla): string
{
    $abecedario = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
    $mensaje = strtoupper($mensaje);
    $semilla = str_replace(" ", "" ,trim(strtoupper($semilla)));
    $mensajeFinal = "";


    $contador = 0;
    for ($i = 0; $i < strlen($mensaje); $i++) {
        $posicion = array_search($mensaje[$i], $abecedario);

        if ($mensaje[$i] == " ") {
            $mensajeFinal .= " ";
            continue;
        }

        $indiceSemilla = $contador % strlen($semilla);
        $posicionSemilla = array_search($semilla[$indiceSemilla], $abecedario);

        if ($posicion === false) {
            $mensajeFinal .= $mensaje[$i];
        } else {
            $nuevaPosicion = ($posicion - $posicionSemilla - 1 + count($abecedario)) % count($abecedario);
            $mensajeFinal .= $abecedario[$nuevaPosicion];
            $contador++;
        }
    }

    return $mensajeFinal;
}

$mostrarA = false;

if (isset($_POST["mensajeA"], $_POST["semillaA"], $_POST["accionA"])) {
    $mostrarA = true;

    $mensaje = $_POST["mensajeA"];
    $semilla = $_POST["semillaA"];
    $accion = $_POST["accionA"];

    $resultado = "";

    if ($accion == "codificarA" && $mensaje != "" && $semilla != null) {
        $resultado = codificarA($mensaje, $semilla);
    } else if ($accion == "decodificarA" && $mensaje != "" && $semilla != null) {
        $resultado = deCodificarA($mensaje, $semilla);
    }
}

$mostrarB = false;

if (isset($_POST["mensajeB"], $_POST["semillaB"], $_POST["accionB"])) {
    $mostrarB = true;

    $mensaje = $_POST["mensajeB"];
    $semilla = $_POST["semillaB"];
    $accion = $_POST["accionB"];

    $resultado = "";

    if ($accion == "codificarB" && $mensaje != "" && $semilla != null) {
        $resultado = codificarB($mensaje, $semilla);
    } else if ($accion == "decodificarB" && $mensaje != "" && $semilla != null) {
        $resultado = deCodificarB($mensaje, $semilla);
    }
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
    <h2>CODIFICACIÓN OPCIÓN A</h2>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="mensajeA">Mensaje: </label>
        <input type="text" name="mensajeA" id="mensajeA">
        <label for="semillaA">Semilla (formato numérico): </label>
        <input type="number" name="semillaA" id="semillaA">
        <button type="submit" name="accionA" value="codificarA">Codificar</button>
        <button type="submit" name="accionA" value="decodificarA">Decodificar</button>
    </form>
    <?php
    if ($mostrarA == true && $accion == "codificarA" && $mensaje != "" && $semilla != null) {
        echo "<p>MENSAJE ORIGINAL: {$mensaje}</p><br>
        <p>MENSAJE CODIFICADO CON SEMILLA {$semilla}: {$resultado}</p>
        ";
    } else if ($mostrarA == true && $accion == "decodificarA" && $mensaje != "" && $semilla != null) {
        echo "<p>MENSAJE CODIFICADO: {$mensaje}</p><br>
        <p>MENSAJE DECODIFICADO CON SEMILLA {$semilla}: {$resultado}</p>
        ";
    } else {
        echo "";
    }
    ?>
    <h2>CODIFICACIÓN OPCIÓN B</h2>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="mensajeB">Mensaje: </label>
        <input type="text" name="mensajeB" id="mensajeB">
        <label for="semillaB">Semilla (con letras): </label>
        <input type="text" name="semillaB" id="semillaB">
        <button type="submit" name="accionB" value="codificarB">Codificar</button>
        <button type="submit" name="accionB" value="decodificarB">Decodificar</button>
    </form>
    <?php
    if ($mostrarB == true && $accion == "codificarB" && $mensaje != "" && $semilla != null) {
        echo "<p>MENSAJE ORIGINAL: {$mensaje}</p><br>
        <p>MENSAJE CODIFICADO CON SEMILLA {$semilla}: {$resultado}</p>
        ";
    } else if ($mostrarB == true && $accion == "decodificarB" && $mensaje != "" && $semilla != null) {
        echo "<p>MENSAJE CODIFICADO: {$mensaje}</p><br>
        <p>MENSAJE DECODIFICADO CON SEMILLA {$semilla}: {$resultado}</p>
        ";
    } else {
        echo "";
    }
    ?>
</body>

</html>