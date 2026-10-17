<?php
session_start();

$mostrarRes = false;
if (isset($_POST["largo"], $_POST["alto"], $_POST["dimensiones"])) {
    $mostrarRes = true;
    $_SESSION["largo"] = $_POST["largo"];
    $_SESSION["alto"] = $_POST["alto"];

} else if (isset($_POST["pulsado"])) {
    $mostrarRes = true;
    $pulsado = [];
    $pulsado = $_POST["pulsado"];
}

if (isset($_SESSION["largo"], $_SESSION["alto"])) {
    $largo = $_SESSION["largo"];
    $alto = $_SESSION["alto"];
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
    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
        <label for="largo">Largo del tablero: </label>
        <input type="number" name="largo" id="largo">
        <label for="alto">Alto del tablero: </label>
        <input type="number" name="alto" id="alto">
        <button type="submit" name="dimensiones">Crear tablero</button>
    </form>
    <tbody>
        <?php
        if ($mostrarRes) {
            echo "<table border='1'>";
            for ($i = 0; $i < $alto; $i++) {
                echo "<tr>";
                for ($j = 0; $j < $largo; $j++) {
                    echo '<td>';
        ?>

                    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                        <button type="submit" name="pulsado" value="<?= $i . ',' . $j ?>"></button>
                    </form>
        <?php
                    echo '</td>';
                }
                echo "</tr>";
            }
            echo "</table>";
        }

        ?>
    </tbody>
</body>

</html>