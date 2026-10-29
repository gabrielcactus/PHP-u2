<?php
session_start();

function crearArray() {
    $lista = [];
    for ($vendedor=0;$vendedor != 18;$vendedor++){
            for ($producto=0;$producto != 10;$producto++){
                    $lista[$vendedor][$producto] = 0;
            }
    }    
    return $lista;
}

if (!isset($_SESSION["lista"]) && !isset($_SESSION["vendedores"])){
    $_SESSION["lista"] = crearArray();
    $_SESSION["vendedores"] = ["Vendedor 1", "Vendedor 2", "Vendedor 3", "Vendedor 4", "Vendedor 5", "Vendedor 6", "Vendedor 7", "Vendedor 8", "Vendedor 9", "Vendedor 10", "Vendedor 11", "Vendedor 12", "Vendedor 13", "Vendedor 14", "Vendedor 15", "Vendedor 16", "Vendedor 17", "Vendedor 18"];
}

if(isset($_POST["total"])){
    header("location:total.php");
    exit;
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
    <form action="total.php" method="post" style="display: inline;">
        <button type="submit" name="total">Ver total</button>
    </form>
    <form action="modificar.php" method="post" style="display: inline;">
        <button type="submit" name="modificar">Modificar ventas</button>
    </form>
</body>
</html>