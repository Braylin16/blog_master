<?php session_start();

// Comprobar si el usuario ha inciado sesion
if(isset($_SESSION['email'])){
    header('Location: home.php');
}

$errors = "";

require_once 'conexion.php';

// Verificar los datos que estan llegando
if(isset($_POST['email']) and isset($_POST['password'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    // cifrar la password
    $password = hash('sha512', $password);

    $sentencia = $conexion->prepare("SELECT * FROM users WHERE email = :email AND password = :password LIMIT 1");

    $sentencia->execute(array(
        ':email' => $email,
        ':password' => $password
    ));

    $resultado = $sentencia->fetch();

    if($resultado == true){	
        header('Location: home.php');
    } else {
        $errors .= "* Credenciales incorrectas";
    }
}

?>