<?php
include 'conexion.php'; // Archivo de conexión a la base de datos

// Obtener datos enviados desde el cliente
$data = json_decode(file_get_contents('php://input'), true);
$numero_autobus = $data['numero_autobus'];
$latitud = $data['latitud'];
$longitud = $data['longitud'];

// Actualizar la ubicación en la base de datos
$sql = "UPDATE autobuses SET latitud = ?, longitud = ? WHERE numero_autobus = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('dds', $latitud, $longitud, $numero_autobus);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Ubicación actualizada']);
} else {
    echo json_encode(['status' => 'error', 'message' => $stmt->error]);
}
?>
