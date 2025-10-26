<?php
$host = "localhost:3307";
$user = "root";
$pass = "";
$dbname = "maka_proyectoweb";

try {
    $conexion = new mysqli($host, $user, $pass, $dbname);
    
    if ($conexion->connect_error) {
        throw new Exception("Error de conexión: " . $conexion->connect_error);
    }
    
    
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>