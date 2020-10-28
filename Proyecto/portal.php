<?php
    //view_form.php

/**
 * * Descripción: Ejemplo de proyecto
 * *
 * * 
 * *
 * * @author  Rafael Berlanga
 * * @copyright 2020 Rafa B.
 * * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * * @version 1

 * */

session_start();

include(dirname(__FILE__)."/includes/ejecutarSQL.php");
include(dirname(__FILE__)."/partials/header.php");
include(dirname(__FILE__)."/partials/menu.php");

include(dirname(__FILE__)."/includes/conector_BD.php");
include(dirname(__FILE__)."/includes/table2html.php");
include(dirname(__FILE__)."/includes/listar_cesta.php");

include(dirname(__FILE__)."/includes/registrar_usuario.php");
include(dirname(__FILE__)."/includes/registrar_producto.php");
include(dirname(__FILE__)."/includes/encestar_producto.php");
include(dirname(__FILE__)."/includes/desencestar_producto.php");
include(dirname(__FILE__)."/includes/autentificar_usuario.php");


if (isset($_REQUEST['action'])) $action = $_REQUEST["action"];
else $action = "home";

$central = "Partials/centro.php";

switch ($action) {
    case "home":
        $central = "/partials/centro.php";
        break;
    case "login": 
        $central = "/partials/login.php"; //formulario login 
        break;
    case "do_login":
        $central = autentificar_usuario(); //fijar $_SESSION["usuario"]
        break;
    case "registrar_usuario":
        $central = "/partials/registro_usuario.php"; //formulario usuarios
        break;
    case "insertar_usuario":
        //$central = registrar_usuario("usuarios"); //tabla usuarios
        $table = "t_cliente";
        $central = registrar_usuario($table); //tabla usuarios
        break;
    case "listar_productos":
        //$central = table2html("productos"); //tabla productos
        $table = "t_producto";
        $central = table2html($table); //tabla productos
        break;
    case "registrar_producto":
        $central = "/partials/registro_producto.php"; //formulario producto
        break;
    case "insertar_producto":
        //$central = registrar_producto("productos"); //tabla productos
        $table = "t_producto";
        $central = registrar_producto($table); //tabla productos
        break;
    // las tres opciones de cesta solo dependen de $_SESSION
    case "ver_cesta":
        #$central = "<p>Todavia no puedo ver la cesta</p>"; //cesta en $_SESSION["cesta"]
        $table = "t_compra";
        $central = listar_cesta($table);
        break;
    case "encestar":
        #$central = "<p>Todavía no puedo añadir a la cesta</p>"; //tabla compras
        $table = "t_compra";
        $cliente = "1";
        $producto = "2";
        $central = encestar_producto($table, $cliente, $producto);

        $table = "t_producto";
        $central = table2html($table);
        break;
    case "desencestar_producto":
        $table = "t_compra";
        $item_id = "4";
        $central = desencestar_producto($table, $item_id);

        $table = "t_compra";
        $central = listar_cesta($table);
        break;

    //No hacer este case
    case "realizar_compra":
        $central = "<p>Todavía no puedo añadir a la cesta</p>"; //cesta en $_SESSION["cesta"]
        break;
    default:
        $data["error"] = "Accion No permitida";
        $central = "/partials/centro.php";
}

if ($central <> "") include(dirname(__FILE__).$central);

include(dirname(__FILE__)."/partials/footer.php");
?>