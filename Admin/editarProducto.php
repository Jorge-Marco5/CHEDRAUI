    <?php
include('conexion.php');
session_start();

        if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_producto = $_GET['id'];

    // Conexión a la base de datos y otras configuraciones necesarias

    // Consultar la base de datos para obtener los detalles del producto con el ID proporcionado
    $query = $connection->prepare("SELECT * FROM productos WHERE id = :id");
    $query->bindParam(':id', $id_producto);
    $query->execute();
    $producto = $query->fetch(PDO::FETCH_ASSOC);

    if ($producto) { 
        // Mostrar un formulario prellenado con los detalles del producto para que el usuario pueda editarlos
        echo "<form action='actualizar_producto.php' method='post'>";
        echo "<input type='hidden' name='id_producto' value='" . $producto['id'] . "'>";
        echo "Nombre: <input type='text' name='nombre' value='" . $producto['nombre'] . "'><br>";
        echo "Descripción: <input type='text' name='descripcion' value='" . $producto['descripcion'] . "'><br>";
        echo "Precio: <input type='text' name='precio' value='" . $producto['precio'] . "'><br>";
        echo "<input type='submit' value='Guardar cambios'>";
        echo "</form>";
    } else {
        echo "Producto no encontrado.";
    }
} else {
    echo "ID de producto no válido.";
}
?>
