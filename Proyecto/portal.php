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
include(dirname(__FILE__)."/includes/listar_compras.php");

include(dirname(__FILE__)."/includes/registrar_usuario.php");
include(dirname(__FILE__)."/includes/registrar_producto.php");
include(dirname(__FILE__)."/includes/realizar_compra.php");

include(dirname(__FILE__)."/includes/autentificar_usuario.php");
include(dirname(__FILE__)."/includes/upload_imagen.php");




if (isset($_REQUEST['action'])) $action = $_REQUEST["action"];
else $action = "home";

$central = "Partials/centro.php";
echo "<script> listarCesta(); </script>";

switch ($action) {
    case "home":
        $central = "/partials/centro.php";
        break;
    case "login": 
        $central = "/partials/login.php"; //formulario login     
        break;
    case "do_login":
        $central = autentificar_usuario(); //fijar $_SESSION["usuario"]
        $central = "/partials/centro.php"; 
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
        //$table = "t_producto";
        //$central = table2html($table); //tabla productos
        //echo "<div id=\"visor\" class=\"visor\">", "</div>";
        $central = "/partials/visorProductos.php";
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
        $central = listar_cesta();
        break;
    case "encestar": //add
        #$central = "<p>Todavía no puedo añadir a la cesta</p>"; //tabla compras
        $cliente = $_REQUEST["client_id"];
        $producto = $_REQUEST["product_id"];
        echo "<script> anyadirProducto('". $producto ."'); guardarCesta(); </script>"; 
        //array_push($_SESSION["cesta"], $producto);
        
        $table = "t_producto";
        $central = table2html($table);
        break;
    case "desencestar_producto": //delete
        $item_id = $_REQUEST["item_id"];
        $key = array_search($item_id, $_SESSION["cesta"]);
        unset($_SESSION["cesta"][$key]);
        $central = listar_cesta(); 
        break;
    case "realizar_compra":
        $table = "t_compra";
        $productos = $_GET["productos"];
        //$productos = "<script> realizarCompra(); </script>";
        //$central = listar_compras($table); 
        $central = realizar_compra($table, $productos); //cesta en $_SESSION["cesta"]
        break;
    case "listar_compras":
        $table = "t_compra";
        $central = listar_compras($table);
        break;
    case "upload":
        $central = upload_imagen();
        $central = "/partials/registro_producto.php";
        break;
    case "movil":
        $central = "/movil.php";
        break;
    default:
        $data["error"] = "Accion No permitida";
        $central = "/partials/centro.php";
}

if ($central <> "") include(dirname(__FILE__).$central);

include(dirname(__FILE__)."/partials/footer.php");
?>