<?php
include('../login_Signup/conexion.php');
session_start();

// Recuperar los valores del formulario

if (isset($_SESSION['idUsuario'])) {
    $idUsuario = $_SESSION['idUsuario'];
    echo "ID del usuario: " . $idUsuario;
} else {
    echo "ID del usuario no está definido en la sesión.";
}

$nombreUsuario = $_POST['nameUsuario'];
$CP = $_POST['CP'];
$calle = $_POST['Calle'];
$colonia = $_POST['Colonia'];
$numTelefono = $_POST['NumTelefono'];
$instruccionesEntrega = $_POST['instruccionesEntrega'];

try {
    // Consulta SQL para insertar datos en la tabla 'ubicacion'
    $sql = "INSERT INTO ubicaciones (idUsuario, nombre, `C.P.`, calle, colonia, numTelefono, instruccionesEntrega) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $statement = $connection->prepare($sql);
    $statement->execute([$idUsuario, $nombreUsuario, $CP, $calle, $colonia, $numTelefono, $instruccionesEntrega]);
    
    echo "Datos guardados correctamente.";
    header('Location: ../Pago/validacionPago.php');

} catch (PDOException $e) {
    echo "Error al guardar los datos: " . $e->getMessage();
}
?>
