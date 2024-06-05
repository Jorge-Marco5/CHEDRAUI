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
    <title>Administrador de productos</title>

    <style type="text/css">

    body{
        background: #fdf100;
    }

    .containerTabla{
        border-radius: 10px;
        background:rgba(0,0,0,0.20);
        overflow-y: auto;
        margin-left:10px ;
        position: absolute;
        float:left;
        width: 850px;
        height: 580px;
        top: 70px; /* distancia en px desde la parte superior */
        right:20px; /* distancia en px desde la parte derecha */
    }

        table {
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

        .editar{
            width: 50px;
        }

        .eliminar{
            width: 50px;
        }
        .btnActions{
            font-family: "Inter", sans-serif;
            margin-top: 10px;
            width: auto;
            height: 40px;
            border-radius: 10%;
            border: 1px solid #00000000;
        }


        .btnInicio{
    margin: 10px;
    margin-top:5px;
    float:left;
    position: relative;
    font-family: "Inter", sans-serif;
    width: 100px;
    height: 40px;
    border-radius: 50px;
    border: 1px solid #00000000;
}

    </style>
</head>
<body>
    <button type="button" name="" class="btnInicio" id="aggProducto" onClick="window.location.href='admin.php'">
                <i class="fab fa-location" style="color: inherit;"></i>
                Inicio
            </button>

<h1>Administrador de Productos</h1>

<div class="container">
<h1 class="title">Agregar Producto</h1>
    <form method="post" action="aggProduct.php" name="location-form">
        <h2 class="textLocation">Nombre del producto</h2>
        <input type="text" name="nameProducto" id="inputText" required>

        <h2 class="textLocation">Descripcion</h2>
        <input type="text" name="descripcion" id="inputText" required>

        <h2 class="textLocation">Precio</h2>
        <input type="text" name="precio" id="inputText" required>

        <h2 class="textLocation">Imagen</h2>
        <input type="file" id="btn" name="urlImagen" accept="image/*"><br><br>

        <button type="submit" name="" class="btn" id="aggProducto">
            <i class="fab fa-location" style="color: inherit;"></i>
            Agregar Producto
        </button>
        </form>
</div>
<div class="containerTabla">
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Imagen</th>
            <th>Operaciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
require_once('../login_Signup/conexion.php');

        // Aquí se supone que tendrías lógica PHP para obtener los productos de tu base de datos
        // Puedes reemplazar esto con tu propia lógica para obtener los productos
        $query = $connection->prepare("SELECT * FROM productos");
        $query->execute();
        $productos = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($productos as $producto) { ?>
            <tr>
                <td><?php echo $producto['id']?> </td>
                <td><?php echo $producto['nombre']?> </td>
                <td><?php echo $producto['descripcion']?></td>
                <td>$<?php echo $producto['precio']?> </td>
                <td><img src="../images/<?php echo $producto['imagen']?>" alt="<?php $producto['nombre'] ?>"></td>
                <td>
                    <a href="editarProducto.php?id=<?php echo $producto ['id']?>"><input class="btnActions" id="btnDecrementar" type="button" value="Editar"></a>
                    <a href="eliminarProducto.php?id=<?php echo $producto ['id']?>"><input class="btnActions" id="btnDecrementar" type="button" value="Eliminar"></a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
</div>
<script>
</script>

</body>
</html>