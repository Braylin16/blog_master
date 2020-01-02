<?php

// Comprobar si el usuario ha inciado sesion
if(!isset($_SESSION['email'])){
    header('Location: home.php');
}

$email = $_SESSION['email'];

require_once './conexion.php';

// Mensajes
$errors = "";
$success = "";

if(isset($_POST['name']) and isset($_POST['surname'])){

    $name = $_POST["name"];
    $surname = $_POST["surname"];

    if(empty($name) || empty($surname)){
        $errors = 'Errors, campos vacios';
    }

    // Convertir a mayusculas las primeras letras de cada palabra
    $name = ucwords($name);
    $surname = ucwords($surname);

    // Limpiar y validar los datos que nos llegan
    $name = htmlspecialchars($name);
    $name = trim($name);
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $surname = htmlspecialchars($surname);
    $surname = trim($surname);
    $surname = filter_var($surname, FILTER_SANITIZE_STRING);

    if(empty($errors)){
        $statement = $conexion->prepare("UPDATE users SET name = '$name', surname = '$surname' WHERE email = '$email'"
        );
        $statement->execute(array(
            ':name' => $name,
            ':surname' => $surname
        ));

        $success = "Se han actualizado los datos con exito";
            header("Refresh:3; url=index.php");
    }
}
?>