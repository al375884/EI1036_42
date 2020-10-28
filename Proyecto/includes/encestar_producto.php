<?php

function encestar_producto($table, $cliente, $producto)
{
    global $pdo;

    /*$datos = $_REQUEST;
    if (count($_REQUEST) < 2) {
        $data["error"] = "No has rellenado el formulario correctamente";
        return;
    }*/

    $fecha = "2020-10-28";

    $query = "INSERT INTO $table (client_id, product_id, date_compra)
                          VALUES (?,?,?)";
    try { 
        $a=array($cliente, $producto, $fecha);
        $consult = $pdo->prepare($query);
        $a=$consult->execute(array($cliente, $producto, $fecha));

        /*if (1>$a) echo "<h1> Inserción incorrecta </h1>";
        else echo "<h1> Producto añadido a la cesta! </h1>";*/

        $_SESSION["usuario"] = "normal";
    
    } catch (PDOExeption $e) {
        echo ($e->getMessage());
    }
}
?>