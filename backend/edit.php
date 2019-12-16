<?php

require_once './conexion.php';

$email = $_SESSION['email'];

// declarar las variables de error o exito
$errors = '';
$success = '';

// tomar todos los datos que nos llegan por post
if(isset($_POST['edit'])){
    $message = $_POST['message'];

    // Validar que el dato no este vacio
    if(empty($message)){
        $errors .= '* Tu biografia no puede estar vacia';
    }

    // Limpar datos
    $message = htmlspecialchars($message);
    $message = trim($message);

    $message = filter_var($message, FILTER_SANITIZE_STRING);

    // actualizar el dato en la base de datos
    if(empty($errors)){
        $statement = $conexion->prepare("UPDATE users SET message = '$message' WHERE email = '$email'");
            $statement->execute(array(
                ':message' => $message,
                ':email' => $email
            ));
        $success .= "Tu biografia se ha actualizado correctamente";
        header("Refresh:3; url=index.php");
}

}

?>