<?php
$servername = "localhost";
$username = "root"; // Cambia esto si tu usuario de la base de datos es diferente
$password = ""; // Cambia esto si tu contraseña es diferente
$dbname = "mapa_autobuses"; // Nombre de la base de datos

// Crea la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
