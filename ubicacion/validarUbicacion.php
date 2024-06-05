<!DOCTYPE html>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="shortcut icon" href="../favicon.ico">

<!--Estilos css-->
<link href="styleLocation.css" rel="stylesheet" type="text/css">
<html lang="es">
    <head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatisble" content="IE=edge">
        <title>Agregar Ubicacion</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    
    <?php include('../config/config.php'); // Ajusta la ruta según la ubicación de tu archivo
     include_once  '../header.php'; ?>

    <body>
     
    <center>
 <div class="containerUbicacion">


<?php 
// Paso 1: Verificar si el usuario tiene al menos una ubicación registrada
//$idUsuario = obtenerIdUsuario(); // Supongamos que ya tienes una función para obtener el ID del usuario actual

include('../login_Signup/conexion.php');

$idUsuario = $_SESSION['idUsuario'];

$query = "SELECT * FROM ubicaciones WHERE idUsuario = :idUsuario";
$statement = $connection->prepare($query);
$statement->bindParam(':idUsuario', $idUsuario);
$statement->execute();

if ($statement->rowCount() > 0) {
    // El usuario tiene ubicaciones agregadas, mostrar la lista de ubicaciones
   // Consultar las ubicaciones del usuario actual desde la base de datos
$query = $connection->prepare("SELECT * FROM ubicaciones WHERE idUsuario = :idUsuario");
$query->bindParam(":idUsuario", $idUsuario, PDO::PARAM_INT);
$query->execute();
$ubicaciones = $query->fetchAll(PDO::FETCH_ASSOC);

// Mostrar las ubicaciones en divs separados
foreach ($ubicaciones as $ubicacion) { 
    
    header("../Pago/validacionPago.php");
    } 
} else {?>
    
    <h1 class="title">Agregar direccion</h1>

    <form method="post" action="validarDireccionQuery.php" name="location-form">
        <h2 class="textLocation">Nombre completo (nombre y apellido)</h2>
        <input type="text" name="nameUsuario" id="inputText" required>
        
        <h2 class="textLocation">Codigo Postal</h2>
        <input type="text" name="CP" id="inputText" required>

        <h2 class="textLocation">Calle</h2>
        <input type="text" name="Calle" id="inputText" required>

        <h2 class="textLocation">Colonia</h2>
        <input type="text" name="Colonia" id="inputText" required>

        <h2 class="textLocation">Numero de telefono</h2>
        <input type="text" name="NumTelefono" id="inputText" required>

        <h2 class="textLocation">Agregar instrucciones de entrega:</h2>
        <input type="text" name="instruccionesEntrega" id="inputText" required>

        <button type="submit" name="" class="btn" id="btnGitHub">
            <i class="fab fa-location" style="color: inherit;"></i>
            Agregar dirección
        </button>
        </form>

<?php } ?>

</div>
</center>

        <script src="" async defer></script>
    </body>
</html>
