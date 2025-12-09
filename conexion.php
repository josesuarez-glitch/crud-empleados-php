<?php
$host = 'localhost';
$user = 'root';
$pass = ''; 
$db   = 'empresa_crud';  // cambia si tu base se llama diferente

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_errno) {
    die("Error de conexión: " . $mysqli->connect_error);
}

$mysqli->set_charset("utf8mb4");
?>