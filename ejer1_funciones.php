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
?>