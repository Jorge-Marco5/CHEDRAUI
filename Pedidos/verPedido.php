<!DOCTYPE html>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="shortcut icon" href="../favicon.ico">

<!--Estilos css-->
<link href="stylePedido.css" rel="stylesheet" type="text/css">
<html lang="es">
    <head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatisble" content="IE=edge">
        <title>Pedidos</title>
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

?>
<center>
 <div class="containerUbicacion">

<?php

include('../login_Signup/conexion.php');

$idUsuario = $_SESSION['idUsuario'];

// Obtener los pedidos del usuario actual
$idUsuario = $_SESSION['idUsuario'];
$query = $connection->prepare("SELECT * FROM Pedidos WHERE usuario_id = :idUsuario");
$query->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
$query->execute();
$pedidos = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Usuario ID</th>
            <th>Nombre de usuario</th>
            <th>Fecha Pedido</th>
            <th>Estado Pedido</th>
            <th>Total</th>
            <th>Dirección</th>
            <th>Detalles</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pedidos as $pedido) : ?>
            <tr>
                <td class="textLocation"><?php echo $pedido['id']; ?> </td>
                <td class="textLocation"><?php echo $pedido['usuario_id']; ?> </td>
                <td class="textLocation"><?php echo $_SESSION['username']; ?> </td>
                <td class="textLocation"><?php echo $pedido['fecha_pedido']; ?> </td>
                <td class="textLocation"><?php echo $pedido['estado_pedido']; ?> </td>
                <td class="textLocation">$<?php echo $pedido['total']; ?> </td>
                <td class="textLocation"><?php echo $pedido['direccion']; ?> </td>
                <td class="textLocation"><?php echo $pedido['detalles']; ?> </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</div>
</center>

<style type="text/css">

table {
    top:1px;
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
