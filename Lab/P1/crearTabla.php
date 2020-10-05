<?php

include(dirname(__FILE__)."/../../../pdo_postgres.php");

function crearTabla($table){
			$query="CREATE TABLE IF NOT EXISTS  $table (client_id SERIAL PRIMARY KEY, name CHAR(50) NOT NULL, surname CHAR(50) NOT NULL, address CHAR(50),city CHAR(50),zip_code CHAR(5),foto_file VARCHAR(25) );";
			#$query="CREATE TABLE  $table (client_id SERIAL PRIMARY KEY, name CHAR(50) NOT NULL, surname CHAR(50) NOT NULL, address CHAR(50),city CHAR(50),zip_code CHAR(5),foto_file VARCHAR(25) );";
			  $a=ejecutarSQL($query,[]);
			  if (0>$a) {echo "InCorrecto1";}
			  $query = "INSERT INTO    $table (name,surname) VALUES (?,?);";
			  $a=ejecutarSQL($query,['user4','pp']);
			  if (0>$a) {echo "InCorrecto1";}
			  $query = "SELECT     * FROM       $table ;";
			  $a=ejecutarSQL($query,NULL);
			  if (0>$a) {echo "InCorrecto1";}
			  var_dump($a);
}

#print_r(PDO::getAvailableDrivers()); //Permite ver si tenemos las librerias para la BD.
$table="a_cliente";
crearTabla($table);

?>