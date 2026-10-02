<?php

$config = parse_ini_file(
    __DIR__ . '/../config/config.ini',
    true
);

$host = $config['database']['host'];
$dbname = $config['database']['dbname'];
$user = $config['database']['user'];
$password = $config['database']['password'];
$charset = $config['database']['charset'];

try {

    $conexion = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=$charset",
        $user,
        $password
    );

    $conexion->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

} catch (PDOException $e) {

    die(
        "Error de conexión: " .
        $e->getMessage()
    );
}
?>