<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mapa de Autobuses</title>
    <!-- Cargar la hoja de estilos de Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- Cargar la librería de Leaflet -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <style>
        #mapa {
            width: 100%;
            height: 500px;
        }
    </style>
</head>
<body>
    <h2>Mapa de Autobuses en Tiempo Real</h2>
    <div id="mapa"></div>

    <script>
        // Crear el mapa centrado en las coordenadas de Popayán
        var mapa = L.map('mapa').setView([2.4474, -76.6013], 14);

        // Cargar los mapas de OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapa);

        // Ejemplo de marcador de autobús, puedes agregar más dinámicamente desde la base de datos
        var marker = L.marker([2.4500, -76.6030]).addTo(mapa);
        marker.bindPopup('Autobús 123').openPopup();
    </script>
</body>
</html>
