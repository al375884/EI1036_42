<?php

// no sabemos si hay que pasar pdo a la funcion como en la P1

function registrar_usuario($table)
{
    global $pdo;

    $datos = $_REQUEST;
    if (count($_REQUEST) < 3) {
        $data["error"] = "No has rellenado el formulario correctamente";
        return;
    }
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $role = $_POST["role"];
    $passwd = $_POST["passwd"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $zip_code = $_POST["zip_code"];
    $foto_file = $_POST["foto_file"];
    $query = "INSERT INTO $table (name, surname, role, passwd, address, city, zip_code, foto_file)
                          VALUES (?,?,?,?,?,?,?,?)";
    try { 
        $a=array($name, $surname, $role, $passwd, $address, $city, $zip_code, $foto_file);
        $consult = $pdo->prepare($query);
        $a=$consult->execute(array($name, $surname, $role, $passwd, $address, $city, $zip_code, $foto_file));

        if (1>$a) echo "<h1> Inserción incorrecta </h1>";
        else echo "<h1> Usuario registrado! </h1>";

        $_SESSION["usuario"] = "normal";
    
    } catch (PDOExeption $e) {
        echo ($e->getMessage());
    }
}
?>