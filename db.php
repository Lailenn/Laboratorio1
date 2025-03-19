<?php
//  (Conexión a la base de datos)
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'agenda_de_contacto';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>