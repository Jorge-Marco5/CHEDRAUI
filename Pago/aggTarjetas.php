<!DOCTYPE html>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="shortcut icon" href="../favicon.ico">

<!--Estilos css-->
<link href="stylePagos.css" rel="stylesheet" type="text/css">
<html lang="es">
    <head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatisble" content="IE=edge">
        <title>Tarjetas</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <?php include('../config/config.php'); // Ajusta la ruta según la ubicación de tu archivo
    include_once  '../header.php';?>

    <body>

    <center>
<?php 
// Paso 1: Verificar si el usuario tiene al menos una ubicación registrada
//$idUsuario = obtenerIdUsuario(); // Supongamos que ya tienes una función para obtener el ID del usuario actual

include('../login_Signup/conexion.php');

$idUsuario = $_SESSION['idUsuario'];

$query = "SELECT * FROM tarjetasusuario WHERE usuario_id = :idUsuario";
$statement = $connection->prepare($query);
$statement->bindParam(':idUsuario', $idUsuario);
$statement->execute();

if ($statement->rowCount() > 0) {
    // El usuario tiene ubicaciones agregadas, mostrar la lista de ubicaciones
   // Consultar las ubicaciones del usuario actual desde la base de datos
   $query = $connection->prepare("SELECT id, token, nombre_titular, fecha_expiracion FROM tarjetasusuario WHERE usuario_id = :idUsuario");
   $query->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
   $query->execute();
   $tarjeta = $query->fetch(PDO::FETCH_ASSOC);

// Mostrar las ubicaciones en divs separados
if ($tarjeta) { ?>
    <div class="tarjeta">
        <h1 class="BBVA">BBVA</h1>
        <img class="chip" src="../images/Tarjeta/chip.jpg" alt="">
        <h1 class="numero" id="cardNumber"><?php echo $tarjeta['token']; ?></h1>
        <h1 class="txtValida">VÁLIDA HASTA</h1> <h1 class="date"><?php echo $tarjeta['fecha_expiracion']; ?></h1>
        <h1 class="propietario"><?php echo $tarjeta['nombre_titular']; ?></h1>
        <img class="visa" src="../images/Tarjeta/visa.png" alt="">
    </div>

    <a href="eliminarTarjeta.php?id=<?php echo $tarjeta ['id']?>">
      <button type="submit" name="" class="btnDelete">
        <i class="fab fa-location" style="color: inherit;"></i>
        Eliminar tarjeta
      </button>
    </a>

<?php } ?>
<?php
} else {?>
    <div class="wrapper">
  <div class="payment">
  <form method="post" action="verTarjetas.php" name="location-form">
    <h2>Sopes el texano</h2>
    <div class="form">
      <div class="card space icon-relative">
        <label class="label">Nombre del Propietario:</label>
        <input type="text" name="nombre_titular" class="input" placeholder="Nombre" required>
        <i class="fas fa-user"></i>
      </div>
      <div class="card space icon-relative">
        <label class="label">Numero de tarjeta:</label>
        <input type="text" name="numero_tarjeta" class="input" id="cardNumber" placeholder="Numero de tarjeta" maxlength="19" required>
        <i class="far fa-credit-card"></i>
      </div>
      <div class="card-grp space">
        <div class="card-item icon-relative">
          <label class="label">Fecha expiración:</label>
          <input type="text" name="fecha_expiracion" name="expiry-data" id="expiryDate" class="input"  placeholder="00 / 00" maxlength="5" required>
          <i class="far fa-calendar-alt"></i>
        </div>
        <div class="card-item icon-relative">
          <label class="label">CVC:</label>
          <input type="text" class="input" data-mask="000" placeholder="000" required>
          <i class="fas fa-lock"></i>
        </div>
      </div>
     <button type="submit" class="btn" onClick="window.location.href='aggTarjetas.php'">Agregar tarjeta</button>

    </div>
</form>
  </div>
</div>
<?php }
 ?>
</div>
</center>

<style type="text/css">

@import url('https://fonts.googleapis.com/css?family=Baloo+Bhaijaan|Ubuntu');


/*DISEÑO GENERAL */
*{
  box-sizing: border-box;
  font-family: 'Ubuntu', sans-serif;
}

body{
  background: #fdf100;
  justify-content: center;
  align-items: center;
}

.payment{
  background: #f8f8f8;
  max-width: 360px;
  margin: 50px auto;
  height: auto;
  padding: 35px;
  padding-top: 70px;
  border-radius: 5px;
  position: relative;
}

.payment h2{
  text-align: center;
  letter-spacing: 2px;
  margin-bottom: 40px;
  color: #270c2f;
}

.form .label{
  display: block;
  color: #555555;
  margin-bottom: 6px;
}

.input{
  padding: 13px 0px 13px 25px;
  width: 100%;
  text-align: center;
  border: 2px solid #dddddd;
  border-radius: 5px;
  letter-spacing: 1px;
  word-spacing: 3px;
  outline: none;
  font-size: 16px;
  color: #555555;
  box-sizing: border-box;
}

.card-grp{
  display: flex;
  justify-content: space-between;
}

.card-item{
  width: 48%;
}

.space{
  margin-bottom: 20px;
}

.icon-relative{
  position: relative;
}

.icon-relative .fas,
.icon-relative .far{
  position: absolute;
  bottom: 12px;
  left: 15px;
  font-size: 20px;
  color: #555555;
}

.btn{
  margin-top: 40px;
  background: #2196F3;
  padding: 12px;
  text-align: center;
  color: #f8f8f8;
  border-radius: 5px;
  cursor: pointer;
}

.btnDelete{
  font-family: "Inter", sans-serif;
  background: #2196F3;
  margin-top: 40px;
  width: 300px;
  height: 40px;
  color: #f8f8f8;
  border-radius: 5px;
  cursor: pointer;
  border: 1px solid #00000000;
  position: relative;
  margin-left: -600px;
}


.payment-logo{
  position: absolute;
  top: -50px;
  left: 50%;
  transform: translateX(-50%);
  width: 100px;
  height: 100px;
  background: #fdf100;
  border-radius: 50%;
  box-shadow: 0 0 5px rgba(0,0,0,0.2);
  text-align: center;
  line-height: 85px;
}

.payment-logo:before{
  content: "";
  position: absolute;
  top: 5px;
  left: 5px;
  width: 90px;
  height: 90px;
  background: #fdf100;
  border-radius: 50%;
}

.payment-logo p{
  position: relative;
  color: #f8f8f8;
  font-family: 'Baloo Bhaijaan', cursive;
  font-size: 58px;
}


@media screen and (max-width: 420px){
  .card-grp{
    flex-direction: column;
  }
  .card-item{
    width: 100%;
    margin-bottom: 20px;
  }
  .btn{
    margin-top: 20px;
  }
}
</style>

<script type="text/javascript">

/*FORMATO PARA EL VENCIMIENTO DE LA TARJETA */
document.getElementById('cardNumber').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, ''); // Remove all non-digit characters
            let formattedValue = value.match(/.{1,4}/g)?.join(' ') || ''; // Group in sets of 4 digits
            e.target.value = formattedValue;
        });

        document.getElementById('expiryDate').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, ''); // Remove all non-digit characters
            if (value.length > 4) value = value.slice(0, 4); // Ensure max length is 4 digits
            let formattedValue = value.match(/.{1,2}/g)?.join('/') || value; // Format MM/YY
            e.target.value = formattedValue;
        });

</script>

        <script src="" async defer></script>
    </body>
</html>
