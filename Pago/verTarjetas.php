<?php
// Incluir el archivo de configuración de la conexión a la base de datos
include('../login_Signup/conexion.php');
session_start();

if (isset($_SESSION['idUsuario'])) {
    $idUsuario = $_SESSION['idUsuario'];
    echo "ID del usuario: " . $idUsuario;
} else {
    echo "ID del usuario no está definido en la sesión.";
}

// Datos de ejemplo
$token = $_POST['numero_tarjeta']; // Token proporcionado por el proveedor de pagos
$ultimos_digitos = "1234"; // Últimos cuatro dígitos de la tarjeta
$nombre_titular = $_POST['nombre_titular']; // Nombre del titular de la tarjeta
$fecha_expiracion = $_POST['fecha_expiracion']; // Fecha de expiración de la tarjeta (formato MM/YY)

try {
    // Consulta SQL para insertar datos en la tabla 'ubicacion'
    $sql = "INSERT INTO tarjetasusuario (usuario_id, token, ultimos_digitos, nombre_titular, fecha_expiracion) VALUES (?, ?, ?, ?, ?)";
    $statement = $connection->prepare($sql);
    $statement->execute([$idUsuario, $token, $ultimos_digitos, $nombre_titular, $fecha_expiracion]);
    
    echo "Datos guardados correctamente.";
    header('Location: aggTarjetas.php?>');

} catch (PDOException $e) {
    echo "Error al guardar los datos: " . $e->getMessage();
}

?>
