<?php
include('conexion.php');
session_start();
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = $connection->prepare("SELECT * FROM users WHERE USERNAME=:username");
    $query->bindParam("username", $username, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        echo "<script> alert('Usuario y contraseña incorrectos!'); </script>";
        header("location: logIn.html"); // Redireccionando a la pagina de inicio de sesion
    } else {
        if (password_verify($password, $result['password'])) {
            $_SESSION['idUsuario'] = $result['idUsuario']; // Corregido para usar el ID de usuario recuperado
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            echo "<script> alert('Inicio de sesion exitoso!'); </script>";
            header("location: /Restaurant"); // Redireccionando a la pagina de inicio
        } else {
            echo "<script> alert('Usuario y contraseña incorrectos!'); </script>";
            header("location: logIn.html"); // Redireccionando a la pagina de inicio de sesion
        }
    }
}
?>
