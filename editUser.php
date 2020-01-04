<?php session_start();

// Comprobar si el usuario ha inciado sesion
if(empty($_SESSION['email'])){
    header('Location: index.php');
}

require_once 'conexion.php';
require_once 'backend/editUsers.php';

$email = $_SESSION['email'];

// Sacar el nombre de la persona que ha iniciado sesion
$stmt = $conexion->query("SELECT * FROM users WHERE email = '$email'");
$stmt->execute(['email' => $email]);
while ($row = $stmt->fetch()) {
    $name = $row['name'];
    $surname = $row['surname'];
    $message = $row['message'];
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog Master | Edita tus datos</title>
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
            <h3>Bienvenido: <?php echo $name . " " . $surname; ?></h3>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                
            <input type="text" name="name" placeholder="Nombre" value="<?php if(isset($name)){echo $name;} ?>" ><br/>

            <input type="text" name="surname" placeholder="Apellidos" value="<?php if(isset($surname)){echo $surname;} ?>" ><br/>
            
            <!-- Mensaje de error o exito -->
            <?php if(isset($success) || isset($errors)) : ?>
                    <p class="verde"><?php echo $success; ?></p>
                    <p class="rojo"><?php echo $errors; ?></p>
            <?php endif ?>

                <button type="submit" class="login" name="submit">Actualizar</button><br>

            </form>

            <br/>
            <hr/>
            <p><a href="home.php">Volver</a></p>
        </article>
    </section>
</main>

<!-- Footer de la pagina -->
<?php require 'footer.php'; ?>
    
</body>
</html>