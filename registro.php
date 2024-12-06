<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];
    $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

    // Verificar si el nombre de usuario ya existe
    $sql = "SELECT * FROM usuarios WHERE nombre_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $nombre_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        echo "El nombre de usuario ya existe. Por favor, elige otro.";
    } else {
        $sql = "INSERT INTO usuarios (nombre_usuario, contrasena) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $nombre_usuario, $contrasena_hash);
        if ($stmt->execute()) {
            echo "Usuario registrado exitosamente. <a href='login.php'>Inicia sesión aquí</a>";
        } else {
            echo "Error al registrar el usuario: " . $stmt->error;
        }
    }
}
?>

<!-- Formulario de registro -->
<form method="post">
    <label for="nombre_usuario">Nombre de usuario:</label>
    <input type="text" id="nombre_usuario" name="nombre_usuario" required><br>
    <label for="contrasena">Contraseña:</label>
    <input type="password" id="contrasena" name="contrasena" required><br>
    <button type="submit">Registrarse</button>
</form>
