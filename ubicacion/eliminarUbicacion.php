<?php
require_once('../login_Signup/conexion.php');
session_start();

// Verificar si se recibió un ID de ubicación válido
if (isset($_GET['idUbicacion']) && !empty($_GET['idUbicacion']) && is_numeric($_GET['idUbicacion'])) {
    $id_ubicacion = intval($_GET['idUbicacion']);

    // Conexión a la base de datos y otras configuraciones necesarias
    // Consultar la base de datos para eliminar el producto con el ID proporcionado
    $query = $connection->prepare("DELETE FROM ubicaciones WHERE idUbicacion = :id");
    $query->bindParam(':id', $id_ubicacion, PDO::PARAM_INT);
    $query->execute();

    // Redirigir después de la eliminación
    header('Location: ubicacion.php');
    exit(); // Asegúrate de salir después de la redirección
} else {
    echo "ID de ubicación no válido.";
}
?>
