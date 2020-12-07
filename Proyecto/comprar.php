<?php
include(dirname(__FILE__)."/includes/conector_BD.php");
include(dirname(__FILE__)."/includes/ejecutarSQL.php");
include(dirname(__FILE__)."/includes/autentificar_usuario.php");

global $pdo;

$table = "t_compra";
//$client_id = $_SESSION["usuario_id"];
$client_id = "1";
$productos = $_REQUEST["productos"];
$listaProductos = explode(",", $productos);
$listaProductosLlena = true;
foreach($listaProductos as $product_id){
    if($product_id == ""){
        $listaProductosLlena = false;
        break;
    }
}

$fecha = date('Y/m/d');
$query = "INSERT INTO $table (client_id, product_id, date_compra)
                        VALUES (?,?,?)";

header('Content-type: application/json');

if ($listaProductosLlena){
    try { 
        foreach($listaProductos as $product_id){
            $array=array($client_id, $product_id, $fecha);
            $consult = $pdo->prepare($query);
            $a=$consult->execute($array);
            /*$key = array_search($product_id, $_SESSION["cesta"]);
            unset($_SESSION["cesta"][$key]);*/
        }
        

        if (1>$a){
            $resultado = array( "resultado" => "KO");
        } 
        else{
            $resultado = array( "resultado" => "OK");
        } 

        echo json_encode($resultado);

        $_SESSION["usuario"] = "normal";

    } catch (PDOExeption $e) {
        echo ($e->getMessage());
    }
}
else{
    $resultado = array( "resultado" => "KO");
    echo json_encode($resultado);
}


?>