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
        <title>Agregar Metodo de pago</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>

    <?php include('../config/config.php'); // Ajusta la ruta según la ubicación de tu archivo
    include_once  '../header.php'; ?>

    <body>

<center>

    <h1 class="title">El Pago se realizo con exito</h1>

        <a href="../Admin/datos.php"><button type="submit" name="" class="btn" id="btnGitHub">
            <i class="fab fa-location" style="color: inherit;"></i>
            Volver al inicio
        </button></a>
</center>

<?php
include('../login_Signup/conexion.php');

$username = $_SESSION['username'];
$idUsuario = $_SESSION['idUsuario']; // Supongamos que tienes el ID del usuario

/*obtener las consultas de los datos de cada tabla, poder acceder a los datos desde cualquier parte del codigo
y agregar los datos a la tabla pedido*/

?>

<style type="text/css">
    body{
        background: linear-gradient(to bottom right, gray, #ffd900);
    background-repeat: no-repeat;
    }
</style>

        <script src="" async defer></script>
    </body>
</html>
