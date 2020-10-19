<?php
include("./gestionBD.php");

function handler($pdo,$table)
{
    $datos = $_REQUEST;
    if (count($_REQUEST) < 3) {
        $data["error"] = "No has rellenado el formulario correctamente";
        return;
    }$name = $_POST["name"];
    $surname = $_POST["surname"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $zip_code = $_POST["zip_code"];
    $foto_file = $_POST["foto_file"];
    $query = "INSERT INTO     $table (name, surname, address, city, zip_code, foto_file)
                    VALUES (?,?,?,?,?,?)";    
    echo $query;
    try { 
        #$a=array($_REQUEST['userName'], $_REQUEST['email'],$_REQUEST['passwd'] );
        #print_r ($a);
        #$consult = $pdo->prepare($query);
        #$a=$consult->execute(array($_REQUEST['userName'], $_REQUEST['email'],$_REQUEST['passwd']  ));
        $a=array($name, $surname, $address, $city, $zip_code, $foto_file);
        print_r ($a);
        $consult = $pdo->prepare($query);
        $a=$consult->execute(array($name, $surname, $address, $city, $zip_code, $foto_file));
        if (1>$a)echo "InCorrecto";
    
    } catch (PDOExeption $e) {
        echo ($e->getMessage());
    }
}

$table = "a_cliente";
var_dump($_POST);
handler( $pdo,$table);
?>