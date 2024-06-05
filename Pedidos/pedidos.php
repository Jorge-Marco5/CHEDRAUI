<?php
//SISTEMA PARA SOLICITAR UN PEDIDO.

$total = 0; // Inicializar el total
$precioTotalProducto = 0;
$nombreProductos = ''; // Inicializar la variable para almacenar los nombres de los productos

include('../login_Signup/conexion.php');

     include_once  '../header.php';

// Recuperar los valores del formulario

if (isset($_SESSION['idUsuario'])) {
    $idUsuario = $_SESSION['idUsuario'];
    echo "ID del usuario: " . $idUsuario;

} else {
    echo "ID del usuario no está definido en la sesión.";
}
$idUsuario = $_SESSION['idUsuario'];
$precioTotal = 0;

$query = $connection->prepare("SELECT * FROM ubicaciones WHERE idUsuario = :idUsuario");
$query->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
$query->execute();
$ubicaciones = $query->fetchAll(PDO::FETCH_ASSOC);

// Verificar si se encontraron ubicaciones para el usuario
if ($ubicaciones) {
    // Supongamos que solo nos interesa la primera ubicación encontrada
    $primeraUbicacion = $ubicaciones[0];

    // Extraer los datos de la ubicación
    $nombreUsuario = $_SESSION['username'];
    $CP = $primeraUbicacion['C.P.'];
    $calle = $primeraUbicacion['calle'];
    $colonia = $primeraUbicacion['colonia'];
    $numTelefono = $primeraUbicacion['numTelefono'];
    $instruccionesEntrega = $primeraUbicacion['instruccionesEntrega'];

    // Crear la variable 'direccion' con los datos obtenidos
    $direccion = "Recibe: $nombreUsuario, en calle: $calle, colonia: $colonia, CP: $CP, Teléfono: $numTelefono. Instrucciones de entrega: $instruccionesEntrega";
} else {
    // Si no se encontraron ubicaciones para el usuario, asignar un valor predeterminado a la variable 'direccion'
    $direccion="No se encontraron ubicaciones";
    header('Location:../ubicacion/validarUbicacion.php');
    exit; // Asegúrate de usar exit() después de header() para detener la ejecución del script
}

//OBTENER LOS DETALLES DE LOS PRODUCTOS QUE SE AGREGARON A LLA TABLA DE "detallespedido".

//echo "DETALLES DEL PEDIDO:";
echo'<br>';
$query = "SELECT * FROM detallespedido WHERE usuario_id = :usuario_id";
$statement = $connection->prepare($query);
$statement->bindParam(':usuario_id', $idUsuario);
$statement->execute();

if ($statement->rowCount() > 0) {
    // El usuario tiene productos agregados, mostrar la lista de productos
   // Consultar los productos del usuario actual desde la base de datos
   $query = $connection->prepare("SELECT * FROM detallespedido WHERE usuario_id = :idUsuario");
   $query->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
   $query->execute();
   $pedidos = $query->fetchAll(PDO::FETCH_ASSOC);

   ?>

   <table>
       <thead>
           <tr>
               <th>ID</th>
               <th>Producto</th>
               <th>Precio</th>
           </tr>
       </thead>

   <?php

   // OBTENER LOS DETALLES DE LOS PEDIDOS DE LA BD "productos" COMO SON EL ID, NOMBRE Y EL PRECIO.
   foreach ($pedidos as $pedido) {
       // Obtener el nombre y el precio del producto basado en el ID del producto almacenado en detallespedido
       $queryProducto = $connection->prepare("SELECT id, nombre, precio FROM productos WHERE id = :idProducto");
       $queryProducto->bindParam(":idProducto", $pedido['producto_id'], PDO::PARAM_INT);
       $queryProducto->execute();
       $producto = $queryProducto->fetch(PDO::FETCH_ASSOC);
       // Mostrar los detalles del producto
       $nombreProductos .= $producto['nombre'] . ', ';

       ?>
<tr>
        <td class="textLocation"><?php echo $producto['id']; ?> </td>
        <td class="textLocation"><?php echo $producto['nombre'] ?> (<?php echo $pedido['cantidad'];?>) </td>
        <td class="textLocation">$<?php echo $producto['precio']; ?> </td>

</tr>

<?php
    $precioTotalProducto = $precioTotalProducto + ($producto['precio'] * $pedido['cantidad']);

}

// CONCATENAR LOS NOMBRES DE LOS PRODUCTOS Y GUARDARLOS EN LA VARIABLE "$nombreProductos".
$nombreProductos = rtrim($nombreProductos, ', ');

    $total += $precioTotalProducto;
?>
<td class="textLocation">Total </td>
<td></td>
<td class="textLocation">$<?php echo number_format($total, 2) ?> </td>
</table>
<?php


} else {?>
    <!--SI NO HAY NINGUN PRODUCTO EN EL CARRITO NOS MANDA EL MENSAJE DE QUE NO EXISTE NINGUN PRODUCTO AGREGADO
    <h1 class="title">No tienes ningun producto en tu carta</h1>-->

<?php }


/*// MOSTRAMOS LAS VARIAVLES PARA VERIFICAR SI ALMACENAN LOS VALORES CORRECTOS.*/
echo'<br>';
echo 'DIRECCION DE ENTREGA:';
echo'<br>';
echo $direccion."\n";
echo'<br>';
echo'<br>';
date_default_timezone_set('America/Mexico_City');
$fecha_y_hora = date("Y-m-d H:i:s");
echo $fecha_y_hora;

/*INSERTAR LOS DATOS EN LA BD QUE MUESTRA LOS DETALLES DEL PEDIDO */
try {
    // Preparar la consulta SQL para insertar el nuevo pedido
    $query = "INSERT INTO Pedidos (usuario_id, fecha_pedido, estado_pedido, total, direccion, detalles) VALUES (:usuario_id, :fecha_pedido, :estado_pedido, :total, :direccion, :detalles)";
    $statement = $connection->prepare($query);
    $statement->bindParam(':usuario_id', $idUsuario, PDO::PARAM_INT);//usuario_id
    $statement->bindParam(':fecha_pedido', $fecha_y_hora, PDO::PARAM_STR);//fecha_Pedido
    $statement->bindParam(':estado_pedido', $estado, PDO::PARAM_STR);//estado_pedido
    $statement->bindParam(':detalles', $nombreProductos, PDO::PARAM_STR);//detalles
    $statement->bindParam(':total', $total, PDO::PARAM_STR);//total
    $statement->bindParam(':direccion', $direccion, PDO::PARAM_STR);//direccion
    
    // Ejecutar la consulta y verificar si se insertaron los datos
    if ($statement->execute()) {
        //echo "Pedido agregado correctamente.";
    } else {
        //echo "Error al agregar el pedido.";
    }
} catch (PDOException $e) {
    echo'<br>';
    echo'<br>';
    echo "Error: " . $e->getMessage();
}

/*ULTIMA PARTE PARA ELIMINAR LOS PRODUCTOS DEL USUARIO DEL PEDIDO */

try {
    // Preparar la consulta SQL para eliminar los productos del usuario especificado
    $query = "DELETE FROM detallespedido WHERE usuario_id = :usuario_id";
    $statement = $connection->prepare($query);
    $statement->bindParam(':usuario_id', $idUsuario, PDO::PARAM_INT);

    // Ejecutar la consulta y verificar si se eliminaron los datos
    if ($statement->execute()) {
        //echo "Productos eliminados correctamente.";
    } else {
        //echo "Error al eliminar los productos.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

include_once("../Pago/validacionPago.php");

ob_end_flush();
?>
