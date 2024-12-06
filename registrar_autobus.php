<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero_autobus = $_POST['numero_autobus'];
    $ruta = $_POST['ruta'];
    $hora_salida = $_POST['hora_salida'];
    $hora_llegada = $_POST['hora_llegada'];
    $latitud_inicial = $_POST['latitud'];
    $longitud_inicial = $_POST['longitud'];

    $sql = "INSERT INTO autobuses (numero_autobus, ruta, hora_salida, hora_llegada, latitud, longitud) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssdd', $numero_autobus, $ruta, $hora_salida, $hora_llegada, $latitud_inicial, $longitud_inicial);

    if ($stmt->execute()) {
        echo "Autobús registrado exitosamente.";
    } else {
        echo "Error al registrar el autobús: " . $stmt->error;
    }
}
?>
