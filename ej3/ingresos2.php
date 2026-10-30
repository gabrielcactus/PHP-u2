<?php
session_start();

if (!isset($_POST["ingresos2"])) {
    $_SESSION["mensaje"] = "";
    header("location:mainpage.php");
    exit;
}

if (isset($_POST["inicio"])) {
    $_SESSION["mensaje"] = "";
    header("location:mainpage.php");
    exit;
}

if (isset($_POST["productos"])) {
    $producto = $_POST["productos"];

    $total = 0;
    for ($vendedores = 0;$vendedores<count($_SESSION["vendedores"]);$vendedores++) {
        $total += $_SESSION["lista"][$vendedores][$producto];
    }
    $producto++;
    echo "<h1>Total de los ingresos del producto {$producto}: {$total}</h1>";
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
        <select name="productos" id="productos">
            <?php
                for ($productos = 0;$productos<11;$productos++) {
                ?>
                <option value="<?= $productos ?>" <?= isset($_POST["productos"]) && $_POST["productos"] == $productos ? "selected":"" ?>>Producto <?= $productos + 1 ?></option>
                <?php
            }
            ?>
        </select>
        
        <button type="submit" name="ingresos2" class="btn btn-success btn-lg">Mostrar ingresos</button>
    </form>
    <table border="1" style="margin: 20px 0; border-radius: 8px; border-spacing: 0; overflow: hidden;" class="table">
        <tbody>
            <?php
            if (isset($_POST["productos"])) {
                if ($_POST["productos"] != "" && !is_null($_POST["productos"])) {
                    echo "<tr>";
                    echo "<td>";
                    print "Producto " . ($_POST["productos"] + 1);
                    echo "</td>";
                    for ($i = 1; $i <= 18; $i++) {
                        echo "<td>";
                        print "Vendedor $i";
                        echo "</td>";
                    }
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td></td>";

                    for ($i = 0; $i < 18; $i++) {
                        echo "<td>" . $_SESSION["lista"][$i][$_POST["productos"]] . "</td>";
                    }

                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</body>
</html>