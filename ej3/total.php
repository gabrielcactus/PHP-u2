<?php
session_start();

if (!isset($_POST["total"])) {
    header("location:mainpage.php");
    exit;
}

if (isset($_POST["inicio"])) {
    header("location:mainpage.php");
    exit;
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
    <table border="1" style="margin: 20px 0; border-radius: 8px; border-spacing: 0; overflow: hidden;" class="table">
        <tbody>
            <?php

                    echo "<td>";
                    print "Vendedores";
                    echo "</td>";
            for ($i = 1; $i < 11; $i++) {
                    echo "<td>";
                    print "Producto $i";
                    echo "</td>";
            }

            if (isset($_SESSION["lista"])) {
                for ($vendedores = 0; $vendedores < 18; $vendedores++) {
                    echo "<tr>";
                    echo "<td>";
                    print_r($_SESSION["vendedores"][$vendedores]);
                    echo "</td>";
                    for ($productos = 0; $productos < 10; $productos++) {
                        echo "<td>";
                        print_r($_SESSION["lista"][$vendedores][$productos]);
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>