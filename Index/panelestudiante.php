<?php
session_start();

$conexion = new mysqli("localhost", "root", "", "estudiante");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$identificacion = $_POST['identificacion'];
$contrasena = $_POST['contraseña'];

$sql = "SELECT id FROM usuarios WHERE identificacion = ? AND contraseña = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ss", $identificacion, $contrasena);
$stmt->execute();
$stmt->bind_result($id);

if ($stmt->fetch()) {
    $_SESSION['usuario_id'] = $id;
    header("Location: panel.php");
} else {
    echo "Identificación o contraseña incorrecta.";
}

$stmt->close();
$conexion->close();
?>
