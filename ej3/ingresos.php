<?php
session_start();

if (!isset($_POST["ingresos"])) {
    $_SESSION["mensaje"] = "";
    header("location:mainpage.php");
    exit;
}

if (isset($_POST["inicio"])) {
    $_SESSION["mensaje"] = "";
    header("location:mainpage.php");
    exit;
}

if (isset($_POST["vendedores_total"])) {
    $vendedor = $_POST["vendedores_total"];

    $total = 0;
    for ($productos = 0; $productos < 10; $productos++) {
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
            for ($vendedores = 0; $vendedores < count($_SESSION["vendedores"]); $vendedores++) {
            ?>
                <option value="<?= $vendedores ?>" <?= isset($_POST["vendedores_total"]) && $_POST["vendedores_total"] == $vendedores ? "selected" : "" ?>>
                    <?= $_SESSION["vendedores"][$vendedores] ?>
                </option> 
                <?php
                }
                ?>
        </select>

        <button type="submit" name="ingresos" class="btn btn-success btn-lg">Mostrar ingresos</button>
    </form>
    <table border="1" style="margin: 20px 0; border-radius: 8px; border-spacing: 0; overflow: hidden;" class="table">
        <tbody>
            <?php
            if (isset($_POST["vendedores_total"])) {
                if ($_POST["vendedores_total"] != "" && !is_null($_POST["vendedores_total"])) {
                    echo "<tr>";
                    echo "<td>";
                    print "Vendedor " . ($_POST["vendedores_total"] + 1);
                    echo "</td>";
                    for ($i = 1; $i < 11; $i++) {
                        echo "<td>";
                        print "Producto $i";
                        echo "</td>";
                    }
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td></td>";

                    for ($i = 0; $i < 10; $i++) {
                        echo "<td>" . $_SESSION["lista"][$_POST["vendedores_total"]][$i] . "</td>";
                    }

                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
</body>

</html>