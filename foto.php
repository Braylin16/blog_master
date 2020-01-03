<?php session_start();

// Comprobar si el usuario ha inciado sesion
if(empty($_SESSION['email'])){
    header('Location: index.php');
}

require_once 'backend/foto.php';
require_once 'conexion.php';

$email = $_SESSION['email'];

// Sacar el nombre de la persona que ha iniciado sesion
$stmt = $conexion->query("SELECT * FROM users WHERE email = '$email'");
$stmt->execute(['email' => $email]);
while ($row = $stmt->fetch()) {
    $name = $row['name'];
    $surname = $row['surname'];
    $message = $row['message'];
    $sexo = $row['sexo'];
    $nameFoto = $row['foto'];
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Completa tus datos | Blog_master</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <!-- Estilos CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Livvic&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header de la pagina -->
    <?php require 'header.php'; ?>

    <main>
        <section id="contenedor">
            <a href="cerrar.php" class="salir">Cerrar Sesion</a>
                <article>
                    <h3><?php echo $name . " " . $surname; ?>, coloca una foto de perfil</h3>
                    <?php if($nameFoto == false){ ?>
                        <!-- Si el usuario no tiene foto de perfil, coloco una por defecto -->
                        <?php if($sexo == 'masculino') { ?>
                            <p><img src="img/hombre.png" class="perfil" alt="Imagen de usuario de <?=$name?>" title="Foto de perfil de <?=$name?>" height="150"></p>
                        <?php } else{  ?>
                            <p><img src="img/mujer.png" class="perfil" alt="Imagen de usuario de <?=$name?>" title="Foto de perfil de <?=$name?>" height="150"></p>
                        <?php } ?>

                        <?php }else{ ?>
                        <!-- Si tiene foto de perfil, coloco la que tiene -->
                        <p><a href="" download="image/<?=$nameFoto?>"><img src="image/<?=$nameFoto?>" class="perfil" alt="Imagen de usuario de <?=$name?>" title="Foto de perfil de <?=$name?>" height="150"></a></p>

                        <?php } ?>

                        <!-- Formulario de envio de foto -->
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                            <div id="center">
                                <div id="div_file">
                                    <p id="texto">Seleccionar</p>
                                    <p><input type="file" name="foto" id="my_foto"></p>
                                </div>
                            </div>
                        <button type="submit" class="enviar_foto" name="submit_foto">Enviar</button> <br/>

                        <!-- Mensaje de error o exito -->
                        <?php if(isset($errors) || isset($success)) : ?>
                            <p class="verde"><?php echo $success; ?></p>
                            <p class="rojo"><?php echo $errors; ?></p>
                        <?php endif ?>

                        </form>

                        <br/>
                        <hr/>
                    <p><a href="home.php">Saltar este paso</a></p>
                </article>
        </section>
    </main>

    <!-- Header de la pagina -->
    <?php require 'footer.php'; ?>
</body>
</html>