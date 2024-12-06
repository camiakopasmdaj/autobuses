<?php
session_start();
include 'conexion.php';

// Verificar si se ha enviado el número de autobús a buscar
$numero_autobus = isset($_GET['numero_autobus']) ? $_GET['numero_autobus'] : null;

// Eliminar la línea de depuración de var_dump($_GET) aquí

if ($numero_autobus) {
    // Preparar la consulta para obtener la ubicación inicial del autobús
    $sql = "SELECT latitud, longitud FROM autobuses WHERE numero_autobus = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $numero_autobus);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $autobus = $resultado->fetch_assoc();

    // Verificar si se encontró el autobús
    if ($autobus) {
        $latitud = $autobus['latitud'];
        $longitud = $autobus['longitud'];
        $error = '';
    } else {
        $latitud = null;
        $longitud = null;
        $error = "Autobús no encontrado.";
    }
} else {
    $error = "Número de autobús no proporcionado.";
    $latitud = null;
    $longitud = null;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ubicación en Tiempo Real del Autobús</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>
<body>
    <h1>Ubicación en Tiempo Real del Autobús</h1>
    <div id="mapa" style="width: 100%; height: 500px;"></div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        let mapa;
        let marcador;

        function initMap() {
            // Crear el mapa centrado en la ubicación inicial del autobús
            const lat = <?= $latitud !== null ? $latitud : '2.4474' ?>;
            const lon = <?= $longitud !== null ? $longitud : '-76.6013' ?>;
            mapa = L.map('mapa').setView([lat, lon], 14);

            // Cargar el mapa de OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(mapa);

            // Agregar un marcador en la ubicación inicial si existe
            if (<?= $latitud !== null ? 'true' : 'false' ?>) {
                marcador = L.marker([lat, lon]).addTo(mapa)
                    .bindPopup("Autobús <?= htmlspecialchars($numero_autobus) ?>")
                    .openPopup();
            } else {
                // Mostrar un mensaje de error si no hay latitud y longitud
                alert("<?= htmlspecialchars($error) ?>");
            }

            // Actualizar la ubicación en tiempo real cada 5 segundos
            setInterval(actualizarUbicacion, 1000);
        }

        function actualizarUbicacion() {
            const numeroAutobus = <?= json_encode($numero_autobus) ?>;
            if (numeroAutobus) {
                fetch('obtener_ubicacion.php?numero_autobus=' + encodeURIComponent(numeroAutobus))
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.latitud && data.longitud) {
                            const nuevaPosicion = [data.latitud, data.longitud];
                            marcador.setLatLng(nuevaPosicion);
                            mapa.panTo(nuevaPosicion);
                        } else {
                            console.error('Datos de ubicación inválidos o incompletos:', data);
                        }
                    })
                    .catch(error => console.error('Error al obtener la ubicación:', error));
            } else {
                console.error('Número de autobús no proporcionado al actualizar la ubicación.');
            }
        }

        // Inicializar el mapa al cargar la página
        window.onload = initMap;
    </script>
</body>
</html>
