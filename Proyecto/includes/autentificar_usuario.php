<?php

function autentificar_usuario()
{
    global $pdo;

    $nombre = $_REQUEST["name"];
    $passwd = $_REQUEST["passwd"];
    $table = "t_cliente";
    $query = "SELECT * FROM $table WHERE name = '$nombre' and passwd = '$passwd'";
    $rows = $pdo->query($query)->fetchAll(\PDO::FETCH_ASSOC);
    if(is_array($rows)){
        $usuario = array_values($rows)[0];
        $_SESSION["usuario"] = array_values($usuario)[3]; //role
        $_SESSION["usuario_id"] = array_values($usuario)[0];
        $_SESSION["cesta"] = array();
    }
    else{
        print "Usuario o contraseña incorrecta";
    }


    /*
    buscar usuario y passwd en DB y comparar con $_POST
    según el resultado fijar la variable de sesion of mostar error

    $_SESSION["usuario"] = role
    */
}


?>