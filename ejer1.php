<?php

function codificar(string $mensaje, int $semilla): string
{
    $abecedario = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];

    $mensaje = strtoupper($mensaje);
    $mensajeFinal = "";
    for ($i = 0; $i < strlen($mensaje); $i++) {
        $posicion = array_search($mensaje[$i], $abecedario);

        if ($posicion === false) {
            $mensajeFinal .= $abecedario[$posicion + $semilla];
        } else {
            $nuevaPosicion = ($posicion + $semilla) % 26;
            $mensajeFinal .= $abecedario[$nuevaPosicion];
        }
    }
    return $mensajeFinal;
}

$mostrar = false;

if (isset($_POST["mensaje"], $_POST["semilla"])) {
    $mostrar = true;

    $mensaje = $_POST["mensaje"];
    $semilla = $_POST["semilla"];

    $resultado = codificar($mensaje, $semilla);
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
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="mensaje">Mensaje: </label>
        <input type="text" name="mensaje" id="mensaje">
        <label for="semilla">Semilla: </label>
        <input type="number" name="semilla" id="semilla">
        <button type="submit">Enviar</button>
    </form>
    <?php
    if ($mostrar == true) {
        echo "<p>MENSAJE ORIGINAL: {$mensaje}</p><br>
        <p>MENSAJE CODIFICADO CON SEMILLA {$semilla}: {$resultado}</p>
        ";
    }
    ?>
</body>

</html>
nigger