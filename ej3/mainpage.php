<?php
session_start();

function crearArray()
{
    $lista = [];
    for ($vendedor = 0; $vendedor != 18; $vendedor++) {
        for ($producto = 0; $producto != 10; $producto++) {
            $lista[$vendedor][$producto] = 0;
        }
    }
    return $lista;
}

function cargarDatos()
{
    $lista = [];
    for ($vendedor = 0; $vendedor != 18; $vendedor++) {
        for ($producto = 0; $producto != 10; $producto++) {
            $lista[$vendedor][$producto] = rand(0, 1000);
        }
    }
    return $lista;
}

if (!isset($_SESSION["mensaje"])) {
    $_SESSION["mensaje"] = "";
}

if (!isset($_SESSION["lista"]) && !isset($_SESSION["vendedores"])) {
    $_SESSION["lista"] = crearArray();
    $_SESSION["vendedores"] = ["Vendedor 1", "Vendedor 2", "Vendedor 3", "Vendedor 4", "Vendedor 5", "Vendedor 6", "Vendedor 7", "Vendedor 8", "Vendedor 9", "Vendedor 10", "Vendedor 11", "Vendedor 12", "Vendedor 13", "Vendedor 14", "Vendedor 15", "Vendedor 16", "Vendedor 17", "Vendedor 18"];
}

if (isset($_POST["total"])) {
    $_SESSION["mensaje"] = "";
    header("location:total.php");
    exit;
}

if (isset($_POST["modificar"])) {
    $_SESSION["mensaje"] = "";
    header("location:modificar.php");
    exit;
}

if (isset($_POST["ingresos"])) {
    $_SESSION["mensaje"] = "";
    header("location:ingresos.php");
    exit;
}

if (isset($_POST["ingresos2"])) {
    $_SESSION["mensaje"] = "";
    header("location:ingresos2.php");
    exit;
}

if (isset($_POST["cargar"])) {
    $_SESSION["mensaje"] = "<p style='color:green;'>Datos cargados.</p>";
    $_SESSION["lista"] = cargarDatos();
}

if (isset($_POST["reiniciar"])) {
    session_destroy();
    session_start();
    $_SESSION["mensaje"] = "<p style='color:red;'>Datos reiniciados.</p>";
    $_SESSION["lista"] = crearArray();
    $_SESSION["vendedores"] = ["Vendedor 1", "Vendedor 2", "Vendedor 3", "Vendedor 4", "Vendedor 5", "Vendedor 6", "Vendedor 7", "Vendedor 8", "Vendedor 9", "Vendedor 10", "Vendedor 11", "Vendedor 12", "Vendedor 13", "Vendedor 14", "Vendedor 15", "Vendedor 16", "Vendedor 17", "Vendedor 18"];
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
    <form action="total.php" method="post" style="display: inline;">
        <button type="submit" name="total" class="btn btn-primary btn-lg">
            Ver total
        </button>
    </form>

    <form action="modificar.php" method="post" style="display: inline;">
        <button type="submit" name="modificar" class="btn btn-primary btn-lg">
            Modificar ventas
        </button>
    </form>

    <form action="ingresos.php" method="post" style="display: inline;">
        <button type="submit" name="ingresos" class="btn btn-primary btn-lg">
            Obtener ingresos por vendedor
        </button>
    </form>

    <form action="ingresos2.php" method="post" style="display: inline;">
        <button type="submit" name="ingresos2" class="btn btn-primary btn-lg">
            Obtener ingresos por producto
        </button>
    </form>

    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post" style="display: inline;">
        <button type="submit" name="cargar" class="btn btn-success btn-lg">
            Cargar datos
        </button>
    </form>

    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post" style="display: inline;">
        <button type="submit" name="reiniciar" class="btn btn-danger btn-lg">
            Reiniciar datos
        </button>
    </form>
</body>

</html>