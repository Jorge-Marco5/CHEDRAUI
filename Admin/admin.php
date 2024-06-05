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
<link href="styleAdmin.css" rel="stylesheet" type="text/css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>

    <style type="text/css">

        *{
        justify-content: center;
        align-items: center;
        text-align:center;
        }

        body{
            margin-top: 10px;
            justify-content: center;
            align-items: center;
            background: #fdf100;
            background-repeat: no-repeat;
        }

        .titulo{
            margin-top:10px;
            margin:auto;
            justify-content:center;
            align-items:center;
            text-align:center;
            width:400px;
            height:80;
        }

        .logoIcono{
            top:10px;
            position: relative;
            margin:auto;
          width:70px;
          height: 60px;
        }

        .name{
          position: relative;
          text-align: center;
          margin-top: 0px;
          color: #270c2f;
          margin: auto;
        }

        .containerIndex{
            margin: auto;
            background:rgba(0,0,0,0.20);
            position:relative;
            width: 400px;
            height:500px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            }

    </style>
</head>
<body>

    <div class="titulo">
      <img class="logoIcono" src="../images\LogoIcono.jpg">

        <h1 class="name">Sopes el Texano</h1>
    </div>

<center>
<div class="containerIndex">
<!--<h1 class="title">Administrador</h1>-->
<h1>Administrador</h1>

        <button type="button" name="" class="btn" id="aggProducto" onClick="window.location.href='adminProductos.php'">
            <i class="fab fa-location" style="color: inherit;"></i>
            Administrar productos
        </button>

        <button type="button" name="" class="btn" id="aggProducto" onClick="window.location.href='adminPedidos.php'">
            <i class="fab fa-location" style="color: inherit;"></i>
            Administrar pedidos
        </button>

        <button type="button" name="" class="btn" id="aggProducto" onClick="window.location.href='adminVentas.php'">
            <i class="fab fa-location" style="color: inherit;"></i>
            Administrar ventas
        </button>

        <button type="button" name="" class="btn" id="aggProducto" onClick="window.location.href='http://localhost/phpmyadmin/'">
            <i class="fab fa-location" style="color: inherit;"></i>
            Administrar Base de datos
        </button>
</div>
</center>

<script>
</script>

</body>
</html>