<!DOCTYPE html>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="shortcut icon" href="../favicon.ico">

<!--Estilos css-->
<link href="stylePagos.css" rel="stylesheet" type="text/css">
<html lang="es">
    <head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatisble" content="IE=edge">
        <title>Detalles de pago</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <?php include('../config/config.php'); // Ajusta la ruta según la ubicación de tu archivo
    include_once  '../header.php';
    include('../login_Signup/conexion.php');?>
    <body>

<center>
    <h1 class="title">Detalles del pedido</h1>
<?php
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
   include_once('../Pedidos/pedidos.php');

   ?>
<h1 class="title">El Pago se realizo con exito</h1>
<h2>¡Gracias por su compra!</h2>
<?php
} else {?>
    <!--SI NO HAY NINGUN PRODUCTO EN EL CARRITO NOS MANDA EL MENSAJE DE QUE NO EXISTE NINGUN PRODUCTO AGREGADO-->
    <h1 class="title">No tienes ningun producto en tu carta</h1>
    <h1 class="title">revisa que tengas productos en carta y vuelve a intentarlo</h1>

    <a href="../carta/carta.php"><button type="submit" name="" class="btn" id="btnGitHub">
            <i class="fab fa-location" style="color: inherit;"></i>
            Ver carta
        </button></a>
<?php }
?>

        <a href="../Pedidos/verPedido.php"><button type="submit" name="" class="btn" id="btnGitHub">
            <i class="fab fa-location" style="color: inherit;"></i>
            Ver pedidos
        </button></a>

        <a href="../index.php"><button type="submit" name="" class="btn" id="btnGitHub">
            <i class="fab fa-location" style="color: inherit;"></i>
            Regresar a inicio
        </button></a>
</center>


<style type="text/css">
    body{
        background: #fdf100;
    background-repeat: no-repeat;
    }
</style>

        <script src="" async defer></script>
    </body>
</html>
