<?php

// no sabemos si hay que pasar pdo a la funcion como en la P1

function registrar_producto($table)
{
    global $pdo;

    $datos = $_REQUEST;
    if (count($_REQUEST) < 2) {
        $data["error"] = "No has rellenado el formulario correctamente";
        return;
    }
    $name = $_POST["name"];
    $price = $_POST["price"];
    $foto_url = $_POST["foto_url"];
    $query = "INSERT INTO $table (name, price, foto_url)
                          VALUES (?,?,?)";
    try { 
        $a=array($name, $price, $foto_url);
        $consult = $pdo->prepare($query);
        $a=$consult->execute(array($name, $price, $foto_url));

        if (1>$a) echo "<h1> Inserción incorrecta </h1>";
        else echo "<h1> Producto registrado! </h1>";

        #$_SESSION["usuario"] = "normal";
    
    } catch (PDOExeption $e) {
        echo ($e->getMessage());
    }
}
?>