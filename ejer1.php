<?php
require_once "ejer1_funciones.php";

$mostrarA = false;

if (isset($_POST["mensajeA"], $_POST["semillaA"], $_POST["accionA"])) {
    $mostrarA = true;

    $mensajeA = $_POST["mensajeA"];
    $semillaA = $_POST["semillaA"];
    $accionA = $_POST["accionA"];

    $resultadoA = "";

    if ($accionA == "codificarA" && comprobarSemilla1($semillaA) && comprobarMensaje($mensajeA)) {
        $resultadoA = codificarA($mensajeA, $semillaA);
    } else if ($accionA == "decodificarA" && comprobarSemilla1($semillaA) && comprobarMensaje($mensajeA)) {
        $resultadoA = deCodificarA($mensajeA, $semillaA);
    }
}

$mostrarB = false;

if (isset($_POST["mensajeB"], $_POST["semillaB"], $_POST["accionB"])) {
    $mostrarB = true;

    $mensajeB = $_POST["mensajeB"];
    $semillaB = $_POST["semillaB"];
    $accionB = $_POST["accionB"];

    $resultadoB = "";

    if ($accionB == "codificarB" && comprobarSemilla2($semillaB) && comprobarMensaje($mensajeB)) {
        $resultadoB = codificarB($mensajeB, $semillaB);
    } else if ($accionB == "decodificarB" && comprobarSemilla2($semillaB) && comprobarMensaje($mensajeB)) {
        $resultadoB = deCodificarB($mensajeB, $semillaB);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <h2>CODIFICACIÓN OPCIÓN A</h2>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="mensajeA">Mensaje: </label>
        <input type="text" name="mensajeA" id="mensajeA" value="<?= isset($_POST["mensajeA"])?$_POST["mensajeA"]:"" ?>" placeholder="Primer mensaje...">
        <label for="semillaA">Semilla (formato numérico, número superior a 0): </label>
        <input type="number" name="semillaA" id="semillaA" placeholder="1, 2, 3...">
        <button type="submit" name="accionA" value="codificarA" class="btn btn-primary">Codificar</button>
        <button type="submit" name="accionA" value="decodificarA" class="btn btn-secondary">Decodificar</button>
    </form>
    <?php
    if ($mostrarA == true && $accionA == "codificarA") {
        if ($resultadoA != "") {
            echo "<p>MENSAJE ORIGINAL: {$mensajeA}</p><br>
        <p>MENSAJE CODIFICADO CON SEMILLA {$semillaA}: {$resultadoA}</p>
        ";
        } else {
            echo "<p style='color:red;'>Error: no se ha podido codificar. Semilla inválida o mensaje o semilla vacíos.</p>";
        }
    } else if ($mostrarA == true && $accionA == "decodificarA") {
        if ($resultadoA != "") {
            echo "<p>MENSAJE CODIFICADO: {$mensajeA}</p><br>
        <p>MENSAJE DECODIFICADO CON SEMILLA {$semillaA}: {$resultadoA}</p>
        ";
        } else {
            echo "<p style='color:red;'>Error: no se ha podido decodificar. Semilla inválida o mensaje o semilla vacíos.</p>";
        }
    } else {
        echo "";
    }
    ?>
    <br>
    <h2>CODIFICACIÓN OPCIÓN B</h2>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="mensajeB">Mensaje: </label>
        <input type="text" name="mensajeB" id="mensajeB" value="<?= isset($_POST["mensajeB"])?$_POST["mensajeB"]:"" ?>" placeholder="Segundo mensaje...">
        <label for="semillaB">Semilla (con letras): </label>
        <input type="text" name="semillaB" id="semillaB" placeholder="ABC...">
        <button type="submit" name="accionB" value="codificarB" class="btn btn-primary">Codificar</button>
        <button type="submit" name="accionB" value="decodificarB" class="btn btn-secondary">Decodificar</button>
    </form>
    <?php
    if ($mostrarB == true && $accionB == "codificarB") {
        if ($resultadoB != "") {
            echo "<p>MENSAJE ORIGINAL: {$mensajeB}</p><br>
        <p>MENSAJE CODIFICADO CON SEMILLA {$semillaB}: {$resultadoB}</p>
        ";
        } else {
            echo "<p style='color:red;'>Error: no se ha podido codificar. Semilla inválida o mensaje o semilla vacíos.</p>";
        }
    } else if ($mostrarB == true && $accionB == "decodificarB") {
        if ($resultadoB != "") {
            echo "<p>MENSAJE CODIFICADO: {$mensajeB}</p><br>
        <p>MENSAJE DECODIFICADO CON SEMILLA {$semillaB}: {$resultadoB}</p>
        ";
        } else {
            echo "<p style='color:red;'>Error: no se ha podido decodificar. Semilla inválida o mensaje o semilla vacíos.</p>";
        }
    } else {
        echo "";
    }
    ?>
</body>

</html>