<?php
require_once('../login_Signup/conexion.php');
session_start();

// Verificar si se recibió un ID de producto válido
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_producto = $_GET['id'];
    // Conexión a la base de datos y otras configuraciones necesarias
    // Consultar la base de datos para eliminar el producto con el ID proporcionado
    $query = $connection->prepare("DELETE FROM productos WHERE id = :id");
    $query->bindParam(':id', $id_producto);
    $query->execute();
    $producto = $query->fetch(PDO::FETCH_ASSOC);

    if ($producto) {
        header('Location:adminProductos.php');
    } else {
        header('Location:adminProductos.php');
    }
} else {
    echo "ID de producto no válido.";
}
?>