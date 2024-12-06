<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscar Autobús</title>
</head>
<body>
    <h1>Buscar Autobús</h1>
   <form action="resultado_busqueda.php" method="get">
    <input type="text" name="numero_autobus" placeholder="Número de autobús" required>
    <button type="submit">Buscar</button>
   </form>

</body>
</html>
