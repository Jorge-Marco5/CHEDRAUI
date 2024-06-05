<?php
include('../login_Signup/conexion.php');
session_start();

if (isset($_SESSION['idUsuario'])) {
    $idUsuario = $_SESSION['idUsuario'];
    echo "ID del usuario: " . $idUsuario;
} else {
    echo "ID del usuario no está definido en la sesión.";
}

// Recopilar datos del usuario que realizó el pedido
$queryUsuario = $connection->prepare("SELECT nombre, direccion FROM Usuarios WHERE id = :usuario_id");
$queryUsuario->bindParam(":usuario_id", $idUsuario);
$queryUsuario->execute();
$usuario = $queryUsuario->fetch(PDO::FETCH_ASSOC);


$query = "SELECT * FROM ubicaciones WHERE idUsuario = :idUsuario";
$statement = $connection->prepare($query);
$statement->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
$statement->execute();

// Verificar si se encontraron ubicaciones para el usuario
if ($statement->rowCount() > 0) {
    // Obtener los datos de la ubicación como un arreglo asociativo
    $ubicacion = $statement->fetch(PDO::FETCH_ASSOC);

    // Guardar los datos en variables individuales
    $nombreUsuario = $ubicacion['nombre_usuario'];
    $CP = $ubicacion['CP'];
    $calle = $ubicacion['calle'];
    $colonia = $ubicacion['colonia'];
    $numTelefono = $ubicacion['num_telefono'];
    $instruccionesEntrega = $ubicacion['instrucciones_entrega'];

    // Ahora puedes usar estas variables como necesites
    echo "Nombre de usuario: $nombreUsuario<br>";
    echo "Código Postal: $CP<br>";
    echo "Calle: $calle<br>";
    echo "Colonia: $colonia<br>";
    echo "Número de teléfono: $numTelefono<br>";
    echo "Instrucciones de entrega: $instruccionesEntrega<br>";
} else {
    // Si no se encontraron ubicaciones para el usuario
    echo "No se encontraron ubicaciones para este usuario.";
}

// Insertar un nuevo pedido en la tabla Pedidos con los datos recopilados
$queryInsertarPedido = $connection->prepare("INSERT INTO Pedidos (usuario_id, fecha_pedido, estado_pedido, total, nombre_usuario, direccion_usuario) VALUES (:usuario_id, CURRENT_TIMESTAMP, 'pendiente', :total, :nombre_usuario, :direccion_usuario)");
$queryInsertarPedido->bindParam(":usuario_id", $idUsuario);
$queryInsertarPedido->bindParam(":total", $total);
$queryInsertarPedido->bindParam(":nombre_usuario", $usuario['nombre']);
$queryInsertarPedido->bindParam(":direccion_usuario", $usuario['direccion']);
$queryInsertarPedido->execute();
?>