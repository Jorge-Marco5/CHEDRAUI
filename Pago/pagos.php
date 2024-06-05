
<!DOCTYPE html>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
<link rel="shortcut icon" href="../favicon.ico">

<!--bootstrap-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">



<!--Estilos css-->
<link href="stylePagos.css" rel="stylesheet" type="text/css">
<html  lang="es">
  
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Formato de pago</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>

    <?php include('../config/config.php'); // Ajusta la ruta según la ubicación de tu archivo
    include_once  '../header.php'; ?>

    <body>
<center>
    <?php
    include('../login_Signup/conexion.php');

if (isset($_GET['total']) && !empty($_GET['total'])) {
  $total = $_GET['total'];

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {

$idUsuario = $_SESSION['idUsuario'];

$query = "SELECT * FROM tarjetasusuario WHERE usuario_id = :idUsuario";
$statement = $connection->prepare($query);
$statement->bindParam(':idUsuario', $idUsuario);
$statement->execute();


if ($statement->rowCount() > 0) {
    // El usuario tiene ubicaciones agregadas, mostrar la lista de ubicaciones
   // Consultar las ubicaciones del usuario actual desde la base de datos
   $query = $connection->prepare("SELECT token, nombre_titular, fecha_expiracion FROM tarjetasusuario WHERE usuario_id = :idUsuario");
   $query->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
   $query->execute();
   $tarjeta = $query->fetch(PDO::FETCH_ASSOC);
   $contador = 0;
// Mostrar las ubicaciones en divs separados
if ($tarjeta) { 
  $contador++;
  ?>

<center>
<div><h1 class="">Selecciona una tarjeta para realizar el pago</h1></div>
<form method="post" action="validacionPago.php" name="pagos-form">
    <div class="tarjeta">
        <h1 class="BBVA">BBVA</h1>
        <img class="chip" src="../images/Tarjeta/chip.jpg" alt="">
        <h1 class="numero" id="cardNumber"><?php echo $tarjeta['token']; ?></h1>
        <h1 class="txtValida">VÁLIDA HASTA</h1> <h1 class="date"><?php echo $tarjeta['fecha_expiracion']; ?></h1>
        <h1 class="propietario"><?php echo $tarjeta['nombre_titular']; ?></h1>
        <img class="visa" src="../images/Tarjeta/visa.png" alt="">
    </div>
  <div style="margin: 5px;">
  <input type="checkbox" id="ter/cond" name="ter&cond" value="ter&cond" required>
      <label class="terminos"> Tarjeta <?php echo $contador; ?>.</label>
  </div></center>

    <button type="submit" class="btn">Pagar</button>
</form>

<?php } ?>
<?php
} else {?>
    <div class="wrapper">
  <div class="payment">
  <form method="post" action="addTarjeta.php" name="location-form">
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
     <button type="submit" class="btn" onClick="window.location.href='pagos.php?total=<?php echo $total; ?>'">Agregar tarjeta</button>

    </div>
</form>
  </div>
</div>
</center>
<?php }
 ?>

<style type="text/css">

@import url('https://fonts.googleapis.com/css?family=Baloo+Bhaijaan|Ubuntu');

*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Ubuntu', sans-serif;
  justify-content:center;
  align-items: center;
}

body{
  background: #fdf100;
  margin: 0 10px;
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

.terminos{
  color: Black;
  font-size: 20px;
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


/*DISEÑO TARJETA */

.tarjeta{
  justify-content:center;
  align-items: center;
  background: #181818;
  width: 500px;
  height: 280px;
  border-radius: 20px;
}

.BBVA{
  color: white;
  font-family: "Open Sans", sans-serif;
  font-optical-sizing: auto;
  font-size: 38px;
  font-style: normal;
  font-variation-settings:
    "wdth" 400;
  width: 40px;
  height: 10px;
  margin: 37px;
  margin-top: 10px;
  float: left;
}

.chip{
  position: relative;
  border-radius: 10px;
  width: 65px;
  height: 50px;
  margin: -70px;
  margin-top: 70px;
  float: left;
}

.numero{
  color: white;
  font-family: 'Courier New', Courier, monospace;
  font-optical-sizing: auto;
  font-size: 35px;
  font-style: normal;
  font-variation-settings:
    "wdth" 400;
  width: 400px;
  height: 10px;
  margin: 37px;
  margin-top: 75px;
  float: left;
}

.txtValida{
  color: white;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  font-size: 11px;
  width: 10px;
  height: 10px;
  margin: 90px;
  margin-top: 5px;
  float: left;
}

.date{
  color: white;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  font-style: inherit;
  font-size: 19px;
  width: 10px;
  height: 10px;
  margin: -55px;
  margin-top: 5px;
  float: left;
}


.propietario{
  color: white;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  font-style: inherit;
  font-size: 19px;
  width: 300px;
  height: 10px;
  margin: -185px;
  margin-top: 40px;
  float: left;
}

.visa{
  position: relative;
  border-radius: 1px;
  width: 100px;
  height: 37px;
  margin: 20px;
  margin-top: 35px;
  float: right;
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

  <?php
  } else {
    // Si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
    header('Location: ../login_Signup/login.html');
    exit;
} }else{
  header('Location: ../index.php');
}
?>
    </body>
</html>