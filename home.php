<?php session_start();

// Comprobar si el usuario ha inciado sesion
if(empty($_SESSION['email'])){
    header('Location: index.php');
}

require_once 'conexion.php';

$email = $_SESSION['email'];

// Sacar el nombre de la persona que ha iniciado sesion
$stmt = $conexion->query("SELECT * FROM users WHERE email = '$email'");
$stmt->execute(['email' => $email]);
while ($row = $stmt->fetch()) {
    $name = $row['name'];
    $surname = $row['surname'];
    $message = $row['message'];
    $nameFoto = $row['foto'];
    $sexo = $row['sexo'];
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog Master</title>
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
            <?php if($nameFoto == false){ ?>
                <!-- Si el usuario no tiene foto de perfil, coloco una por defecto -->
                <?php if($sexo == 'masculino') { ?>
                    <p><a href="foto.php"><img src="img/hombre.png" class="perfil" alt="Imagen de usuario de <?=$name?>" title="Foto de perfil de <?=$name?>" height="150"></a></p>
                <?php } else{  ?>
                    <p><a href="foto.php"><img src="img/mujer.png" class="perfil" alt="Imagen de usuario de <?=$name?>" title="Foto de perfil de <?=$name?>" height="150"></a></p>
                <?php } ?>

            <?php }else{ ?>
            <!-- Si tiene foto de perfil, coloco la que tiene -->
            <p><a href="foto.php"><img src="image/<?=$nameFoto?>" class="perfil" alt="Imagen de usuario de <?=$name?>" title="Foto de perfil de <?=$name?>" height="150"></a></p>

            <?php } ?>
            <h3>Bienvenido: <?php echo $name . " " . $surname; ?></h3>
            <p class="parrafo"><?php echo  $message; ?></p><br/>
            <a href="edit.php">Editar biografia</a>
            <a class="right" href="editUser.php">Editar usuario</a>
        </article>
    </section>
</main>

<!-- Footer de la pagina -->
<?php require 'footer.php'; ?>
    
</body>
</html>