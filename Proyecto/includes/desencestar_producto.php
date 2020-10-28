<?php

function desencestar_producto($table, $item_id)
{
    global $pdo;

    /*$datos = $_REQUEST;
    if (count($_REQUEST) < 2) {
        $data["error"] = "No has rellenado el formulario correctamente";
        return;
    }*/

    $query = "DELETE FROM $table WHERE item_id=?";
    try { 
        $a=array($item_id);
        $consult = $pdo->prepare($query);
        $a=$consult->execute(array($item_id));

        /*if (1>$a) echo "<h1> Inserción incorrecta </h1>";
        else echo "<h1> Producto añadido a la cesta! </h1>";*/

        $_SESSION["usuario"] = "normal";
    
    } catch (PDOExeption $e) {
        echo ($e->getMessage());
    }
}