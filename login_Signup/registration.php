<?php
include('conexion.php');
session_start();
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $query = $connection->prepare("SELECT * FROM users WHERE EMAIL=:email");
    $query->bindParam("email", $email, PDO::PARAM_STR);
    $query->execute();
    if ($query->rowCount() > 0) {
        echo "<script> alert('El correo ingresado ya existe!'); </script>";
        header("location: SignUp.html"); // Redireccionando a la pagina profile.php
    }
    if ($query->rowCount() == 0) {
        $query = $connection->prepare("INSERT INTO users(USERNAME,PASSWORD,EMAIL) VALUES (:username,:password_hash,:email)");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $result = $query->execute();
        if ($result) {
            echo "<script> alert('Se completo el registro correctamente!'); </script>";
            header("location: logIn.html"); // Redireccionando a la pagina profile.php
        } else {
            echo "<script> alert('Error al registrarse, intente nuevamente!'); </script>";
            header("location: SignUp.html"); // Redireccionando a la pagina profile.php
        }
    }
}
?>
