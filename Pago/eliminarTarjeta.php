<?php
require_once('../login_Signup/conexion.php');
session_start();

// Verificar si se recibió un ID de ubicación válido
if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id_tarjeta = intval($_GET['id']);

    // Conexión a la base de datos y otras configuraciones necesarias
    // Consultar la base de datos para eliminar el producto con el ID proporcionado
    $query = $connection->prepare("DELETE FROM tarjetasusuario WHERE id = :id");
    $query->bindParam(':id', $id_tarjeta, PDO::PARAM_INT);
    $query->execute();

    // Redirigir después de la eliminación
    header('Location: aggTarjetas.php');
    exit(); // Asegúrate de salir después de la redirección
} else {
    echo "ID de ubicación no válido.";
}
?>
