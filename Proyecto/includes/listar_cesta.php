<?php

function listar_cesta()
{
    echo "<ul>";
    #$comprar = '?action=realizar_compra';
    foreach($_SESSION["cesta"] as $k => $producto){
        if(0<strlen($producto)){
            $eliminar = '?action=desencestar_producto&item_id='.$producto;
            $comprar = '?action=realizar_compra&item_id='.$producto;    
            echo "<li>".$producto . "\t <a href= ".$eliminar .">Eliminar</a> \t <a href=" .$comprar .">Comprar</a>";
            #echo "<li>".$producto . "<form action=".$eliminar."\" method=\"POST\"> <input id=\"eliminar\" type=\"submit\" value=\"Eliminar\"> </input> </form> <form action=".$comprar."\" method=\"POST\"> <input id=\"comprar\" type=\"submit\" value=\"Comprar\"></input> </form>";
        }
        else{
            echo "Cesta vacía";
        }
    }
    #echo "<a href=" .$comprar .">Comprar</a>";
    #echo "<form action=".$comprar."\" method=\"POST\"> <input id=\"comprar\" type=\"submit\" value=\"Comprar\"></input> </form>";
    echo "</ul>";
}
?>