<!DOCTYPE html>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
<link rel="shortcut icon" href="favicon.ico">

<!--Estilos css-->
<link href="Estilos.css" rel="stylesheet" type="text/css">
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatisble" content="IE=edge">
        <title>Restaurante</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>

    <?php include ('./header.php');
    include('config/config.php'); // Ajusta la ruta según la ubicación de tu archivo
    ?>

    <body>
    <?php
// Conexión a la base de datos y otras configuraciones necesarias
include('./login_Signup/conexion.php');

// Verificar si se recibió un ID de producto válido
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_producto = $_GET['id'];

    // Consultar la base de datos para obtener los detalles del producto con el ID proporcionado
    $query = $connection->prepare("SELECT * FROM productos WHERE id = :id");
    $query->bindParam(':id', $id_producto);
    $query->execute();
    $producto = $query->fetch(PDO::FETCH_ASSOC);

    if ($producto) {?>

        <div class="container1">
        <div class="slide">
            <div class="slide-inner">
                <input class="slide-open" type="radio" id="slide-1"
                      name="slide" aria-hidden="true" hidden="" checked="checked">
                <div class="slide-item">
                <img src="./images/<?php echo $producto['imagen']; ?>" alt="">
                </div>
                <input class="slide-open" type="radio" id="slide-2"
                      name="slide" aria-hidden="true" hidden="">
                <div class="slide-item">
                <img src="./images/<?php echo $producto['imagen']; ?>" alt="">
                </div>
                <input class="slide-open" type="radio" id="slide-3"
                      name="slide" aria-hidden="true" hidden="">
                <div class="slide-item">
                <img src="./images/<?php echo $producto['imagen']; ?>" alt="">
                </div>
                <label for="slide-3" class="slide-control prev control-1">‹</label>
                <label for="slide-2" class="slide-control next control-1">›</label>
                <label for="slide-1" class="slide-control prev control-2">‹</label>
                <label for="slide-3" class="slide-control next control-2">›</label>
                <label for="slide-2" class="slide-control prev control-3">‹</label>
                <label for="slide-1" class="slide-control next control-3">›</label>
            </div>
        </div>

        <div id="datVerProd">
            <h1 class="verProdName"><?php echo $producto['nombre']; ?></h1>
            <h1 class="verProdDescription"> <?php echo $producto['descripcion'] ?> </h1>
            <h1 class="verProdPrice">$ <?php echo $producto['precio'] ?> </h1>
        </div>
    </div>
        <script src="" async defer></script>
    </body>

    <form action="./carta/aggProdCarta.php" method="get">
    <div id="containerCompra">
        <div id="cantidad">
            <h1 id="nameCant">Cantidad de ordenes</h1>
            <!--boton cantidad de unidades-->
            <div id="cantUnit">
                <input class="btnpr" id="btnDecrementar" type="button" value="-">
                <input class="btnpr" id="cantidadd" type="text" value="1"> <!-- El campo de cantidad -->
                <input class="btnpr" id="btnIncrementar" type="button" value="+">
            </div>
        </div>

        <div class="spacer"></div>

        <!-- Campo oculto para enviar el valor de cantidad a PHP -->
        <input type="hidden" id="cantidadHidden" name="cantidad" value="1">

        <!-- Botón de submit -->
        <button type="submit" name="id" class="btn" id="btnCompra" value="<?php echo $producto['id']; ?>">
            Agregar producto
        </button>
    </div>
</form>

</div>

   <?php

   } else {
        echo "Producto no encontrado. ".$producto['id'];
    }
} else {
    echo "ID de producto no válido.";
}
?>

<style type="text/css">
/*IMAGEN CENTRADA */
img{
    width: 200px;
    height: 300px;
    object-fit: cover;
    object-position: 0% 50%;
    }

</style>


<script type="text/javascript">
       // Obtener los elementos relevantes del DOM
       var cantidadInput = document.getElementById("cantidadd");
    var cantidadHidden = document.getElementById("cantidadHidden");

    // Agregar un evento de escucha para detectar cambios en el campo de texto
    cantidadInput.addEventListener("input", function() {
        // Obtener el valor del campo de texto y convertirlo a un entero
        var cantidad = parseInt(cantidadInput.value);

        // Verificar si la cantidad es un número válido
        if (!isNaN(cantidad) && cantidad > 0) {
            // Actualizar el valor del campo oculto con la nueva cantidad
            cantidadHidden.value = cantidad;
        } else {
            // Si la cantidad ingresada no es válida, establecer el valor predeterminado en 1
            cantidadInput.value = "1";
            cantidadHidden.value = "1";
        }
    });

    // Escuchar eventos de clic en los botones de incremento y decremento
    document.getElementById("btnIncrementar").addEventListener("click", function() {
        var cantidad = parseInt(cantidadInput.value);
        cantidad++;
        cantidadInput.value = cantidad;
        cantidadHidden.value = cantidad;
    });

    document.getElementById("btnDecrementar").addEventListener("click", function() {
        var cantidad = parseInt(cantidadInput.value);
        if (cantidad > 1) {
            cantidad--;
            cantidadInput.value = cantidad;
            cantidadHidden.value = cantidad;
        }
    });

</script>