
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

if (!isset($_SESSION["lista"])){
    $_SESSION["lista"] = crearArray();
}

echo "<pre>";
print_r($_SESSION["lista"]);
echo "</pre>";
?>