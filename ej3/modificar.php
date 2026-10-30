<?php
session_start();
$_SESSION["mensaje"] = "";

if (!isset($_SESSION["mensaje"])) {
    $_SESSION["mensaje"] = "";
}

if (!isset($_POST["modificar"])) {
    $_SESSION["mensaje"] = "";
    header("location:mainpage.php");
    exit;
}

if (isset($_POST["inicio"])) {
    $_SESSION["mensaje"] = "";
    header("location:mainpage.php");
    exit;
}

if (isset($_POST["vendedores"], $_POST["productos"], $_POST["cantidad"], $_POST["modificar"])) {
    $vendedores = $_POST["vendedores"];
    $productos = $_POST["productos"];
    $cantidad = $_POST["cantidad"];

    if ($cantidad<0 || is_null($cantidad)) {
        $_SESSION["mensaje"] = "<h1 style='color:red;'>No se ha podido actualizar el producto</h1>";
    } else {
        $_SESSION["lista"][$vendedores][$productos] = $cantidad;
        $_SESSION["mensaje"] = "<h1 style='color:green;'>Producto actualizado</h1>";
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
    <?= isset($_SESSION["mensaje"])?$_SESSION["mensaje"]:"" ?>
    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
        <button type="submit" name="inicio" class="btn btn-primary btn-lg">Volver a la página principal</button>
    </form>
    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
        <select name="vendedores" id="vendedores">
            <?php
            for ($vendedores = 0;$vendedores<count($_SESSION["vendedores"]);$vendedores++) {
                ?>
                <option value="<?= $vendedores ?>"><?= $_SESSION["vendedores"][$vendedores] ?></option>
                <?php
            }
            ?>
        </select>
        <select name="productos" id="productos">
            <?php
            for ($productos = 0;$productos<10;$productos++) {
                ?>
                <option value="<?= $productos ?>">Producto <?= $productos + 1 ?></option>
                <?php
            }
            ?>
        </select>
        <input type="number" name="cantidad" id="cantidad">
        <button type="submit" name="modificar" class="btn btn-success btn-lg">Enviar</button>
    </form>
</body>
</html>