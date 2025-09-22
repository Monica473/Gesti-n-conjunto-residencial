<?php
// Configuración de la conexión a la base de datos MySQL

$host = 'localhost';
$puerto = '3307';
$usuario = 'root';
$contraseña = 'Flakita_473_03_01_2006';
$base_datos = 'gestion_conjunto';

define('BASE_URL', 'http://localhost/Gestion-de-conjunto-residencial');

// Crear conexión
$conn = new mysqli($host, $usuario, $contraseña, $base_datos, $puerto);

// Verificar conexión
if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}


?>
