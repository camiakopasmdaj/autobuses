<?php
// Incluir la conexión a la base de datos
include 'conexion.php';

// Obtener el número de autobús desde la URL
$numero_autobus = isset($_GET['numero_autobus']) ? $_GET['numero_autobus'] : null;

// Verificar si se ha proporcionado el número de autobús
if ($numero_autobus) {
    // Preparar la consulta para obtener la latitud y longitud del autobús
    $sql = "SELECT latitud, longitud FROM ubicaciones_autobus WHERE numero_autobus = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $numero_autobus);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $ubicacion = $resultado->fetch_assoc();

    // Verificar si se encontró la ubicación
    if ($ubicacion) {
        // Devolver la latitud y longitud en formato JSON
        echo json_encode(['latitud' => $ubicacion['latitud'], 'longitud' => $ubicacion['longitud']]);
    } else {
        // Devolver un error si no se encuentra la ubicación
        echo json_encode(['error' => 'Ubicación no encontrada']);
    }
} else {
    // Devolver un error si no se ha proporcionado el número de autobús
    echo json_encode(['error' => 'Número de autobús no proporcionado']);
}
?>
