<!DOCTYPE html>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="shortcut icon" href="../favicon.ico">

<!--Estilos css-->
<link href="carta.css" rel="stylesheet" type="text/css">
<html lang="es">
    <head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatisble" content="IE=edge">
        <title>Carta</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <?php include('../config/config.php'); // Ajusta la ruta según la ubicación de tu archivo
     include_once  '../header.php';
    ?>

    <body>

    <center>
 <div class="containerUbicacion">

<?php

include('../login_Signup/conexion.php');

$idUsuario = $_SESSION['idUsuario'];


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

   $total = 0; // Inicializar el total
   $precioTotalProducto = 0;

   // Mostrar los detalles de los productos en divs separados
   foreach ($pedidos as $pedido) {
       // Obtener el nombre y el precio del producto basado en el ID del producto almacenado en detallespedido
       $queryProducto = $connection->prepare("SELECT id, nombre, precio FROM productos WHERE id = :idProducto");
       $queryProducto->bindParam(":idProducto", $pedido['producto_id'], PDO::PARAM_INT);
       $queryProducto->execute();
       $producto = $queryProducto->fetch(PDO::FETCH_ASSOC);
       // Mostrar los detalles del producto
       ?>
<tr>
        <td class="textLocation"><?php echo $producto['id']; ?> </td>
        <td class="textLocation"><?php echo $producto['nombre'] ?> (<?php echo $pedido['cantidad'];?>) </td>
        <td class="textLocation">$<?php echo $producto['precio']; ?> </td>

</tr>

<?php
    $precioTotalProducto = $precioTotalProducto + ($producto['precio'] * $pedido['cantidad']);

}
    $total += $precioTotalProducto;
?>
<td class="textLocation">Total </td>
<td></td>
<td class="textLocation">$<?php echo number_format($total, 2) ?> </td>
</table>

<a href="../Pago/pagos.php?total=<?php echo number_format($total, 2) ?>" class="btn">
<button type="submit" name="pagos" class="btn" id="btnLogIn" value="pagos">
            Pagar
</button></a>
<?php


} else {?>

    <h1 class="title">No tienes ningun producto en tu carta</h1>
    <a href="../index.php"><input class="btn" id="btnDecrementar" type="button" value="Agregar Producto"></a>

<?php }

?>
</div>
</center>

<style type="text/css">

table {
            width: 100%;
            border-collapse: collapse;
            font-family: "Inter", sans-serif;
            font-optical-sizing: auto;
            font-weight: weight;
            font-style: normal;
            font-variation-settings: "slnt" 0;
            font-size: large;
            text-align: center;
        }

        thead{
            position: sticky;
            top: 0;
        }

        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100px;
        }
        .btnOp{
            font-family: "Inter", sans-serif;
            margin-top: 10px;
            width: 100px;
            height: 40px;
            border-radius: 50px;
            border: 1px solid #00000;
        }

</style>

        <script src="" async defer></script>
    </body>
</html>
