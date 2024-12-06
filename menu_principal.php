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
    <title>Menú Principal</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['nombre_usuario']; ?>!</h1>
    <nav>
        <ul>
            <li><a href="buscar_autobus.php">Buscar Autobús</a></li>
            <li><a href="cerrar_sesion.php">Cerrar sesión</a></li>
            <li><a href="registrar_autobus.php">Registrar Autobús</a></li>
        </ul>
    </nav>
    <p>Desde aquí, puedes buscar autobuses y acceder a otras funcionalidades.</p>

    <!-- Formulario para registrar un autobús -->
    <h2>Registrar Autobús</h2>
    
    <form action="registrar_autobus.php" method="get">
        <button type="submit">Registrar Autobús</button>
    </form>
</body>
</html>
