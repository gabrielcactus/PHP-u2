<?php
session_start();

if (!isset($_POST["ingresos"])) {
    header("location:mainpage.php");
    exit;
}

if (isset($_POST["vendedores_total"])) {
    $vendedor = $_POST["vendedores_total"];

    $total = 0;
    for ($productos = 0;$productos<10;$productos++) {
        $total += $_SESSION["lista"][$vendedor][$productos];
    }
    echo "<h1>Total de los ingresos de {$_SESSION["vendedores"][$vendedor]}: {$total}</h1>";
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
    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
        <button type="submit" name="inicio" class="btn btn-primary btn-lg">Volver a la página principal</button>
    </form>
    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
        <select name="vendedores_total" id="vendedores_total">
            <?php
            for ($vendedores = 0;$vendedores<count($_SESSION["vendedores"]);$vendedores++) {
                ?>
                <option value="<?= $vendedores ?>"><?= $_SESSION["vendedores"][$vendedores] ?></option>
                <?php
            }
            ?>
        </select>
        
        <button type="submit" name="ingresos" class="btn btn-success btn-lg">Mostrar ingresos</button>
    </form>
</body>
</html>