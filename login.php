<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];

    $sql = "SELECT * FROM usuarios WHERE nombre_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $nombre_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_assoc();

    if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
        header("Location: menu_principal.php");
        exit();
    } else {
        echo "Credenciales incorrectas.";
    }
}
?>

<!-- Formulario de inicio de sesión -->
<form method="post">
    <label for="nombre_usuario">Nombre de usuario:</label>
    <input type="text" id="nombre_usuario" name="nombre_usuario" required><br>
    <label for="contrasena">Contraseña:</label>
    <input type="password" id="contrasena" name="contrasena" required><br>
    <button type="submit">Iniciar sesión</button>
</form>

<!-- Botón para redirigir a la página de registro -->
<p>¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a></p>
