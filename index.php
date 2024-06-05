<!DOCTYPE html>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="shortcut icon" href="favicon.ico">

<!--Estilos css-->
<link href="Estilos.css" rel="stylesheet" type="text/css">
<html lang="es">
    <head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatisble" content="IE=edge">
        <title>Sopes el Texano</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>

    <?php include_once  'header.php'; ?>

    <body>
     <div>

        <img class="imgIn" src="./images\Producto4.jpg" alt="">

        <div id="menuOpciones">
        <h1 class="Titulos">¿Qué quieres comer hoy?</h1>
        <nav class="boxParent">

        <!--Mostrar Productos-->
        <?php
            require_once('./login_Signup/conexion.php');
            $query = $connection->prepare("SELECT * FROM productos");
            $query->execute();
            $productos = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($productos as $producto) { ?>

            <a href="verProduct.php?id=<?php echo $producto['id']; ?>">    <ul class="boxProduct" onClick="window.location.href='verProduct.php'">
            <img class="imgPr" src="./images/<?php echo $producto['imagen']; ?>" alt="">
            <h1 class="namePr"><?php echo $producto['nombre']; ?></h1>
            <h1 class="pricePr">$<?php echo $producto['precio']; ?></h1>
            </ul> </a>
        <?php } ?>
        </nav>

        </div>
    </div>
        <script src="" async defer></script>
    </body>

    <footer>
            <h1></h1>
    </footer>

</html>