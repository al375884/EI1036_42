<?php

function realizar_compra($table, $productos)
{
    global $pdo;

    $datos = $_REQUEST;
    if (count($_REQUEST) < 2) {
        $data["error"] = "No has rellenado el formulario correctamente";
        return;
    }

    $client_id = $_SESSION["usuario_id"];
    //$productos = $_REQUEST["productos"];
    $listaProductos = explode(",", $productos);
    $fecha = date('Y/m/d');
    $query = "INSERT INTO $table (client_id, product_id, date_compra)
                          VALUES (?,?,?)";
    try { 
        /*foreach($_SESSION["cesta"] as $k => $product_id){
            $array=array($client_id, $product_id, $fecha);
            $consult = $pdo->prepare($query);
            $a=$consult->execute($array);
            $key = array_search($product_id, $_SESSION["cesta"]);
            unset($_SESSION["cesta"][$key]);
        }*/
        foreach($listaProductos as $product_id){
            $array=array($client_id, $product_id, $fecha);
            $consult = $pdo->prepare($query);
            $a=$consult->execute($array);
            /*$key = array_search($product_id, $_SESSION["cesta"]);
            unset($_SESSION["cesta"][$key]);*/
        }
        

        if (1>$a) echo "<h1> Inserción incorrecta </h1>";
        else echo "<h1> Compra realizada! </h1>";

        $_SESSION["usuario"] = "normal";
    
    } catch (PDOExeption $e) {
        echo ($e->getMessage());
    }
}
?>