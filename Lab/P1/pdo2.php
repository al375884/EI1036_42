<?php
        header('Content-Type: application/json');

/** The name of the database */
define('DB_NAME', 'ei1036_42');

/** MySQL database username */
define('DB_USER', '*****');

/** MySQL database password */
define('DB_PASSWORD', '*****');

/** MySQL hostname */
define('DB_HOST', 'db-aules.uji.es' );

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

$pdo = new PDO("pgsql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);

function ejecutarSQL($pdo,$table,$query,$valor) {
        var_dump($valor);
        try{
            $consult = $pdo->prepare($query);
            $a=$consult->execute($valor);
        }
        catch (PDOException $e) {
            echo "Failed to get DB handle: " . $e->getMessage() . "\n";
            exit;
        }
        return $a;

}
$table="a_cliente";

$query="CREATE TABLE IF NOT EXISTS  $table (client_id SERIAL PRIMARY KEY, name CHAR(50) NOT NULL, surname CHAR(50) NOT NULL, address CHAR(50),city CHAR(50),zip_code CHAR(5),foto_file VARCHAR(25) );";

echo $query;

$a=ejecutarSQL($pdo,$table,$query,[]);
$query = "INSERT INTO $table (name,surname) VALUES (?,?)";
$a=ejecutarSQL($pdo,$table,$query,['user4','pp']);

if (1>$a) {echo "InCorrecto1";}

var_dump($a);
$query = "SELECT     * FROM       $table ";
$a=ejecutarSQL($pdo,$table,$query,NULL);

var_dump($a);


?>
