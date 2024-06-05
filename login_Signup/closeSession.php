<?php
session_start();

// Eliminar todas las variables de sesión
$_SESSION = array();

// Destruir la sesión
session_destroy();

// Redirigir a la página de inicio o a cualquier otra página
header("location: ../index.php"); // Redireccionando a la pagina de inicio
exit;
?>
