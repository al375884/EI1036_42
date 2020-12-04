<?php

include(dirname(__FILE__)."/includes/conector_BD.php");
include(dirname(__FILE__)."/includes/ejecutarSQL.php");
include(dirname(__FILE__)."/includes/autentificar_usuario.php");

    
global $pdo;

$min = $_REQUEST["min"];
$max = $_REQUEST["max"];

$table = "t_producto";
$query = "SELECT * FROM  $table WHERE price >= $min AND price <= $max;";

header('Content-type: application/json');

$result = $pdo->prepare($query);
$result->execute();
$datos = $result->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($datos);


?>