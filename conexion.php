<?php
$host = "single-4720.banahosting.com";
$user = "ofcjwtiz_00042524";
$pass = "(-K(vbu[mmsj";
$dbname = "ofcjwtiz_00042524";

try {
    $conexion = new mysqli($host, $user, $pass, $dbname);
    
    if ($conexion->connect_error) {
        throw new Exception("Error de conexión: " . $conexion->connect_error);
    }
    
    echo "¡Conexión exitosa";
    
} catch (Exception $e) {
    
    die("Error de conexión a la base de datos");
}
?>