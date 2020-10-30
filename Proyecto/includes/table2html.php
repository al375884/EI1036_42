<?php

function table2html($table)
{
    global $pdo;

    $query = "SELECT * FROM  $table;";
    
    $rows = $pdo->query($query)->fetchAll(\PDO::FETCH_ASSOC);

    if (is_array($rows)) {/* Creamos un listado como una tabla HTML*/
        print '<table><thead>';
        foreach($rows[0] as $key => $value) {
            echo "<th>", $key,"</th>";
        }
        echo "<th>", "", "</th>";
        print "</thead>";
        foreach ($rows as $row) {
            print "<tr>";
            $contador = 0;
            foreach ($row as $key => $val) {
                $contador++;
                if($contador == count($row)){
                    echo "<td>", "<img src=".$val." id=\"imagen_prod\" alt=\"imagen_prod\" />", "</td>";
                }
                else{
                    echo "<td>", $val, "</td>";
                }
                
            }
            echo "<th>", "<form action=\"?action=encestar&client_id=".$_SESSION["usuario_id"]."&product_id=".array_values($row)[0]."\" method=\"POST\"> <input id=\"comprar\" type=\"submit\" value=\"Añadir a la cesta\"></input> </form>", "</th>";
            // ".$_SESSION['usuario_id']."
            print "</tr>";
        }
        print "</table>";
    } 
    else
        print "<h1> No hay resultados </h1>"; 
}

?>