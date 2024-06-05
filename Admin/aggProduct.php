<?php
require_once('../login_Signup/conexion.php');
session_start();

// Recuperar los valores del formulario

$nameProducto = $_POST['nameProducto'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$urlImagen = $_POST['urlImagen'];

try {
    // Consulta SQL para insertar datos en la tabla 'ubicacion'
    $sql = "INSERT INTO productos (nombre, descripcion, precio, imagen) VALUES (?, ?, ?, ?)";
    $statement = $connection->prepare($sql);
    $statement->execute([$nameProducto, $descripcion, $precio, $urlImagen]);
    
    echo "Datos guardados correctamente.";
    header('Location:adminProductos.php');

} catch (PDOException $e) {
    echo "Error al guardar los datos: " . $e->getMessage();
}
?>
