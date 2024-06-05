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
    <style>

    body{
            background: #fdf100;
        }

    .containerTabla{
        border-radius: 10px;
        background:rgba(0,0,0,0.20);
        overflow-y: auto;
        margin:auto ;
        position: relative;
        float:left;
        width: auto;
        bottom:10px;
        height: 550px;
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

    <h1>Administrador de Pedidos</h1>

<div class="containerTabla">
<table>
<thead>
        <tr>
            <th>ID</th>
            <th>Usuario ID</th>
            <th>Fecha Pedido</th>
            <th>Estado Pedido</th>
            <th>Total</th>
            <th>Detalles</th>
            <th>Dirección</th>
        </tr>
    </thead>
    <tbody>
        <?php
require_once('../login_Signup/conexion.php');

        // Aquí se supone que tendrías lógica PHP para obtener los productos de tu base de datos
        // Puedes reemplazar esto con tu propia lógica para obtener los productos
        $query = $connection->prepare("SELECT * FROM pedidos");
        $query->execute();
        $pedidos = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($pedidos as $pedido) { ?>
            <tr>
                <td class="textLocation"><?php echo $pedido['id']; ?> </td>
                <td class="textLocation"><?php echo $pedido['usuario_id']; ?> </td>
                <td class="textLocation"><?php echo $pedido['fecha_pedido']; ?> </td>
                <td class="textLocation"><?php echo $pedido['estado_pedido']; ?> </td>
                <td class="textLocation">$<?php echo $pedido['total']; ?> </td>
                <td class="textLocation"><?php echo $pedido['detalles']; ?> </td>
                <td class="textLocation"><?php echo $pedido['direccion']; ?> </td>
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