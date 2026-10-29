<?php
require_once "ejer1_funciones.php";

$mostrarA = false;

if (isset($_POST["mensajeA"], $_POST["semillaA"], $_POST["accionA"])) {
    $mostrarA = true;

    $mensaje = $_POST["mensajeA"];
    $semilla = $_POST["semillaA"];
    $accion = $_POST["accionA"];

    $resultado = "";

    if ($accion == "codificarA" && comprobarSemilla1($semilla) && comprobarMensaje($mensaje)) {
        $resultado = codificarA($mensaje, $semilla);
    } else if ($accion == "decodificarA" && comprobarSemilla1($semilla) && comprobarMensaje($mensaje)) {
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

    if ($accion == "codificarB" && comprobarSemilla2($semilla) && comprobarMensaje($mensaje)) {
        $resultado = codificarB($mensaje, $semilla);
    } else if ($accion == "decodificarB" && comprobarSemilla2($semilla) && comprobarMensaje($mensaje)) {
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <h2>CODIFICACIÓN OPCIÓN A</h2>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="mensajeA">Mensaje: </label>
        <input type="text" name="mensajeA" id="mensajeA">
        <label for="semillaA">Semilla (formato numérico, número superior a 0): </label>
        <input type="number" name="semillaA" id="semillaA">
        <button type="submit" name="accionA" value="codificarA" class="btn btn-primary">Codificar</button>
        <button type="submit" name="accionA" value="decodificarA" class="btn btn-secondary">Decodificar</button>
    </form>
    <?php
    if ($mostrarA == true && $accion == "codificarA") {
        if ($resultado != "") {
            echo "<p>MENSAJE ORIGINAL: {$mensaje}</p><br>
        <p>MENSAJE CODIFICADO CON SEMILLA {$semilla}: {$resultado}</p>
        ";
        } else {
            echo "<p style='color:red;'>Error: no se ha podido codificar. Semilla inválida o mensaje o semilla vacíos.</p>";
        }
    } else if ($mostrarA == true && $accion == "decodificarA") {
        if ($resultado != "") {
            echo "<p>MENSAJE CODIFICADO: {$mensaje}</p><br>
        <p>MENSAJE DECODIFICADO CON SEMILLA {$semilla}: {$resultado}</p>
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
        <input type="text" name="mensajeB" id="mensajeB">
        <label for="semillaB">Semilla (con letras): </label>
        <input type="text" name="semillaB" id="semillaB">
        <button type="submit" name="accionB" value="codificarB" class="btn btn-primary">Codificar</button>
        <button type="submit" name="accionB" value="decodificarB" class="btn btn-secondary">Decodificar</button>
    </form>
    <?php
    if ($mostrarB == true && $accion == "codificarB") {
        if ($resultado != "") {
            echo "<p>MENSAJE ORIGINAL: {$mensaje}</p><br>
        <p>MENSAJE CODIFICADO CON SEMILLA {$semilla}: {$resultado}</p>
        ";
        } else {
            echo "<p style='color:red;'>Error: no se ha podido codificar. Semilla inválida o mensaje o semilla vacíos.</p>";
        }
    } else if ($mostrarB == true && $accion == "decodificarB") {
        if ($resultado != "") {
            echo "<p>MENSAJE CODIFICADO: {$mensaje}</p><br>
        <p>MENSAJE DECODIFICADO CON SEMILLA {$semilla}: {$resultado}</p>
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