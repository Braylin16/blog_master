<?php

require_once './conexion.php';

$email = $_SESSION['email'];

$success = '';
$errors = '';

 // Validar que el usuario no exista en la base de datos
 $sentencia = $conexion->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");

 $sentencia->execute(array(
     ':email' => $email
 ));

if(isset($_FILES['foto'])){
    $foto = $_FILES['foto'];
    $nameFoto = $foto['name'];
    $type = $foto['type'];

    if($type == 'image/jpg' || $type == 'image/jpeg' || $type == 'image/png' || $type || 'image/git' || $type || 'image/gif'){

        if(!is_dir('image')){
            mkdir('image', 0777);
        }

            move_uploaded_file($foto['tmp_name'], 'image/'.$nameFoto);

            // Insertar la foto en la base de datos
            if($errors == ''){
                $statement = $conexion->prepare("UPDATE users SET foto = :nameFoto WHERE email = '$email'"
                );
                $statement->execute(array(
                    ':nameFoto' => $nameFoto
                ));

                $success = "Has colocado una foto de perfil";
                header("Refresh:4; url=page2.php");


            }

    }else{
        $errors = "El tipo de imagen $type no es soportado";
    }

}

?>