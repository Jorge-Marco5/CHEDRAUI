<?php
ob_start();

if (!defined('BASE_URL')) {
include('config/config.php'); // Asegúrate de que la constante esté definida
}
?>

<!DOCTYPE html>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="shortcut icon" href="favicon.ico">

<html lang="es">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatisble" content="IE=edge">
        <title>Restaurante</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>

<header class="barraSuperior">

    <a href="<?php echo BASE_URL; ?>index.php">
      <img class="logoIcono" src="<?php echo BASE_URL; ?>images\LogoIcono.jpg">

        <h1 class="name">Sopes el Texano</h1>
      </a>
      <div class="spacer"></div>

<?php
    session_start();

    if(isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
?>

<div class="menu">
      <button class="Menu"><i class="fa fa-bars"></i></button>
      <div class="menu-options">

      <form action="./Pedidos/verPedido.php" method="post">
          <input type="submit" value="Ver pedidos" id="btnMenu" onClick="window.location.href='verPedido.php'"></input>
      </form>

      <form action="./carta/carta.php" method="post">
          <input type="submit" value="Carta" class="btnMenu"></input>
      </form>

      <form action="./ubicacion/ubicacion.php" method="post">
          <input type="submit" value="Agregar Ubicacion" class="btnMenu" onClick="window.location.href='ubicacion.php'"></input>    
      </form>

      <form action="./Pago/aggTarjetas.php" method="post">
          <input type="submit" value="Tarjetas" class="btnMenu" onClick="window.location.href='aggTarjetas.php'"></input>    
      </form>

      <form action="login_Signup/closeSession.php" method="post">
          <input type="submit" value="Cerrar Sesion" class="btnMenu"></input>
      </form>
      </div>
</div>
                    <div id="nameUser">Bienvenid@ <?php echo $username; ?></div>
                    <div id="imgUser"><img id="imgUser" src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse1.mm.bing.net%2Fth%3Fid%3DOIP.qR0GP0edU8z3CIOxMTAnzAHaHa%26pid%3DApi&f=1&ipt=077530002660988fd9d0911f179d49e305d04c4d0b17658c45501f935c2447ee&ipo=images" alt=""></div>


        <?php } else { ?>
            <input class="signUp" type="button" value="Sign UP" onClick="window.location.href='login_Signup/SignUp.html'"/>
            <input class="logIn" type="button" value="Log In" onClick="window.location.href = 'login_Signup/logIn.html'"/>
        <?php } ?>

    </header>
      <style type="text/css">
        *{
            box-sizing: border-box;
            font-family: "Inter", sans-serif;
            font-optical-sizing: auto;
            font-weight: weight;
            font-style: normal;
            font-variation-settings: "slnt" 0;
            justify-content: center;
            align-items: center;
        }

        header{
          position: relative;
          display: flex; /* Establece un contenedor flexible */
          align-items: center; /* Alinea los elementos verticalmente */
          flex-direction: row;
          font-family: "Inter", sans-serif;
          font-optical-sizing: auto;
          font-weight: weight;
          font-style: normal;
          font-variation-settings: "slnt" 0;
          background-color: #fdf100;
          width: auto;
          height: 70px;
          margin: auto;
          padding: 10px 20px;
        }

        .logoIcono{
          float: left;
          width:60px;
          height: 50px;
          margin-right: 10px; /* Ajusta el margen entre el logotipo y el nombre */
        }

        .logoIcono,
        .name{
          position: relative;
          text-align: left;
          top: 5px;
          color: #270c2f;
          margin: 0; /* Elimina los márgenes predeterminados del encabezado */
          display: inline-block; /* Hace que los elementos se muestren en línea */
          vertical-align: middle; /* Alinea verticalmente los elementos */
        }

        #BlogIn{
              background:black;
        }

        .spacer {
            flex: 1;
        }

        .signUp{
            background-color:black;
            color: #ffd900;
            font-family: "Inter", sans-serif;
            font-optical-sizing: auto;
            font-weight: weight;
            font-style: bold;
            font-variation-settings: "slnt" 0;
            border: 0ch;
            border-radius: 10px 0px 0px 10px;
            outline: none;
            display: block;
            height: 50px;
            width: 70px;
            left: 0;
            right: 0;
            position: relative;
            float: right;
            cursor: pointer;
        }

        .logIn{
            color:black;
            background-color: #c4a600;
            font-family: "Inter", sans-serif;
            font-optical-sizing: auto;
            font-weight: weight;
            font-style: bold;
            font-variation-settings: "slnt" 0;
            border: 1px;
            border-color: black;
            border-radius: 0px 10px 10px 0px;
            outline: none;
            display: block;
            height: 50px;
            width: 70px;
            left: 0;
            right: 0;
            position: relative;
            float: right;
            cursor: pointer;
        }

        #imgUser{
          border-radius: 50px;
          display: block;
          width: 30px;
          height: 30px;
          position: relative;
          margin: 3px;
          cursor: pointer;
        }

        #nameUser{
          font-size: small;
          position: relative;
          display: block;
        /*    margin-top: 5px;*/
          cursor: pointer;
          width: 100px;
        }


        /*MENU DE OPCIONES*/

        .menu {
            display: inline-block;
            position: relative;
            z-index: 1000;
          }

          .Menu{
            font-size: 30px;
            color:black;
            background-color: #fdf100;
            border: 0ch;
            border-radius: 5px;
            border-inline: None;
            display: block;
            height: 50px;
            width: 50px;
            left: 0;
            right: 0;
            position: relative;
            cursor: pointer;
        }

          .Menu:hover{
            background-color:#c4a600;
          }

          .menu-options {
            display: none;
            position: absolute;
            overflow: auto;
            background: rgb(170, 170, 170);
            border-radius:5px;
            box-shadow: 0px 10px 10px 0px rgba(0,0,0,0.4);
          }

          .menu:hover .menu-options {
            display: block;
          }

          .menu-options input {
            font-size: small;
            display: flex;
            color: #000000;
            border: none;
            padding: 5px;
            text-decoration: none;
            width: 150px;
            height: 50px;
          }
          
          .menu-options input:hover {
            width: 150px;
            font-size: small;
            color: #0a0a23;
            background: rgb(228, 228, 228);
          }

        </style>

    </html>